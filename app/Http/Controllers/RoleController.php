<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::whereNot('name', 'Administrator')->orderBy('name')->get();

        return view('pengaturan.peranan.index', ['data' => compact('roles')]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'peranan' => 'required|string|max:255|unique:roles,name',
        ]);

        try {
            DB::beginTransaction();

            Role::create([
                'name'       => $validated['peranan'],
                'guard_name' => $request->input('guard_name', 'web')
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

    public function show($id)
    {
        $decryptId   = Crypt::decryptString($id);
        $role        = Role::findOrFail($decryptId);
        $permissions = Permission::get();

        return view('pengaturan.peranan.show', ['data' => compact('role', 'permissions')]);
    }

    public function permission(Request $request, $id)
    {
        $decryptId = Crypt::decryptString($id);
        $role      = Role::findOrFail($decryptId);

        $request->validate([
            'permissions'   => 'nullable|array',
            'permissions.*' => 'exists:permissions,name'
        ]);

        try {
            DB::beginTransaction();

            $permissions = $request->input('permissions', []);
            $role->syncPermissions($permissions);

            DB::commit();

            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $decryptId = Crypt::decryptString($id);
        $role = Role::findOrFail($decryptId);

        $validated = $request->validate([
            'peranan' => 'required|string|max:255|unique:roles,name,' . $role->id,
        ]);

        try {
            DB::beginTransaction();

            $role->update([
                'name'       => $validated['peranan'],
                'guard_name' => $request->input('guard_name', 'web')
            ]);

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui']);
            }

            return redirect()->route('roles.index')->with('success', 'Data berhasil diperbarui');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }

            return redirect()->route('roles.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $decryptId = Crypt::decryptString($id);
            $role = Role::findOrFail($decryptId);

            $cekUser = $role->users()->exists();
            $cekPermission = $role->permissions()->exists();

            if ($cekUser || $cekPermission) {
                DB::rollBack();
                return redirect()->route('roles.index')->with('error', 'Peranan masih terhubung dengan pengguna');
            }

            $role->delete();
            DB::commit();

            return redirect()->route('roles.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->route('roles.index')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
