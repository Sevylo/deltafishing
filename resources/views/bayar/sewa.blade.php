<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penyewaan Alat Pancing | Delta Fishing</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gradient-to-b from-sky-400 to-blue-600 min-h-screen">
    <!-- Simple Navigation Bar -->
    <nav class=" fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl text-white font-bold flex items-center">
                        Delta Fishing
                    </a>
                </div>
                <div class="flex items-center space-x-8 text-semibold">
                    <a href="/" class="text-white hover:text-blue-200">Home</a>
                    <a href="/about" class="text-white hover:text-blue-200">About Us</a>
                    <a href="/gallery" class="text-white hover:text-blue-200">Galeri</a>
                    <a href="/sewa" class="text-white hover:text-blue-200">Sewa</a>
                    <a href="/event" class="text-white hover:text-blue-200">Event</a>
                    <a href="/booking" class="text-white hover:text-blue-200">Booking & Menu</a>
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center text-white hover:text-blue-200">
                                {{ Auth::user()->name }}
                                <svg class="ml-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open" 
                                 x-cloak
                                 @click.away="open = false" 
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl">
                                @if(Auth::user()->is_admin)
                                    <a href="{{ route('pages.dashboard') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-500 hover:text-white">
                                        Admin Dashboard
                                    </a>
                                @endif
                                <a href="/history" class="block px-4 py-2 text-gray-800 hover:bg-blue-500 hover:text-white">
                                    Purchase History
                                </a>
                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-blue-500 hover:text-white">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('register') }}" class="text-white hover:text-blue-200">Daftar</a>
                        <a href="{{ route('login') }}" class="text-white hover:text-blue-200">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <h1 class="text-4xl font-bold text-white mb-12 text-center">Sewa Alat Pancing & Umpan</h1>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Joran Pancing -->
            <div class="bg-white bg-opacity-90 rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105">
                <img src="https://blog-asset.jakartanotebook.com/2024/08/zhenyi-joran-pancing-spinning-2.webp" 
                     alt="Joran Pancing" 
                     class="w-full h-48 object-cover">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Joran Pancing</h2>
                    <p class="text-blue-600 font-bold text-lg mb-4">Rp 20.000 / Hari</p>
                    <a href="{{ route('bayar.create', ['barang' => 'joran_pancing', 'nama' => 'Joran Pancing', 'harga' => 20000, 'gambar' => 'https://blog-asset.jakartanotebook.com/2024/08/zhenyi-joran-pancing-spinning-2.webp']) }}"
                       class="block text-center bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">
                        Sewa Sekarang
                    </a>
                </div>
            </div>

            <!-- Joran Baitcasting -->
            <div class="bg-white bg-opacity-90 rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105">
                <img src="https://upload.jaknot.com/2023/01/images/products/cf7ee3/original/taffsport-joran-pancing-baitcasting-carbon-fiber-18m-jpa66mtf.jpg" 
                     alt="Joran Baitcasting" 
                     class="w-full h-48 object-cover">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Joran Baitcasting</h2>
                    <p class="text-blue-600 font-bold text-lg mb-4">Rp 15.000 / Hari</p>
                    <a href="{{ route('bayar.create', ['barang' => 'baitcasting', 'nama' => 'Joran Baitcasting', 'harga' => 15000, 'gambar' => 'https://upload.jaknot.com/2023/01/images/products/cf7ee3/original/taffsport-joran-pancing-baitcasting-carbon-fiber-18m-jpa66mtf.jpg']) }}"
                       class="block text-center bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">
                        Sewa Sekarang
                    </a>
                </div>
            </div>

            <!-- Umpan Patin -->
            <div class="bg-white bg-opacity-90 rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105">
                <img src="https://images.tokopedia.net/img/cache/700/product-1/2020/7/25/9217467/9217467_61e41269-7517-401d-9ea9-470bb8444227_2048_2048" 
                     alt="Umpan Ikan Patin" 
                     class="w-full h-48 object-cover">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Umpan Ikan Patin</h2>
                    <p class="text-blue-600 font-bold text-lg mb-4">Rp 25.000 / pcs</p>
                    <a href="{{ route('bayar.create', ['barang' => 'umpan_patin', 'nama' => 'Umpan Patin', 'harga' => 25000, 'gambar' => 'https://images.tokopedia.net/img/cache/700/product-1/2020/7/25/9217467/9217467_61e41269-7517-401d-9ea9-470bb8444227_2048_2048']) }}"
                       class="block text-center bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition duration-300">
                        Beli Sekarang
                    </a>
                </div>
            </div>

            <!-- Umpan Bawal -->
            <div class="bg-white bg-opacity-90 rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105">
                <img src="https://down-id.img.susercontent.com/file/ab8c0522d5d5242a34d2f43f4fe70dd2" 
                     alt="Umpan Ikan Bawal" 
                     class="w-full h-48 object-cover">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Umpan Ikan Bawal</h2>
                    <p class="text-blue-600 font-bold text-lg mb-4">Rp 35.000 / pcs</p>
                    <a href="{{ route('bayar.create', ['barang' => 'umpan_bawal', 'nama' => 'Umpan Bawal', 'harga' => 35000, 'gambar' => 'https://down-id.img.susercontent.com/file/ab8c0522d5d5242a34d2f43f4fe70dd2']) }}"
                       class="block text-center bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition duration-300">
                        Beli Sekarang
                    </a>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
