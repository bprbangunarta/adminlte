<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);

        return view('profile.index', ['data' => compact('user')]);
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        $validated = $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:5|confirmed',
        ], [
            'current_password.required' => 'Sandi sekarang wajib diisi',
            'password.required'         => 'Sandi baru wajib diisi',
            'password.min'              => 'Sandi minimal 5 karakter',
            'password.confirmed'        => 'Konfirmasi Sandi tidak sesuai',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Password saat ini tidak sesuai'
            ]);
        }

        try {
            DB::beginTransaction();

            $user->password = $validated['password'];
            $user->save();

            DB::commit();

            return redirect()->back()->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
