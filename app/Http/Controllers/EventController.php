<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // Halaman utama event (deskripsi, dll)
    public function index()
    {
        return view('nopal.event.index');
    }

    // Tampilkan form pendaftaran
    public function create(Request $request)
    {
         $eventId = $request->query('event');

         return view('nopal.event.daftar', ['eventId' => $eventId]);
    }

    // Proses simpan data peserta
    public function store(Request $request)
    {
        
        $request->validate([
            'name'   => 'required|string|max:100',
            'email'  => 'required|email',
            'phone'  => 'required|numeric',
            'event'  => 'required|numeric',
        ]);

        peserta::create([
            'user_id' => Auth::id(),
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'event_id' => $request->event,
        ]);

        return redirect('/event/peserta?event=' . $request->event)->with('success', 'Pendaftaran berhasil!');
    }

    // Tampilkan daftar peserta
    public function list()
    {
        $peserta = peserta::all();
        return view('nopal.event.peserta', compact('peserta'));
    }
}
