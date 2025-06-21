<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Menu;

class OrderController extends Controller
{
    public function index()
    {
        return view('nopal.orders.pesan');
    }

    public function rincian()
    {
        return view('nopal.rincian');
    }

    public function simpan(Request $request)
    {
        $booking_id = session('booking_id');
        if (!$booking_id) {
            return redirect()->route('booking')->with('error', 'Booking tidak ditemukan.');
        }

        $orders = $request->input('orders');

        foreach ($orders as $order) {
            Order::create([
                'nama_menu' => $order['nama'],
                'harga' => $order['harga'],
                'jumlah' => $order['jumlah'],
                'subtotal' => $order['harga'] * $order['jumlah'],
            ]);
        }

        return redirect()->route('laporan')->with('success', 'Pesanan berhasil disimpan.');
    }
public function pesan()
{
    $menus = Menu::all(); // Ambil semua menu dari tabel 'menus'
    return view('orders.pesan', compact('menus'));
}



}
