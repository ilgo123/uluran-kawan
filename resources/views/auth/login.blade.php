@extends('layouts.app')

@section('content')
<div class="bg-white shadow-xl rounded-lg w-full max-w-md p-8 animate-fade-in">
    <div class="text-center mb-6">
        <h1 class="text-3xl font-bold text-green-600">🌱 Uluran Kawan</h1>
        <p class="text-sm text-gray-500">Satu aksi kecil bisa jadi harapan besar.</p>
    </div>

    <h2 class="text-xl font-semibold text-gray-700 text-center mb-4">Login ke Akunmu</h2>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4 text-sm">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" required class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-green-400 outline-none">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-medium mb-1">Password</label>
            <input type="password" name="password" required class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-green-400 outline-none">
        </div>

        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-200">
            Masuk
        </button>

        <p class="text-center text-sm mt-4">Belum punya akun? 
            <a href="{{ route('register') }}" class="text-green-600 hover:underline">Daftar di sini</a>
        </p>
    </form>
</div>
@endsection
