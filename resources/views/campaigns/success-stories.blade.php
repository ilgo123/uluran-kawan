@extends('layouts.app')

@section('title', 'Kisah Sukses Campaign')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-emerald-600">Kisah Sukses</h1>
            <p class="mt-2 text-lg text-gray-600">Terima kasih kepada semua donatur. Inilah campaign yang telah berhasil mencapai tujuannya berkat Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($campaigns as $campaign)
                <x-campaign-card :campaign="$campaign"/>
            @empty
                <p class="text-center text-gray-500 col-span-3">Belum ada kisah sukses untuk ditampilkan.</p>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $campaigns->withQueryString()->links() }}
        </div>
    </div>
@endsection
