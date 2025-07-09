<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Uluran Kawan" class="h-8 w-auto">
                <span class="text-xl font-bold text-emerald-600">Uluran Kawan</span>
            </a>
            <div class="hidden md:flex items-center space-x-6">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-emerald-600">Beranda</a>
                <a href="{{ route('campaigns.index') }}" class="text-gray-600 hover:text-emerald-600">Campaigns</a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="/login" class="text-gray-600 hover:text-emerald-600">Masuk</a>
                <a href="/register" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded-lg">Daftar</a>
            </div>
        </div>
    </div>
</nav>
