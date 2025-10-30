<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withTrashed()
            ->with('roles')
            ->whereHas('roles', function ($query) {
                $query->where('name', '!=', 'Administrator');
            })
            ->orderBy('name')
            ->get();

        return view('pengaturan.pengguna.index', ['data' => compact('users')]);
    }

    public function create()
    {
        $roles = Role::whereNot('name', 'Administrator')->orderBy('name')->get();

        return view('pengaturan.pengguna.create', ['data' => compact('roles')]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username'     => 'required|string|max:255|unique:users,username',
            'alamat_email' => 'required|email|string|max:255|unique:users,email',
            'peranan'      => 'required|string|max:255|exists:roles,name'
        ]);

        try {
            DB::beginTransaction();

            $user = User::factory()->create([
                'name'     => Str::title($validated['nama_lengkap']),
                'username' => Str::lower($validated['username']),
                'email'    => Str::lower($validated['alamat_email']),
                'password' => '12345'
            ]);

            $user->assignRole($validated['peranan']);

            DB::commit();

            return redirect()->route('users.index')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $decryptId = Crypt::decryptString($id);
            $user = User::withTrashed()->with('roles')->findOrFail($decryptId);

            $roles = Role::whereNot('name', 'Administrator')->orderBy('name')->get();

            return view('pengaturan.pengguna.show', ['data' => compact('user', 'roles')]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('user.index')->with('error', 'Gagal menampilkan data: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $decryptId = Crypt::decryptString($id);
        $user      = User::withTrashed()->findOrFail($decryptId);

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username'     => 'required|string|max:255|unique:users,username,' . $user->id,
            'alamat_email' => 'required|email|string|max:255|unique:users,email,' . $user->id,
            'peranan'      => 'required|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            $user->update([
                'name'     => Str::title($validated['nama_lengkap']),
                'username' => Str::lower($validated['username']),
                'email'    => Str::lower($validated['alamat_email'])
            ]);

            $user->syncRoles($validated['peranan']);

            DB::commit();

            return redirect()->back()->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $decryptId = Crypt::decryptString($id);
            $user      = User::withTrashed()->findOrFail($decryptId);

            $user->delete();
            DB::commit();

            return redirect()->route('users.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function restore($id)
    {
        try {
            DB::beginTransaction();

            $decryptId = Crypt::decryptString($id);
            $user      = User::withTrashed()->findOrFail($decryptId);

            $user->password = '12345';

            $user->save();
            $user->restore();

            DB::commit();

            return redirect()->route('users.index')->with('success', 'Data berhasil dipulihkan');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->with('error', 'Gagal memulihkan data: ' . $e->getMessage());
        }
    }
}
