<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sejarah Kami | Delta Fishing</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-b from-sky-400 to-blue-600 text-gray-800">
    <!-- Navigation -->
    <header class="absolute inset-x-0 top-0 z-50">
        <nav class="container mx-auto flex items-center justify-between p-6 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <a href="/" class="-m-1.5 p-1.5 font-bold text-xl text-white">
                    Delta Fishing
                </a>
            </div>
            <div class="flex lg:flex-1 justify-end gap-x-6 items-center">
                <a href="/gallery" class="-m-1.5 p-1.5 font-semibold text-md text-white hover:text-gray-300">Gallery</a>
                <!-- <a href="/bayar" class="-m-1.5 p-1.5 font-semibold text-md text-white hover:text-gray-300">Bayar</a> -->
                <a href="/sewa" class="-m-1.5 p-1.5 font-semibold text-md text-white hover:text-gray-300">Sewa</a>
                <a href="/about" class="-m-1.5 p-1.5 font-semibold text-md text-white hover:text-gray-300">About</a>
                <!-- <a href="/chart" class="-m-1.5 p-1.5 font-semibold text-md text-white hover:text-gray-300">Chart</a> -->
                <a href="/event" class="-m-1.5 p-1.5 font-semibold text-md text-white hover:text-gray-300">Event</a>
                <a href="/booking" class="-m-1.5 p-1.5 font-semibold text-md text-white hover:text-gray-300">Booking & Menu</a>
                @auth
                    <a href="{{ route('bayar.history') }}" class="-m-1.5 p-1.5 font-semibold text-md text-white hover:text-gray-300">History</a>
                    <div class="relative ml-3" x-data="{ open: false }">
                        <button @click="open = !open" type="button" class="flex text-white hover:text-gray-300">
                            <span class="sr-only">Open user menu</span>
                            <span class="text-md font-semibold">{{ Auth::user()->name }}</span>
                            <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                            @if(Auth::user()->is_admin)
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Admin Dashboard</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" class="block w-full">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Log out</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-white hover:text-gray-300">Log in</a>
                    <a href="{{ route('register') }}" class="text-sm font-semibold text-white hover:text-gray-300">Register</a>
                @endauth
            </div>
        </nav>
    </header>    <!-- Main Content -->
    <main class="pt-32 pb-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-lg rounded-lg shadow-lg overflow-hidden">
                <div class="p-8">
                    <section class="mb-12">
                        <h2 class="text-3xl font-bold mb-4 text-blue-900">Tentang Kami</h2>
                        <div class="border-b-4 border-blue-500 w-16 mb-6"></div>
            <p class="mb-6 text-justify">
                Delta Fishing Sidoarjo adalah tempat wisata berkonsep pemancingan dengan pemandangan alami pepohonan asri.

Wisata ini cocok dikunjungi oleh keluarga. Ayah, istri, dan anak bisa memancing ikan, lalu menikmati hasil tangkapannya dengan mengolahnya menjadi masakan lezat.

Daya tarik lainnya, di Delta Fishing Sidoarjo juga terdapat fasilitas permainan, seperti sepeda air di danau, kolam renang, dan peralatan outbound.

Tertarik berkunjung ke Delta Fishing? 

            </p>
            <p>Untuk memenuhi kepuasan seluruh manding, kami menyediakan fasilitas sebagai berikut:</p>
            <ul class="list-disc list-inside ml-6 mb-6">
                <li>Kolam pemancingan Galatama</li>
                <li>Kolam pemancingan Gelojoh</li>
                <li>Kantin</li>
                <li>Musholla</li>
                <li>Parkir kendaraan yang luas</li>
            </ul>
        </section>
        
        <section class="mb-12">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-6 md:mb-0">
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-blue-500 text-2xl mr-4"></i>
                            <div>
                                <h3 class="font-bold">Dibangun dengan Penuh Dedikasi</h3>
                                <p>Seluruh fasilitas yang dibangun dengan penuh jiwa dan semangat.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-blue-500 text-2xl mr-4"></i>
                            <div>
                                <h3 class="font-bold">Tempat Yang Nyaman</h3>
                                <p>Tempat yang luas dan nyaman dengan lokasi yang strategis dan ramah lingkungan.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check-circle text-blue-500 text-2xl mr-4"></i>
                            <div>
                                <h3 class="font-bold">Suasana Santai</h3>
                                <p>Anda bisa bersantai dan bercengkrama dengan sesama pemancing dan keluarga.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="md:w-1/2">
                    <img src="https://salsawisata.com/wp-content/uploads/2023/02/wahana-air-Delta-Fishing.jpg" class="rounded-lg shadow-lg">
                </div>
            </div>
        </section>
        
        <!--  -->
      
        <section>
            <h2 class="text-3xl font-bold mb-4">Lokasi Kami</h2>
            <div class="border-b-4 border-blue-500 w-16 mb-6"></div>
            <p class="mb-6 text-justify">
                Lokasi Delta Fishing Sidoarjo berada di Jalan Mbah Sholeh Nomor 1, Prasungtambak, Prasung, Kecamatan Buduran, Kabupaten Sidoarjo, Jawa Timur 61252.
            </p>
        

            <div class="w-full flex justify-center">
                <div class="w-[50%] h-[200px] rounded-lg overflow-hidden shadow-lg">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.3208187313685!2d112.75193650000001!3d-7.4297055!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e684ffffffff%3A0x93663aaf5a5944e1!2sDelta%20Fishing!5e0!3m2!1sid!2sid!4v1744808280839!5m2!1sid!2sid" 
                        width="100%"
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </section>
        
      
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="text-center text-white/80 py-8">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <h4 class="text-xl font-bold mb-4">Jam Buka</h4>
                    <p class="text-sm">
                        Jam buka Delta Fishing Sidoarjo pukul 09.00-17.00 WIB setiap hari.
                    </p>
                </div>

                <div>
                    <h4 class="text-xl font-bold mb-4">Navigasi</h4>
                    <ul class="text-sm space-y-2">
                        <li><a href="/" class="hover:text-white">Beranda</a></li>
                        <li><a href="/about" class="hover:text-white">Tentang Kami</a></li>
                        <li><a href="/contact" class="hover:text-white">Kontak</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xl font-bold mb-4">Ikuti Kami</h4>
                    <div class="flex justify-center space-x-4">
                        <a href="#" class="hover:text-white text-xl"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="hover:text-white text-xl"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="hover:text-white text-xl"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>

            <div class="text-sm">
                &copy; {{ date('Y') }} Delta Fishing. Semua Hak Dilindungi.
            </div>
        </div>
    </footer>
</body>
</html>