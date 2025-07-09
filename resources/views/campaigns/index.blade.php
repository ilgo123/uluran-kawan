@extends('layouts.app')

@section('title', 'Jelajahi Semua Campaign')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold text-center text-gray-800">Semua Campaign Aktif</h1>

        <div class="max-w-xl mx-auto my-8">
            <form action="{{ route('campaigns.index') }}" method="GET" class="flex items-center">
                <input type="text" name="cari" placeholder="Cari judul campaign..." value="{{ request('cari') }}" class="w-full px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                <button type="submit" class="bg-emerald-600 text-white px-6 py-2 rounded-r-lg hover:bg-emerald-700">Cari</button>
            </form>
        </div>

        <div class="flex justify-center flex-wrap gap-2 mb-10">
            <a href="{{ route('campaigns.index') }}" 
               class="px-4 py-2 rounded-full text-sm font-semibold
                      {{ !request('kategori') ? 'bg-emerald-600 text-white' : 'bg-white hover:bg-emerald-100 text-gray-700 border' }}">
                Semua
            </a>
            @foreach($categories as $category)
                <a href="{{ route('campaigns.index', ['kategori' => $category->slug]) }}"
                   class="px-4 py-2 rounded-full text-sm font-semibold
                          {{ request('kategori') == $category->slug ? 'bg-emerald-600 text-white' : 'bg-white hover:bg-emerald-100 text-gray-700 border' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>

        @if(request('cari'))
            <h2 class="text-xl text-center text-gray-700 mb-8">
                Hasil pencarian untuk: <span class="font-bold">"{{ request('cari') }}"</span>
            </h2>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($campaigns as $campaign)
                <x-campaign-card :campaign="$campaign"/>
            @empty
                <div class="col-span-3 text-center text-gray-500 py-10">
                    <h3 class="text-xl font-semibold">Tidak Ada Campaign Ditemukan</h3>
                    <p class="mt-2">Coba ganti kata kunci pencarian atau filter kategori Anda.</p>
                    <a href="{{ route('campaigns.index') }}" class="mt-4 inline-block text-emerald-600 hover:underline">Lihat Semua Campaign</a>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{-- withQueryString() penting agar filter tetap aktif saat pindah halaman --}}
            {{ $campaigns->withQueryString()->links() }}
        </div>
    </div>
@endsection