@extends('layouts.app')

@section('title', 'Dashboard Saya')

@section('content')
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Dashboard Saya</h1>
                <p class="text-gray-600">Selamat datang kembali, {{ Auth::user()->name }}!</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-gray-500 text-sm font-medium">Campaign Dibuat</h3>
                    <p class="text-3xl font-bold text-emerald-600 mt-2">{{ count($myCampaigns) }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-gray-500 text-sm font-medium">Donasi Diberikan</h3>
                    <p class="text-3xl font-bold text-emerald-600 mt-2">{{ count($myDonations) }}</p>
                </div>
                <a href="{{ route('campaigns.create') }}"
                    class="bg-emerald-500 text-white p-6 rounded-lg shadow flex flex-col justify-center items-center hover:bg-emerald-600 transition">
                    <span class="text-3xl font-bold">+</span>
                    <span class="mt-1 font-semibold">Buat Campaign Baru</span>
                </a>
            </div>

            <div class="mt-8 bg-white overflow-hidden shadow rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Campaign Saya</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Terkumpul
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($myCampaigns as $campaign)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $campaign->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if ($campaign->status == 'active') bg-green-100 text-green-800 @elseif($campaign->status == 'pending') bg-yellow-100 text-yellow-800 @else bg-gray-100 text-gray-800 @endif">
                                                {{ ucfirst($campaign->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if ($campaign->type === 'dana')
                                                Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}
                                            @else
                                                <span class="font-semibold text-gray-700">Barang</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('campaigns.edit', $campaign) }}"
                                                class="text-emerald-600 hover:text-emerald-900">Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Anda belum
                                            membuat campaign.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Riwayat Donasi Saya</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Campaign
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                    {{-- <-- Kolom Baru --}}
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($myDonations as $donation)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <a href="{{ route('campaigns.show', $donation->campaign) }}"
                                                class="text-emerald-600 hover:underline">
                                                {{ $donation->campaign->title }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-700">
                                            Rp {{ number_format($donation->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $donation->created_at->format('d M Y, H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if (Auth::user()->canReview($donation->campaign))
                                                <a href="{{ route('reviews.create', $donation->campaign) }}"
                                                    class="text-blue-600 hover:text-blue-900">Beri Ulasan</a>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Anda belum
                                            pernah memberikan donasi.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
