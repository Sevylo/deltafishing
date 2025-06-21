@extends('nopal.layouts.app')

@section('content')
    <header class="bg-yellow-600 text-white py-6 text-center shadow-md relative z-10">
        <h1 class="text-3xl font-bold">Edit Booking</h1>
    </header>

    <div class="absolute inset-0 bg-cover bg-center opacity-30 -z-10"
         style="background-image: url('https://source.unsplash.com/1200x800/?restaurant,table');"></div>

    <div class="relative container w-full max-w-lg mx-auto mt-12 bg-white rounded-2xl shadow-lg p-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('booking.update', $booking->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-black font-medium mb-1">Nama Pemesan</label>
                <input type="text" name="nama" value="{{ old('nama', $booking->nama) }}" required
                       class="form-input p-3 w-full rounded-xl border border-gray-300 focus:ring-2 focus:ring-yellow-300 outline-none">
            </div>

            <div>
                <label class="block text-black font-medium mb-1">Nomor Meja</label>
                <select name="meja" required
                        class="form-input p-3 w-full rounded-xl border border-gray-300 focus:ring-2 focus:ring-yellow-300 outline-none">
                    <option value="">Pilih Nomor Meja</option>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}" {{ $booking->meja == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>

            {{-- Makanan --}}
            <div>
                <label class="block text-black font-medium mb-1">Makanan</label>
                <div id="makanan-container" class="space-y-2">
                    @php
                        $makananList = explode(', ', $booking->makanan);
                    @endphp
                    @foreach ($makananList as $item)
                        @php
                            [$nama, $jumlah] = explode(' x', $item);
                        @endphp
                        <div class="flex gap-2">
                            <select name="makanan[]" required class="form-input w-full p-2 border rounded">
                                <option value="">Pilih Makanan</option>
                                @foreach (['Gurami Bakar','Gurami Goreng','Bandeng Presto','Gurami Asam Manis','Patin Goreng','Nasi Putih'] as $m)
                                    <option value="{{ $m }}" {{ $nama == $m ? 'selected' : '' }}>{{ $m }}</option>
                                @endforeach
                            </select>
                            <input type="number" name="jumlah_makanan[]" value="{{ $jumlah }}" min="1" class="w-20 p-2 border rounded" required>
                        </div>
                    @endforeach
                </div>
                <button type="button" onclick="tambahMakanan()" class="text-yellow-700 underline mt-1">+ Tambah Makanan</button>
            </div>

            {{-- Minuman --}}
            <div>
                <label class="block text-black font-medium mb-1">Minuman</label>
                <div id="minuman-container" class="space-y-2">
                    @php
                        $minumanList = explode(', ', $booking->minuman);
                    @endphp
                    @foreach ($minumanList as $item)
                        @php
                            [$nama, $jumlah] = explode(' x', $item);
                        @endphp
                        <div class="flex gap-2">
                            <select name="minuman[]" required class="form-input w-full p-2 border rounded">
                                <option value="">Pilih Minuman</option>
                                @foreach (['Es Teh','Es Jeruk','Teh Hangat','Jeruk Hangat','Air Mineral'] as $m)
                                    <option value="{{ $m }}" {{ $nama == $m ? 'selected' : '' }}>{{ $m }}</option>
                                @endforeach
                            </select>
                            <input type="number" name="jumlah_minuman[]" value="{{ $jumlah }}" min="1" class="w-20 p-2 border rounded" required>
                        </div>
                    @endforeach
                </div>
                <button type="button" onclick="tambahMinuman()" class="text-yellow-700 underline mt-1">+ Tambah Minuman</button>
            </div>

            <div>
                <label class="block text-black font-medium mb-1">Jam Booking</label>
                <select name="jam" required
                        class="form-input p-3 w-full rounded-xl border border-gray-300 focus:ring-2 focus:ring-yellow-300 outline-none">
                    <option value="">Pilih Jam Booking</option>
                    @foreach (['09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00'] as $jam)
                        <option value="{{ $jam }}" {{ $booking->jam == $jam ? 'selected' : '' }}>{{ $jam }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-black font-medium mb-1">Tanggal Booking</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', $booking->tanggal) }}" required
                       class="form-input p-3 w-full rounded-xl border border-gray-300 focus:ring-2 focus:ring-yellow-300 outline-none">
            </div>

            <div>
                <button type="submit"
                        class="bg-yellow-600 text-white p-3 w-full rounded-xl font-semibold hover:bg-yellow-500 transition duration-300 shadow-md transform hover:scale-105">
                    Update Booking
                </button>
            </div>
        </form>

        <div class="text-center mt-6">
            <a href="{{ route('booking.index') }}" class="text-yellow-700 text-lg font-medium hover:underline">
                ← Kembali ke Daftar Booking
            </a>
        </div>
    </div>

    <script>
        function tambahMakanan() {
            const container = document.getElementById('makanan-container');
            container.insertAdjacentHTML('beforeend', `
                <div class="flex gap-2 mt-2">
                    <select name="makanan[]" required class="form-input w-full p-2 border rounded">
                        <option value="">Pilih Makanan</option>
                        <option value="Gurami Bakar">Gurami Bakar</option>
                        <option value="Gurami Goreng">Gurami Goreng</option>
                        <option value="Bandeng Presto">Bandeng Presto</option>
                        <option value="Gurami Asam Manis">Gurami Asam Manis</option>
                        <option value="Patin Goreng">Patin Goreng</option>
                        <option value="Nasi Putih">Nasi Putih</option>
                    </select>
                    <input type="number" name="jumlah_makanan[]" min="1" class="w-20 p-2 border rounded" required>
                </div>
            `);
        }

        function tambahMinuman() {
            const container = document.getElementById('minuman-container');
            container.insertAdjacentHTML('beforeend', `
                <div class="flex gap-2 mt-2">
                    <select name="minuman[]" required class="form-input w-full p-2 border rounded">
                        <option value="">Pilih Minuman</option>
                        <option value="Es Teh">Es Teh</option>
                        <option value="Es Jeruk">Es Jeruk</option>
                        <option value="Teh Hangat">Teh Hangat</option>
                        <option value="Jeruk Hangat">Jeruk Hangat</option>
                        <option value="Air Mineral">Air Mineral</option>
                    </select>
                    <input type="number" name="jumlah_minuman[]" min="1" class="w-20 p-2 border rounded" required>
                </div>
            `);
        }
    </script>
@endsection
