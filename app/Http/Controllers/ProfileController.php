<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'          => 'required|string|max:100',
            'email'         => 'required|email|unique:users,email,' . $user->id,
            'password'      => 'nullable|min:6|confirmed',

            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir'  => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'provinsi'      => 'required|string|max:100',
            'kabupaten_kota'=> 'required|string|max:100',
            'alamat'        => 'required|string|max:255',
            'asal_sekolah'  => 'required|string|max:100',
            'tahun_masuk'   => 'required|string|max:10',
            'no_wa'         => 'nullable|string|max:20',
            'instagram'     => 'nullable|string|max:100',
            'tiktok'        => 'nullable|string|max:100',
        ]);

        $user->fill($request->except('password', 'password_confirmation'));

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if (!$user->save()) {
            return redirect()->back()->withErrors(['Gagal menyimpan data. Silakan coba lagi.']);
        }

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
