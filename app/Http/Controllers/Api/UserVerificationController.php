<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserVerificationController extends Controller
{
    // Upload KTM oleh pengguna
    public function uploadKTM(Request $request)
    {
        $request->validate([
            'student_id_card' => 'required|image|max:10240',
        ]);

        $user = $request->user();

        // Simpan file
        $path = $request->file('student_id_card')->store('student-id-cards', 'public');

        // Update user
        $user->update([
            'student_id_card_path' => $path,
            'is_verified' => false,
        ]);

        return response()->json([
            'message' => 'KTM berhasil diunggah. Menunggu verifikasi admin.',
            'student_id_card_url' => Storage::url($path),
        ]);
    }
}