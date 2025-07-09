@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8 max-w-2xl">

        <h2 class="text-2xl font-bold mb-6">Buat Campaign Baru</h2>

        {{-- Global Error --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('campaigns.store') }}" method="POST">
            @csrf

            <!-- Judul Campaign -->
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-semibold mb-2">Judul Campaign</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-green-500"
                    required placeholder="Masukkan judul campaign...">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                <textarea name="description" id="description" rows="5"
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-green-500"
                    placeholder="Ceritakan tentang campaign ini...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Target Dana -->
            <div class="mb-4">
                <label for="target_amount" class="block text-gray-700 font-semibold mb-2">Target Dana (Rp)</label>
                <input type="number" name="target_amount" id="target_amount" value="{{ old('target_amount') }}"
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-green-500"
                    required placeholder="Contoh: 10000000">
                @error('target_amount')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal Mulai -->
            <div class="mb-4">
                <label for="start_date" class="block text-gray-700 font-semibold mb-2">Tanggal Mulai</label>
                <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}"
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-green-500"
                    required>
                @error('start_date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal Berakhir -->
            <div class="mb-6">
                <label for="end_date" class="block text-gray-700 font-semibold mb-2">Tanggal Berakhir</label>
                <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"
                    class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:border-green-500"
                    required>
                @error('end_date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Submit -->
            <div>
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded shadow">
                    Simpan Campaign
                </button>
            </div>

        </form>

    </div>
@endsection
