<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    /**
     * Menampilkan form edit profil.
     */
    public function edit(Request $request)
    {
        // Eager load ulasan yang diterima beserta data pemberi ulasan
        $user = $request->user()->load('reviewsReceived.reviewer');

        return view('profile.edit', compact('user'));
    }

    /**
     * Mengupdate profil pengguna.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name'                 => ['required', 'string', 'max:255'],
            'email'                => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'university'           => ['nullable', 'string', 'max:255'],
            'bio'                  => ['nullable', 'string'],
            'student_id_card_path' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'password'             => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        // Update data dasar
        $user->name       = $request->name;
        $user->email      = $request->email;
        $user->university = $request->university;
        $user->bio        = $request->bio;

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Handle upload file KTM
        if ($request->hasFile('student_id_card_path')) {
            // Hapus file lama jika ada untuk menghemat storage
            // if ($user->student_id_card_path) {
            //     Storage::disk('public')->delete($user->student_id_card_path);
            // }
            $path                       = $request->file('student_id_card_path')->store('ktm', 'public');
            $user->student_id_card_path = $path;
            // Saat user upload KTM baru, status verifikasi direset agar admin memeriksa ulang
            $user->is_verified = false;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('status', 'Profil berhasil diperbarui!');
    }
}
