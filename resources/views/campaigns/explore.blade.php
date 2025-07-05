@extends('layouts.app')

@section('content')
    <div class="bg-gray-50 min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-sm">
            <div class="container mx-auto px-4 py-4 flex justify-between items-center">
                <div class="text-xl font-bold text-green-600">Uluran Kawan</div>

                <nav class="flex-1 flex justify-center space-x-8">
                    <a href="#" class="font-medium text-center text-gray-900">Beranda</a>
                    <a href="{{ route('campaigns.home') }}" class="font-medium text-center text-green-600">Campaigns</a>
                </nav>

                <div>
                    <a href="#" class="font-medium text-gray-900">Masuk</a>
                    <a href="#"
                        class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg shadow">Daftar</a>
                </div>
            </div>
        </header>


        <!-- Campaigns Explore Sections -->
        <section class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-6 text-center text-green-600">Semua Campaign Aktif</h1>


            <!-- Search -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row gap-4 mb-4">
                    <div class="relative flex-grow">
                        <input type="text" placeholder="Cari judul campaign..."
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button class="absolute right-2 top-2 text-gray-400 hover:text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <button class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 transition">
                        Cari
                    </button>
                </div>

                <!-- Filter Kategori -->
                <div class="flex flex-wrap items-center gap-2 mb-8 justify-center">
                    <button
                        class="px-4 py-2 bg-green-600 text-white rounded-full hover:bg-green-700 focus:outline-none">Semua</button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200">Biaya Pendidikan</button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200">Buku & Alat Belajar</button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200">Penelitian & Skripsi</button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200">Biaya Kost & Hidup</button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200">Kesehatan & Medis</button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200">Perangkat Belajar</button>
                    <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200">Lain-lain</button>
                </div>


                <!-- Campaign Cards Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($allCampaigns as $campaign)
                        @include('components.campaign-card', ['campaign' => $campaign])
                    @endforeach
                </div>


                <!-- Categories -->
                <div class="flex flex-wrap gap-2">
                    @foreach ($categories as $category)
                        <button
                            class="px-4 py-1 rounded-full border text-sm
                                {{ $loop->first ? 'bg-blue-500 text-white border-blue-500' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-100' }}">
                            {{ $category }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Campaign Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($allCampaigns as $campaign)
                    <x-campaign-card :campaign="$campaign" />
                @endforeach
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-white py-6 border-t">
            <div class="container mx-auto px-4 text-center text-gray-500 text-sm">
                © 2025 Uluran Kawan. Semua Hak Cipta Dilindungi.
            </div>
        </footer>
    </div>
@endsection
