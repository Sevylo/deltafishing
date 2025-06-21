<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\BookingItem;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $cart = json_decode($request->input('cart'), true);
        if (empty($cart) || !is_array($cart) || count($cart) === 0) {
            return back()->with('error', 'Keranjang pesanan kosong!');
        }
        $userId = auth()->check() ? auth()->id() : null;
        $booking = Booking::create([
            'nama_pemesan' => $request->nama,
            'nomor_meja' => $request->telepon ?? '-', // Bisa diganti jika ada field nomor meja
            'tanggal_booking' => $request->tanggal,
            'jam_booking' => $request->jam,
            'user_id' => $userId
        ]);
        foreach ($cart as $item) {
            BookingItem::create([
                'booking_id' => $booking->id,
                'menu_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['qty']
            ]);
        }
        return redirect()->route('booking.list')->with('success', 'Booking & pesanan berhasil disimpan!');
    }


    public function laporan()
    {
        $data = Booking::with('orders')->get();
        return view('laporan', compact('data'));
    }

    public function history()
    {
        $userId = auth()->id();
        $bookings = Booking::with('items')
            ->where('user_id', $userId)
            ->latest()->get();
        return view('booking.history', compact('bookings'));
    }

    public function index()
    {
        $userId = auth()->user()->id;
        $bookings = Booking::with('items')
            ->where('user_id', $userId)
            ->latest()->get();
        return view('nopal.booking_list', compact('bookings'));
    }

    /**
     * Admin: Menampilkan master table bookings dengan relasi items dan user
     */
    public function adminIndex()
    {
        $bookings = Booking::with(['items', 'user'])->latest()->paginate(10);
        return inertia('Admin/Bookings/Index', [
            'bookings' => $bookings
        ]);
    }

    /**
     * Admin: Edit booking (dan relasi items)
     */
    public function adminEdit(Booking $booking)
    {
        $booking->load(['items', 'user']);
        $menus = \App\Models\Menu::all(['id','name','price']);
        return inertia('Admin/Bookings/Edit', [
            'booking' => $booking,
            'menus' => $menus,
        ]);
    }

    /**
     * Admin: Edit booking item (opsional, jika ingin halaman edit item terpisah)
     */
    public function adminEditItem(BookingItem $bookingItem)
    {
        $bookingItem->load('booking');
        return inertia('Admin/Bookings/EditItem', [
            'bookingItem' => $bookingItem
        ]);
    }

    /**
     * Admin: Hapus booking
     */
    public function adminDestroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('message', 'Booking deleted successfully');
    }

    /**
     * Admin: Update booking
     */
    public function adminUpdate(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'tanggal_booking' => 'required|date',
            'jam_booking' => 'required',
            'nomor_meja' => 'nullable|string|max:255',
        ]);
        $booking->update($validated);
        return redirect()->route('admin.bookings.index')->with('message', 'Booking updated successfully');
    }

    /**
     * Admin: Update booking item
     */
    public function adminUpdateItem(Request $request, BookingItem $bookingItem)
    {
        $validated = $request->validate([
            'menu_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|integer|min:0',
        ]);
        $bookingItem->update($validated);
        return back()->with('message', 'Booking item updated successfully');
    }

    /**
     * Admin: Hapus booking item
     */
    public function adminDestroyItem(BookingItem $bookingItem)
    {
        $bookingItem->delete();
        return back()->with('message', 'Booking item deleted successfully');
    }
}
