{{-- 1. BLOK @php DI ATAS INI SEBAIKNYA DIHAPUS --}}
{{-- Pengecekan login akan kita pindahkan ke file routes/web.php --}}

@extends('nopal.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-sky-400 to-blue-600 flex items-center justify-center py-10">
    <div class="w-full max-w-lg bg-white/20 backdrop-blur-sm border border-white/40 shadow-xl rounded-2xl p-8">
        {{-- Notifikasi --}}
        @if(session('success'))
        <div class="bg-green-500 bg-opacity-90 text-white p-3 rounded-lg mb-6 text-center shadow">
            {{ session('success') }}
        </div>
        @endif

        <h2 class="text-3xl font-bold text-center text-white mb-8">Form Pendaftaran Event Mancing</h2>
        {{-- Tampilkan error validasi jika ada --}}
        @if ($errors->any())
        <div class="bg-red-500 text-white p-3 rounded-lg mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        {{-- 2. UBAH 'action' AGAR MENGGUNAKAN NAMA ROUTE YANG BENAR --}}
        <form action="{{ route('nopal.event.store') }}" method="POST" class="space-y-6">
            @csrf

            <input type="hidden" name="event" value="{{ $eventId }}">

            <input type="text" name="name" placeholder="Nama Lengkap" required
                class="w-full px-4 py-3 bg-white/60 border border-white/30 rounded-lg text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">

            <input type="email" name="email" placeholder="Email" required
                class="w-full px-4 py-3 bg-white/60 border border-white/30 rounded-lg text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">

            <input type="text" name="phone" placeholder="Nomor Telepon" required
                class="w-full px-4 py-3 bg-white/60 border border-white/30 rounded-lg text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">

            <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transform hover:scale-105 transition duration-200 shadow">
                Daftar Sekarang
            </button>
        </form>

        <div class="text-center mt-8">
            <a href="{{ url('/event') }}" class="text-sm text-white/80 hover:underline">← Kembali ke halaman event</a>
        </div>
    </div>
</div>
@endsection