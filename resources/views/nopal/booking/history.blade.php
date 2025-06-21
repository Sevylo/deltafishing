<!-- resources/views/booking/history.blade.php -->
@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-xl font-bold mb-4">Histori Booking</h1>
    @foreach ($bookings as $booking)
        <div class="mb-4 p-4 border rounded bg-gray-50">
            <p><strong>Nama:</strong> {{ $booking->nama_pemesan }}</p>
            <p><strong>Meja:</strong> {{ $booking->nomor_meja }}</p>
            <p><strong>Tanggal:</strong> {{ $booking->tanggal_booking }}</p>
            <p><strong>Jam:</strong> {{ $booking->jam_booking }}</p>
            <ul class="mt-2 ml-4 list-disc">
                @foreach ($booking->items as $item)
                    <li>{{ $item->item_name }} x{{ $item->quantity }} - Rp{{ number_format($item->price) }}</li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
@endsection
