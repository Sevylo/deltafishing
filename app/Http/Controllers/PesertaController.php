<?php

namespace App\Http\Controllers;

use App\Models\Peserta; 
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PesertaController extends Controller
{
    public function index(): Response
    {
        $pesertas = Peserta::latest()
            // ->with(['event']) // Jika ingin mengambil relasi event
            ->paginate(10)
            ->through(fn ($peserta) => [
                'id' => $peserta->id,
                'name' => $peserta->name,
                'email' => $peserta->email,
                'phone' => $peserta->phone,
                // 'event_name' => $peserta->event ? $peserta->event->name : 'N/A',
            ]);

        return Inertia::render('Admin/Pesertas/Index', [
            'pesertas' => $pesertas
        ]);
    }

    public function edit(Peserta $peserta)
    {
        return Inertia::render('Admin/Pesertas/Edit', [
            'peserta' => [
                'id' => $peserta->id,
                'name' => $peserta->name,
                'email' => $peserta->email,
                'phone' => $peserta->phone,
                // 'event_id' => $peserta->event_id,
            ]
        ]);
    }

    public function update(Request $request, Peserta $peserta)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            // 'event_id' => 'nullable|exists:events,id',
        ]);
        $peserta->update($validated);
        return redirect()->route('pesertas.index')->with('message', 'Peserta updated successfully');
    }

    public function destroy(Peserta $peserta)
    {
        $peserta->delete();
        return back()->with('message', 'Peserta deleted successfully');
    }
}