<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    // Tampilkan form register
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Proses pendaftaran user
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'university' => ['required', 'string', 'max:255'],
            'bio' => ['required', 'string', 'max:1000'],
            'ktm' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        // Simpan file KTM ke storage
        $ktmPath = $request->file('ktm')->store('ktm', 'public');
        // dd($ktmPath);

        // Simpan user baru ke database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'university' => $request->university,
            'bio' => $request->bio,
            'student_id_card_path' => $ktmPath,
        ]);

        // Redirect ke halaman login
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }
}
