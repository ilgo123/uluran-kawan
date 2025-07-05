@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="bg-green-600 text-white py-12 px-4">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-4">Bantu Wujudkan Mimpi Mereka</h1>
        <p class="text-xl mb-8">
            Satu uluran tangan Anda bisa menjadi awal dari sebuah perubahan besar bagi<br>
            pendidikan dan kehidupan mahasiswa yang membutuhkan.
        </p>
        <a href="/campaigns/explore" class="inline-block bg-white text-green-600 px-6 py-3 rounded-md font-medium hover:bg-gray-100 transition duration-200">
            Jelajahi Campaign
        </a>
    </div>
</section>

<!-- Campaign Terbaru -->
<section class="container mx-auto px-4 py-12">
    <h2 class="text-2xl font-bold mb-8">Campaign Terbaru</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Campaign 1 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
            <div class="bg-gray-200 h-40 flex items-center justify-center text-gray-500">
                [Gambar Campaign]
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-semibold text-lg">Test update</h3>
                    <button class="text-gray-400 hover:text-gray-600">
                        👁️
                    </button>
                </div>
                <p class="text-gray-600 text-sm mb-3">Fuga recusandae omnis quam perspiciatis eaque in...</p>
                <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                    <div class="bg-green-500 h-2 rounded-full" style="width: 45%"></div>
                </div>
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-bold">Rp 454.999</p>
                        <p class="text-gray-500 text-xs">terkumpul dari Rp 1,000,000</p>
                    </div>
                    <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-1 rounded-md text-sm transition duration-200">
                        VOTE
                    </button>
                </div>
            </div>
        </div>

        <!-- Campaign 2 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
            <div class="bg-gray-200 h-40 flex items-center justify-center text-gray-500">
                [Gambar Campaign]
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-semibold text-lg">Ut dolore minima</h3>
                    <button class="text-gray-400 hover:text-gray-600">
                        👁️
                    </button>
                </div>
                <p class="text-gray-600 text-sm mb-3">Este sunt facere ducimus et sed et...</p>
                <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                    <div class="bg-green-500 h-2 rounded-full" style="width: 60%"></div>
                </div>
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-bold">Rp 608.384</p>
                        <p class="text-gray-500 text-xs">terkumpul dari Rp 1,000,000</p>
                    </div>
                    <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-1 rounded-md text-sm transition duration-200">
                        VOTE
                    </button>
                </div>
            </div>
        </div>

        <!-- Campaign 3 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
            <div class="bg-gray-200 h-40 flex items-center justify-center text-gray-500">
                [Gambar Campaign]
            </div>
            <div class="p-4">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-semibold text-lg">Perspiciatis eaque</h3>
                    <button class="text-gray-400 hover:text-gray-600">
                        👁️
                    </button>
                </div>
                <p class="text-gray-600 text-sm mb-3">Rip 1,066.502 terkumpul dari Rp 5,000,000</p>
                <div class="w-full bg-gray-200 rounded-full h-2 mb-2">
                    <div class="bg-green-500 h-2 rounded-full" style="width: 21%"></div>
                </div>
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-bold">Rp 1.066.502</p>
                        <p class="text-gray-500 text-xs">terkumpul dari Rp 5,000,000</p>
                    </div>
                    <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-1 rounded-md text-sm transition duration-200">
                        VOTE
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-white py-6 border-t">
    <div class="container mx-auto px-4 text-center text-gray-500 text-sm">
        © 2025 Uluran Kawan. Semua Hak Cipta Dilindungi.
    </div>
</footer>
@endsection
