@extends('layouts.app')

@section('title', 'Uluran Kawan - Platform Donasi Mahasiswa')

@section('content')
    <div class="bg-white">
        <div class="container mx-auto px-4 py-16 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800">Bantu Wujudkan Mimpi Mereka</h1>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">Satu uluran tangan Anda bisa menjadi awal dari sebuah perubahan besar bagi pendidikan dan kehidupan mahasiswa yang membutuhkan.</p>
            <a href="{{ route('campaigns.index') }}" class="mt-8 inline-block bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-8 rounded-lg text-lg">Jelajahi Campaign</a>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Campaign Terbaru</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($campaigns as $campaign)
                <x-campaign-card :campaign="$campaign"/>
            @endforeach
        </div>
    </div>
@endsection
