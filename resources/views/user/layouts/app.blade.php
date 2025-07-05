<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uluran Kawan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-blue-600">Uluran Kawan</div>
            <nav class="flex space-x-6">
                <a href="/" class="font-medium text-gray-900 hover:text-blue-600 transition">Beranda</a>
                <a href="/campaigns" class="font-medium text-blue-600">Campaigns</a>
                <a href="#" class="font-medium text-gray-900 hover:text-blue-600 transition">Masuk</a>
                <a href="#" class="font-medium text-gray-900 hover:text-blue-600 transition">Daftar</a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>
