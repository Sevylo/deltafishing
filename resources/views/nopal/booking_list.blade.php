@extends('nopal.layouts.app')

@section('content')
{{-- Latar belakang gradien untuk seluruh halaman --}}
<div class="min-h-screen bg-gradient-to-b from-sky-400 to-blue-600 py-12 px-4">
    <main class="max-w-5xl mx-auto pt-20">

        {{-- Kartu Kaca sebagai Pembungkus Utama --}}
        <div class="bg-white/20 backdrop-blur-sm border border-white/30 shadow-xl rounded-2xl">
            <div class="p-6">
                {{-- Header Halaman --}}
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 border-b border-white/20 pb-4">
                    <h2 class="text-2xl font-bold text-white">Daftar Booking & Pesanan</h2>
                    <a href="/" class="mt-2 sm:mt-0 inline-block bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg shadow transition-colors">
                        ← Kembali ke Home
                    </a>
                </div>

                {{-- Notifikasi Sukses --}}
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-500/80 text-white rounded-lg text-center">{{ session('success') }}</div>
                @endif
                
                {{-- Tabel Kaca --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-white">
                        <thead class="text-xs text-white/80 uppercase bg-white/10">
                            <tr>
                                <th scope="col" class="px-6 py-3">Nama Pemesan</th>
                                <th scope="col" class="px-6 py-3">Tanggal & Jam</th>
                                <th scope="col" class="px-6 py-3">Pesanan Menu</th>
                                <th scope="col" class="px-6 py-3 text-right">Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                                <tr class="border-b border-white/20 hover:bg-white/10">
                                    <td class="px-6 py-4 font-medium">
                                        {{ $booking->nama_pemesan }}
                                        <span class="block text-xs text-white/70">{{ $booking->telepon }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M Y') }}
                                        <span class="block text-xs text-white/70">{{ \Carbon\Carbon::parse($booking->jam_booking)->format('H:i') }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <ul class="space-y-1">
                                            @foreach($booking->items as $item)
                                                <li>
                                                    <span class="font-semibold">{{ $item->menu_name }}</span>
                                                    <span class="text-white/80">x{{ $item->quantity }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-right">
                                        Rp {{ number_format($booking->items->sum(function($i){return $i->price * $i->quantity;}),0,',','.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-8 text-white/70">
                                        Belum ada data booking.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection