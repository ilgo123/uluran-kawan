@extends('layouts.app')

@section('content')
<div class="bg-white shadow-xl rounded-lg w-full max-w-md p-8 animate-fade-in">
    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold text-green-600">🌱 Uluran Kawan</h1>
        <p class="text-sm text-gray-500">Gabung jadi bagian dari kebaikan.</p>
    </div>

    <h2 class="text-xl font-semibold text-gray-700 text-center mb-4">Buat Akun Baru</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-medium mb-1">Nama Lengkap</label>
            <input type="text" name="name" required class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-green-400 outline-none">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" required class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-green-400 outline-none">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-medium mb-1">Password</label>
            <input type="password" name="password" required class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-green-400 outline-none">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-medium mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-green-400 outline-none">
        </div>

        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-200">
            Daftar
        </button>

        <p class="text-center text-sm mt-4">Sudah punya akun? 
            <a href="{{ route('login') }}" class="text-green-600 hover:underline">Masuk sekarang</a>
        </p>
    </form>
</div>
@endsection
