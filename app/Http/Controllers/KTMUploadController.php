<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KTMUploadController extends Controller
{
    public function showForm()
    {
        return view('ktm.upload');
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'student_id_card' => 'required|image|max:2048',
        ]);

        $user = Auth::user();
        $path = $request->file('student_id_card')->store('student-id-cards', 'public');

        $user->update([
            'student_id_card_path' => $path,
            'is_verified' => false,
        ]);

        return redirect()->route('ktm.form')->with('success', 'KTM berhasil diunggah. Menunggu verifikasi admin.');
    }
}
