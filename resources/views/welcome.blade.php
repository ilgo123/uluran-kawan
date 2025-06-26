<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 text-center py-20">
    <h1 class="text-3xl font-bold text-green-600">Selamat Datang di Uluran Kawan</h1>
    <p class="mt-4">Anda berhasil login.</p>

    <a href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
       class="mt-6 inline-block px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
        Logout
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>
</body>
</html>
