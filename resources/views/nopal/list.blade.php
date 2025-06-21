@extends('nopal.layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4 text-center">Daftar Booking</h2>

    @php
        $menuHarga = [
            'gurami bakar' => 50000,
            'gurami goreng' => 25000,
            'gurami asam manis' => 30000,
            'bandeng presto' => 15000,
            'patin goreng' => 15000,
            'nasi putih' => 5000,
            'es teh' => 4000,
            'es jeruk' => 4000,
            'teh hangat' => 3000,
            'jeruk hangat' => 3000,
            'air mineral' => 3000,
        ];

        function hitungTotal($items, $menuHarga) {
            $total = 0;
            $rincian = [];
            foreach (explode(',', $items) as $item) {
                $parts = explode(' x', trim($item));
                if (count($parts) == 2) {
                    $nama = strtolower(trim($parts[0]));
                    $jumlah = (int) trim($parts[1]);
                    $harga = $menuHarga[$nama] ?? 0;
                    $subtotal = $harga * $jumlah;
                    $rincian[] = ucwords($nama) . " ($jumlah x Rp" . number_format($harga, 0, ',', '.') . ") = Rp" . number_format($subtotal, 0, ',', '.');
                    $total += $subtotal;
                }
            }
            return ['total' => $total, 'rincian' => $rincian];
        }
    @endphp

    @if (isset($bookings) && $bookings->count())
        <table class="w-full border-collapse border border-gray-300 shadow-lg">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="p-3 border">Nama</th>
                    <th class="p-3 border">Meja</th>
                    <th class="p-3 border">Makanan</th>
                    <th class="p-3 border">Minuman</th>
                    <th class="p-3 border">Tanggal</th>
                    <th class="p-3 border">Jam</th>
                    <th class="p-3 border">Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    @php
                        $hasilMakanan = hitungTotal($booking->makanan, $menuHarga);
                        $hasilMinuman = hitungTotal($booking->minuman, $menuHarga);
                        $grandTotal = $hasilMakanan['total'] + $hasilMinuman['total'];
                    @endphp
                    <tr>
                        <td class="p-2 border">{{ $booking->nama }}</td>
                        <td class="p-2 border">{{ $booking->meja }}</td>
                        <td class="p-2 border">{{ $booking->makanan }}</td>
                        <td class="p-2 border">{{ $booking->minuman }}</td>
                        <td class="p-2 border">{{ $booking->tanggal }}</td>
                        <td class="p-2 border">{{ $booking->jam }}</td>
                        <td class="p-2 border text-sm">
                            <div><strong>Total:</strong> Rp{{ number_format($grandTotal, 0, ',', '.') }}</div>
                            <ul class="list-disc list-inside text-gray-600">
                                @foreach ($hasilMakanan['rincian'] as $r)
                                    <li>{{ $r }}</li>
                                @endforeach
                                @foreach ($hasilMinuman['rincian'] as $r)
                                    <li>{{ $r }}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center text-gray-600 mt-4">Belum ada data booking.</p>
    @endif

    <div class="text-center mt-6">
        <a href="{{ route('booking.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Kembali ke Form Booking</a>
    </div>
</div>
@endsection
