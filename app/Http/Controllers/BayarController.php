<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bayar;
use Illuminate\Support\Facades\Auth;

class BayarController extends Controller
{
    public function index() {
        $bayars = Bayar::all();
        
        // Prepare data for the chart
        $bayarsByDate = $bayars->groupBy('tanggal');
        $labels = $bayarsByDate->keys()->toArray();
        $data = $bayarsByDate->map(function ($group) {
            return $group->sum('total_harga');
        })->values()->toArray();

        return view('bayar.index', compact('bayars', 'labels', 'data'));
    }
    public function create() {
        return view('bayar.create');
    }
    public function store(Request $request) {
        if (!Auth::check()) {
            return redirect('login');
        }

        $data = $request->only([
            'nama_barang',
            'harga_satuan',
            'jumlah',
            'tanggal',
            'total_harga'
        ]);
        
        $data['nama'] = Auth::user()->name;
        
        Bayar::create($data);
        
        return redirect()->route('bayar.history')->with('success', 'Pesanan berhasil dibuat!');
    }
    public function edit($id) {
        $bayar = Bayar::findOrFail($id);
        return view('bayar.edit', compact('bayar'));
    }
    public function update(Request $request, $id) {
        $bayar = Bayar::findOrFail($id);
        $bayar->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'nohp' => $request->nohp,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'total_harga' => $request->total_harga,
            'nama_barang' => $request->nama_barang,
            'harga_satuan' => $request->harga_satuan
        ]);
        return redirect()->route('bayar.index');
    }
    public function destroy($id) {
        $bayar = Bayar::findOrFail($id);
        $bayar->delete();
        return redirect()->route('bayar.index');
    }
    public function chart() {
        // Implement chart logic or return a view
        return view('bayar.chart');
    }    public function history()
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        // Get transactions for the currently authenticated user
        $bayars = Bayar::where('nama', Auth::user()->name)
                       ->orderBy('created_at', 'desc')
                       ->get();
        
        // Ambil juga data booking user
        $userId = Auth::id();
        $bookings = \App\Models\Booking::with('items')
            ->where('user_id', $userId)
            ->latest()->get();
        return view('bayar.history', compact('bayars', 'bookings'));
    }
    public function admin()
    {
        $bayars = Bayar::all();
        
        // Prepare data for the chart
        $bayarsByDate = $bayars->groupBy('tanggal');
        $labels = $bayarsByDate->keys()->toArray();
        $data = $bayarsByDate->map(function ($group) {
            return $group->sum('total_harga');
        })->values()->toArray();

        return view('admin.transactions', compact('bayars', 'labels', 'data'));
    }
}
