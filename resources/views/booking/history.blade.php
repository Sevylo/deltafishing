@extends('nopal.layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">History Booking & Pesanan Anda</h2>
    @if($bookings->isEmpty())
        <div class="text-gray-500">Belum ada booking yang tercatat.</div>
    @else
    <table class="w-full border text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">Tanggal</th>
                <th class="p-2 border">Jam</th>
                <th class="p-2 border">Pesanan</th>
                <th class="p-2 border">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td class="p-2 border">{{ $booking->tanggal_booking }}</td>
                <td class="p-2 border">{{ $booking->jam_booking }}</td>
                <td class="p-2 border">
                    <ul>
                        @foreach($booking->items as $item)
                        <li>{{ $item->menu_name }} x{{ $item->quantity }}</li>
                        @endforeach
                    </ul>
                </td>
                <td class="p-2 border font-semibold">
                    Rp {{ number_format($booking->items->sum(function($i){return $i->price * $i->quantity;}),0,',','.') }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    <div class="mt-6 text-center">
        <a href="/" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">Kembali ke Home</a>
    </div>
</div>
@endsection
