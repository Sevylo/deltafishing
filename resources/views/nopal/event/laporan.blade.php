@extends('nopal.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-6">Laporan Booking & Pesanan</h2>

    @foreach($bookings as $booking)
        <div class="bg-white shadow rounded mb-6 p-4">
            <h3 class="text-lg font-semibold mb-1">Nama: {{ $booking->nama_pemesan }}</h3>
            <p class="text-sm text-gray-600">Meja: {{ $booking->nomor_meja }} | 
                Tanggal: {{ $booking->tanggal_booking }} | 
                Jam: {{ $booking->jam_booking }}</p>

            <div class="mt-4">
                <p class="font-semibold mb-2">Pesanan:</p>
                <ul class="list-disc list-inside">
                    @foreach($booking->orders as $order)
                        <li>{{ $order->menu }} - Rp {{ number_format($order->harga, 0, ',', '.') }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
</div>
@endsection
