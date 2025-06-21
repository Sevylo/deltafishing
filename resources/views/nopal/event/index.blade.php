@extends('nopal.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-sky-400 to-blue-600">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <nav class="fixed w-full top-0 z-50 bg-blue-400/30 backdrop-blur-sm border-b border-white/20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl text-white font-bold flex items-center">
                        Delta Fishing
                    </a>
                </div>
                <div class="hidden sm:flex items-center space-x-8 text-semibold">
                    <a href="/about" class="text-white hover:text-blue-200">About</a>
                    <a href="/gallery" class="text-white hover:text-blue-200">Gallery</a>
                    <a href="/sewa" class="text-white hover:text-blue-200">Sewa</a>
                    <a href="/event" class="text-white hover:text-blue-200 ">Event</a>
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
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-1">
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-500 hover:text-white">
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

    <div class="max-w-5xl mx-auto pt-28 px-4 sm:px-6 lg:px-8 pb-12">
        <h1 class="text-4xl font-bold text-white mb-10 text-center">Daftar Event Delta Fishing</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 ">
            {{-- Event 1 --}}
            <div class="bg-white/20 backdrop-blur-sm rounded-2xl shadow-xl border border-white/50 overflow-hidden flex flex-col">
                <div class="p-8 flex-1 flex flex-col">
                    <h2 class="text-2xl font-bold text-white mb-2">Event Lomba Memancing 2025</h2>
                    <p class="text-white/90 mb-4">Bergabunglah dalam Event Lomba Memancing 2025! Acara ini akan diadakan di Danau Indah pada tanggal 16-17 April 2025. Lomba ini terbuka untuk semua kalangan, baik pemula maupun profesional. Siapkan peralatan memancing terbaikmu dan tunjukkan kemampuanmu!</p>
                    <ul class="text-white/90 space-y-2 mb-6">
                        <li>• Peserta harus mendaftar sebelum tanggal 16 April 2025</li>
                        <li>• Setiap peserta diperbolehkan membawa peralatan memancing sendiri</li>
                        <li>• Umpan yang digunakan harus ramah lingkungan</li>
                        <li>• Peserta harus mematuhi semua peraturan yang ditetapkan oleh panitia</li>
                    </ul>
                    <div class="mt-auto flex flex-col gap-2">
                        @auth
                            <a href="{{ url('/event/daftar?event=1') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">Daftar Sekarang</a>
                        @else
                            <a href="{{ route('login') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">Login untuk Mendaftar</a>
                        @endauth
                        <a href="{{ url('/event/peserta?event=1') }}" class="inline-block bg-cyan-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-cyan-700 transition">Lihat Daftar Peserta</a>
                    </div>
                </div>
            </div>
            {{-- Event 2 --}}
            <div class="bg-white/20 backdrop-blur-sm rounded-2xl shadow-xl border border-white/50 overflow-hidden flex flex-col">
                <div class="p-8 flex-1 flex flex-col">
                    <h2 class="text-2xl font-bold text-white mb-2">Kompetisi Strike Mania 2025</h2>
                    <p class="text-white/90 mb-4">Ayo uji adrenalinmu di Kompetisi Strike Mania 2025! Diselenggarakan di Sungai Bahagia pada 10 Mei 2025, event ini menantang para pemancing untuk mendapatkan ikan terbesar dan terbanyak. Cocok untuk semua usia dan tingkat keahlian.</p>
                    <ul class="text-white/90 space-y-2 mb-6">
                        <li>• Pendaftaran dibuka hingga 8 Mei 2025</li>
                        <li>• Peserta wajib membawa alat pancing sendiri</li>
                        <li>• Penilaian berdasarkan berat dan jumlah ikan hasil tangkapan</li>
                        <li>• Dilarang menggunakan bahan kimia atau alat ilegal</li>
                    </ul>
                    <div class="mt-auto flex flex-col gap-2">
                        @auth
                            <a href="{{ url('/event/daftar?event=2') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">Daftar Sekarang</a>
                        @else
                            <a href="{{ route('login') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">Login untuk Mendaftar</a>
                        @endauth
                        <a href="{{ url('/event/peserta?event=2') }}" class="inline-block bg-cyan-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-cyan-700 transition">Lihat Daftar Peserta</a>
                    </div>
                </div>
            </div>
            {{-- Event 3 --}}
            <div class="bg-white/20 backdrop-blur-sm rounded-2xl shadow-xl border border-white/50 overflow-hidden flex flex-col">
                <div class="p-8 flex-1 flex flex-col overflow-y-auto">
                    <h2 class="text-2xl font-bold text-white mb-2">Fun Fishing Family Day</h2>
                    <p class="text-white/90 mb-4">Nikmati hari seru bersama keluarga di Fun Fishing Family Day! Acara ini akan digelar di Kolam Ceria pada 21 Juli 2025. Tersedia berbagai hadiah menarik untuk keluarga yang berhasil menangkap ikan terbanyak bersama-sama.</p>
                    <ul class="text-white/90 space-y-2 mb-6">
                        <li>• Pendaftaran ditutup 19 Juli 2025</li>
                        <li>• Setiap tim membawa alat pancing sendiri</li>
                        <li>• Hadiah untuk kategori keluarga dan anak-anak</li>
                    </ul>
                    <div class="mt-auto flex flex-col gap-2">
                        @auth
                            <a href="{{ url('/event/daftar?event=3') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">Daftar Sekarang</a>
                        @else
                            <a href="{{ route('login') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">Login untuk Mendaftar</a>
                        @endauth
                        <a href="{{ url('/event/peserta?event=3') }}" class="inline-block bg-cyan-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-cyan-700 transition">Lihat Daftar Peserta</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection