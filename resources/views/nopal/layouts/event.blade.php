<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Lomba Mancing</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased">

    {{-- Navbar (opsional, bisa dikembangkan lagi) --}}
    <nav class="bg-blue-700 text-white py-4 shadow">
        <div class="max-w-6xl mx-auto px-4 flex justify-between items-center">
            <h1 class="text-lg font-semibold">Lomba Mancing</h1>
            <div class="space-x-4">
                <a href="{{ url('/event') }}" class="hover:underline">Home</a>
                <a href="{{ url('/event/peserta') }}" class="hover:underline">Peserta</a>
            </div>
        </div>
    </nav>

    {{-- Konten --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer (opsional) --}}
    <footer class="text-center text-gray-600 py-6 text-sm mt-16">
        &copy; {{ date('Y') }} Event Mancing. All rights reserved.
    </footer>

</body>
</html>
