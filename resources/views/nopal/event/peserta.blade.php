@extends('nopal.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-sky-400 to-blue-600 flex items-center justify-center py-10">
    <div class="w-full max-w-4xl bg-white/20 backdrop-blur-sm border border-white/40 shadow-xl rounded-2xl p-8">
        <h1 class="text-3xl font-bold mb-8 text-center text-white drop-shadow">Daftar Peserta Terdaftar</h1>

        @if($peserta->count())
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto rounded-xl overflow-hidden shadow-lg">
                <thead class="bg-blue-400/100 text-white border-white/50">
                    <tr>
                        <th class="px-4 py-3 font-semibold">No</th>
                        <th class="px-4 py-3 font-semibold">Nama</th>
                        <th class="px-4 py-3 font-semibold">Email</th>
                        <th class="px-4 py-3 font-semibold">Telepon</th>
                    </tr>
                </thead>
                <tbody class="bg-white/60 text-gray-800 divide-y divide-blue-100">
                    @foreach($peserta as $index => $p)
                    <tr class="text-center hover:bg-blue-50/60 transition">
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $p->name }}</td>
                        <td class="px-4 py-2">{{ $p->email }}</td>
                        <td class="px-4 py-2">{{ $p->phone }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-center text-white/90">Belum ada peserta yang mendaftar.</p>
        @endif

        <div class="mt-8 text-center">
            <a href="{{ url('/event') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transform hover:scale-105 transition duration-200 shadow">
                Kembali ke Halaman Event
            </a>
        </div>
    </div>
</div>
@endsection
