@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Histori Booking</h1>
    @foreach ($bookings as $pesan)
        <div class="border rounded p-4 mb-4">
            <p><strong>Nama:</strong> {{ $booking->nama_pemesan }}</p>
            <p><strong>Jam:</strong> {{ $booking->jam_booking }}</p>
            <p><strong>Meja:</strong> {{ $booking->nomor_meja }}</p>
            <p><strong>Tanggal:</strong> {{ $booking->tanggal_booking }}</p>
            <p><strong>Menu:</strong></p>
            <ul class="ml-4 list-disc">
                @foreach ($booking->items as $item)
                    <li>{{ $item->menu_name }} x{{ $item->quantity }} - Rp{{ number_format($item->price) }}</li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
@endsection
