<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::get();

        return view('pengaturan.perizinan.index', ['data' => compact('permissions')]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'perizinan' => 'required|string|max:255|unique:permissions,name',
        ]);

        try {
            DB::beginTransaction();

            Permission::create([
                'name'       => $validated['perizinan'],
                'guard_name' => $request->input('guard_name', 'web'),
            ]);

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Data berhasil disimpan']);
            }

            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }

            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $decryptId = Crypt::decryptString($id);
        $permission = Permission::findOrFail($decryptId);

        $validated = $request->validate([
            'perizinan' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
        ]);

        try {
            DB::beginTransaction();

            $permission->update([
                'name'       => $validated['perizinan'],
                'guard_name' => $request->input('guard_name', 'web'),
            ]);

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui']);
            }

            return redirect()->route('permissions.index')->with('success', 'Data berhasil diperbarui');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }

            return redirect()->route('permissions.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $decryptId = Crypt::decryptString($id);
            $permission = Permission::findOrFail($decryptId);

            $cekRole = $permission->roles()->exists();
            $cekUser = $permission->users()->exists();

            if ($cekRole || $cekUser) {
                DB::rollBack();
                return redirect()->route('permissions.index')->with('error', 'Hak akses masih terhubung dengan pengguna');
            }

            $permission->delete();
            DB::commit();

            return redirect()->route('permissions.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->route('permissions.index')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
