<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminProfilController extends Controller
{
    public function index(Request $request)
    {
        $admin = $request->user();

        return view('admin.profil', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = $request->user();

        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $admin->id,
            ],
        ]);

        $admin->update($data);

        return back()->with(
            'success',
            'Informasi akun berhasil diperbarui.'
        );
    }

    public function updatePassword(Request $request)
    {
        $admin = $request->user();

        $data = $request->validate([
            'current_password' => [
                'required',
                'current_password',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $admin->update([
            'password' => Hash::make($data['password']),
        ]);

        return back()->with(
            'success',
            'Password berhasil diubah.'
        );
    }
}