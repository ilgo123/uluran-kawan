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
                <a href="{{ route('campaigns.success') }}" class="text-gray-600 hover:text-emerald-600">Kisah Sukses</a>
            </div>
            <div class="flex items-center space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-emerald-600">Masuk</a>
                    <a href="{{ route('register') }}"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded-lg">Daftar</a>
                @endguest
                @auth
                    <div class="flex items-center space-x-6">
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open"
                                class="relative text-gray-500 hover:text-emerald-600 focus:outline-none">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                    </path>
                                </svg>
                                @if ($unreadNotifications->isNotEmpty())
                                    <span
                                        class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
                                @endif
                            </button>

                            <div x-show="open" @click.away="open = false"
                                class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg py-1 z-50"
                                style="display: none;">
                                <div class="px-4 py-2 font-bold border-b">Notifikasi</div>
                                @forelse ($unreadNotifications as $notification)
                                    <a href="{{ $notification->data['url'] ?? '#' }}"
                                        class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 border-b">
                                        <p class="font-semibold">{{ $notification->data['title'] }}</p>
                                        <p class="text-gray-600">{{ $notification->data['message'] }}</p>
                                        <p class="text-xs text-gray-400 mt-1">
                                            {{ $notification->created_at->diffForHumans() }}</p>
                                    </a>
                                @empty
                                    <p class="px-4 py-3 text-sm text-gray-500">Tidak ada notifikasi baru.</p>
                                @endforelse
                            </div>
                        </div>

                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open"
                                class="flex items-center space-x-2 text-gray-700 font-semibold hover:text-emerald-600 focus:outline-none">
                                <span>Hi, {{ Auth::user()->name }}</span>
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50"
                                style="display: none;">
                                <a href="{{ route('dashboard') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil Saya</a>
                                <hr class="my-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Logout</a>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
