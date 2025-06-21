<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History - Delta Fishing</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gradient-to-b from-sky-400 to-blue-600 min-h-screen">
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
                <a href="/sewa" class="-m-1.5 p-1.5 font-semibold text-md text-white hover:text-gray-300">Sewa</a>
                <a href="/about" class="-m-1.5 p-1.5 font-semibold text-md text-white hover:text-gray-300">About</a>
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
                                <a href="{{ route('admin.transactions') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Admin Dashboard</a>
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
    </header>

    <!-- Main Content -->
    <main class="pt-32 pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-lg overflow-hidden shadow-lg rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-3xl font-bold text-blue-900 mb-6">Riwayat Pembelian Anda</h2>
                
                @if($bayars->isEmpty() && (empty($bookings) || $bookings->isEmpty()))
                    <p class="text-gray-600 text-center py-4">Belum ada riwayat pembelian atau booking.</p>
                @else
                    <div class="mb-8">
                        <h3 class="text-lg font-bold mb-2 text-blue-800">Riwayat Pembelian</h3>
                        @if($bayars->isEmpty())
                            <p class="text-gray-500">Belum ada riwayat pembelian.</p>
                        @else
                        <div class="overflow-x-auto rounded-lg shadow">
                        <table class="w-full text-sm text-left text-gray-700 bg-white/80 rounded-lg">
                            <thead class="bg-gradient-to-r from-blue-200 to-blue-100 text-blue-900 font-bold">
                                <tr>
                                    <th class="p-3">Tanggal</th>
                                    <th class="p-3">Barang</th>
                                    <th class="p-3">Jumlah</th>
                                    <th class="p-3">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bayars as $bayar)
                                <tr class="hover:bg-blue-50 border-b border-blue-100">
                                    <td class="p-3">{{ $bayar->tanggal }}</td>
                                    <td class="p-3">{{ $bayar->nama_barang }}</td>
                                    <td class="p-3">{{ $bayar->jumlah }}</td>
                                    <td class="p-3 font-semibold text-blue-800">Rp {{ number_format($bayar->total_harga,0,',','.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        @endif
                    </div>
                    <div>
                        <h3 class="text-lg font-bold mb-2 text-blue-800">Riwayat Booking & Pesanan</h3>
                        @if(empty($bookings) || $bookings->isEmpty())
                            <p class="text-gray-500">Belum ada booking.</p>
                        @else
                        <div class="overflow-x-auto rounded-lg shadow">
                        <table class="w-full text-sm text-left text-gray-700 bg-white/80 rounded-lg">
                            <thead class="bg-gradient-to-r from-green-200 to-green-100 text-green-900 font-bold">
                                <tr>
                                    <th class="p-3">Tanggal</th>
                                    <th class="p-3">Jam</th>
                                    <th class="p-3">Pesanan</th>
                                    <th class="p-3">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                <tr class="hover:bg-green-50 border-b border-green-100">
                                    <td class="p-3">{{ $booking->tanggal_booking }}</td>
                                    <td class="p-3">{{ $booking->jam_booking }}</td>
                                    <td class="p-3">
                                        <ul class="list-disc ml-4">
                                            @foreach($booking->items as $item)
                                            <li>{{ $item->menu_name }} <span class="text-xs text-gray-500">x{{ $item->quantity }}</span></li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="p-3 font-semibold text-green-800">Rp {{ number_format($booking->items->sum(function($i){return $i->price * $i->quantity;}),0,',','.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        @endif
                    </div>
                @endif
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="text-center text-white/80 py-4">
        &copy; {{ date('Y') }} Delta Fishing. All Rights Reserved.
    </footer>
</body>
</html>
