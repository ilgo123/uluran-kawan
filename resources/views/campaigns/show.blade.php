@extends('layouts.app')

@section('title', $campaign->title)

@section('content')
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img class="h-96 w-full object-cover" src="{{ asset('storage/' . $campaign->image_path) }}"
                        alt="{{ $campaign->title }}">
                    <div class="p-6">
                        <span
                            class="inline-block bg-emerald-100 text-emerald-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">{{ $campaign->category->name }}</span>
                        <h1 class="text-3xl font-bold text-gray-900 mt-4">{{ $campaign->title }}</h1>
                        <p class="text-sm text-gray-500 mt-2">Dibuat oleh: <span
                                class="font-medium text-gray-700">{{ $campaign->user->name }}</span></p>

                        <div class="prose max-w-none mt-6 text-gray-700">
                            {!! $campaign->description !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-24">
                    @if ($campaign->type === 'dana')
                        <p class="text-sm text-gray-500">Terkumpul</p>
                        <p class="text-3xl font-bold text-emerald-600">Rp
                            {{ number_format($campaign->current_amount, 0, ',', '.') }}</p>

                        <div class="w-full bg-gray-200 rounded-full h-2.5 mt-4">
                            @php
                                $percentage =
                                    $campaign->target_amount > 0
                                        ? ($campaign->current_amount / $campaign->target_amount) * 100
                                        : 0;
                            @endphp
                            <div class="bg-emerald-600 h-2.5 rounded-full" style="width: {{ min($percentage, 100) }}%">
                            </div>
                        </div>

                        <div class="mt-6">
                            @auth
                                <form id="donation-form">
                                    @csrf
                                    <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">
                                    <div>
                                        <label for="amount" class="block text-sm font-medium text-gray-700">Jumlah Donasi
                                            (Rp)
                                        </label>
                                        <input type="number" name="amount" id="amount"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required
                                            min="1000">
                                    </div>
                                    <button type="submit"
                                        class="w-full mt-4 text-center bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-4 rounded-lg">
                                        Donasi Sekarang
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}"
                                    class="w-full block text-center bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-4 rounded-lg">
                                    Login untuk Donasi
                                </a>
                            @endauth
                        </div>
                    @else
                        <p class="text-xl font-bold text-gray-800">Bantuan Barang Dibutuhkan</p>
                        <p class="text-lg text-emerald-600 font-medium mt-2">{{ $campaign->item_name }}</p>
                        <a href="#"
                            class="w-full mt-6 block text-center bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-4 rounded-lg">
                            Login untuk Tawarkan
                        </a>
                    @endif
                    <div class="mt-4 text-center">
                        @auth
                            <div x-data="{ open: false }">
                                <button @click="open = true" class="text-xs text-gray-500 hover:text-red-600 hover:underline">
                                    Laporkan Campaign Ini
                                </button>

                                <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
                                    style="display: none;">

                                    <div @click.away="open = false" class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">
                                        <h3 class="text-lg font-bold mb-4">Laporkan Campaign</h3>
                                        <form action="{{ route('reports.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="reportable_id" value="{{ $campaign->id }}">
                                            <input type="hidden" name="reportable_type" value="{{ get_class($campaign) }}">

                                            <div>
                                                <label for="reason" class="block text-sm font-medium text-gray-700">Alasan
                                                    Laporan</label>
                                                <textarea name="reason" id="reason" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                                    required minlength="10" placeholder="Jelaskan mengapa Anda merasa campaign ini perlu dilaporkan..."></textarea>
                                                @error('reason')
                                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="mt-6 flex justify-end space-x-4">
                                                <button type="button" @click="open = false"
                                                    class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300">Batal</button>
                                                <button type="submit"
                                                    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">Kirim
                                                    Laporan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>

            @auth
                <script type="text/javascript">
                    document.getElementById('donation-form').addEventListener('submit', function(event) {
                        event.preventDefault();

                        const formData = new FormData(this);

                        fetch('{{ route('donations.store') }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                                        'content') ?? '{{ csrf_token() }}', // Handle CSRF
                                    'Accept': 'application/json',
                                },
                                body: formData
                            }).then(response => response.json())
                            .then(data => {
                                if (data.snap_token) {
                                    window.snap.pay(data.snap_token, {
                                        // onSuccess: function(result) {
                                        //     alert("Pembayaran berhasil!");
                                        //     console.log(result);
                                        //     window.location.reload();
                                        // },
                                        onSuccess: function(result) {
                                            console.log('Pembayaran sukses di Midtrans:', result);
                                            console.log(result.order_id);

                                            // Kirim konfirmasi ke backend kita untuk update saldo
                                            fetch('{{ route('donations.success') }}', {
                                                    method: 'POST',
                                                    headers: {
                                                        'Content-Type': 'application/json',
                                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                    },
                                                    body: JSON.stringify({
                                                        order_id: result.order_id
                                                    })
                                                })
                                                .then(response => response.json())
                                                .then(data => {
                                                    console.log('Respons dari server kita:', data.message);
                                                    alert(
                                                        "Pembayaran berhasil dan saldo akan segera diupdate!"
                                                    );
                                                    window.location
                                                        .reload(); // Reload halaman untuk melihat saldo baru
                                                })
                                                .catch(error => {
                                                    console.error('Gagal mengupdate saldo:', error);
                                                    alert(
                                                        "Pembayaran berhasil, namun terjadi kesalahan saat update saldo."
                                                    );
                                                });
                                        },
                                        onPending: function(result) {
                                            alert("Pembayaran tertunda!");
                                            console.log(result);
                                        },
                                        onError: function(result) {
                                            alert("Pembayaran gagal!");
                                            console.log(result);
                                        },
                                        onClose: function() {
                                            console.log(
                                                'Pop-up pembayaran ditutup tanpa menyelesaikan transaksi');
                                        }
                                    });
                                }
                            }).catch(error => {
                                console.error('Error:', error);
                                alert('Terjadi kesalahan, silakan coba lagi.');
                            });
                    });
                </script>
            @endauth
        </div>
    </div>
@endsection
