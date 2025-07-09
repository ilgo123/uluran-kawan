@extends('layouts.app')
@section('title', 'Masuk ke Akun Anda')
@section('content')
<div class="container mx-auto mt-10 mb-10 w-full max-w-md">
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Login</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Alamat Email</label>
                <input type="email" name="email" id="email" class="w-full mt-1 p-2 border rounded" value="{{ old('email') }}" required autofocus>
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="w-full mt-1 p-2 border rounded" required>
            </div>
            <button type="submit" class="w-full bg-emerald-600 text-white py-2 rounded-lg hover:bg-emerald-700">Masuk</button>
        </form>
    </div>
</div>
@endsection
