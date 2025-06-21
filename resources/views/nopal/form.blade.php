@extends('nopal.layouts.app')

@section('content')
    <!-- Header -->
    <header class="bg-blue-600 text-white py-6 text-center shadow-md relative z-10">
        <h1 class="text-3xl font-bold">Booking Tempat Makan</h1>
    </header>

    <!-- Background gambar -->
    <div class="absolute inset-0 bg-cover bg-center opacity-30 -z-10"
         style="background-image: url('https://source.unsplash.com/1200x800/?restaurant,food');"></div>

    <!-- Konten Form -->
    <div class="relative container w-full max-w-lg mx-auto mt-12 bg-white rounded-2xl shadow-lg p-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">Daftar Menu</h2>
            <ul class="list-disc list-inside text-gray-700">
                <li>Gurami bakar - Rp 50.000</li>
                <li>Gurami goreng - Rp 25.000</li>
                <li>Gurami asam manis - Rp 30.000</li>
                <li>Bandeng presto - Rp 15.000</li>
                <li>Patin goreng - Rp 15.000</li>
                <li>Nasi putih - Rp 5.000</li>
                <li>Es teh - Rp 4.000</li>
                <li>Es jeruk - Rp 4.000</li>
                <li>Teh hangat - Rp 3.000</li>
                <li>Jeruk hangat - Rp 3.000</li>
                <li>Air mineral - Rp 3.000</li>
            </ul>
        </div>


        <form action="{{ route('booking.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-black font-medium mb-1">Nama Pemesan</label>
                <input type="text" name="nama" placeholder="Masukkan Nama" required
                       class="form-input p-3 w-full rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-300 outline-none">
            </div>

            <div>
                <label class="block text-black font-medium mb-1">Nomor Meja</label>
                <select name="meja" required
                        class="form-input p-3 w-full rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-300 outline-none">
                    <option value="">Pilih Nomor Meja</option>
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <!-- Makanan -->
            <div>
                <label class="block text-black font-medium mb-1">Makanan</label>
                <div id="makanan-container" class="space-y-2">
                    <div class="flex gap-2">
                        <select name="makanan[]" required class="form-input w-full p-2 border rounded">
                            <option value="">Pilih Makanan</option>
                            <option value="Gurami Bakar">Gurami Bakar</option>
                            <option value="Gurami Goreng">Gurami Goreng</option>
                            <option value="Bandeng Presto">Bandeng Presto</option>
                            <option value="Gurami Asam Manis">Gurami Asam Manis</option>
                            <option value="Patin Goreng">Patin Goreng</option>
                            <option value="Nasi Putih">Nasi Putih</option>
                        </select>
                        <input type="number" name="jumlah_makanan[]" placeholder="Jumlah" min="1" class="w-20 p-2 border rounded" required>
                    </div>
                </div>
                <button type="button" onclick="tambahMakanan()" class="text-blue-600 underline mt-1">+ Tambah Makanan</button>
            </div>

            <!-- Minuman -->
            <div>
                <label class="block text-black font-medium mb-1">Minuman</label>
                <div id="minuman-container" class="space-y-2">
                    <div class="flex gap-2">
                        <select name="minuman[]" required class="form-input w-full p-2 border rounded">
                            <option value="">Pilih Minuman</option>
                            <option value="Es Teh">Es Teh</option>
                            <option value="Es Jeruk">Es Jeruk</option>
                            <option value="Teh Hangat">Teh Hangat</option>
                            <option value="Jeruk Hangat">Jeruk Hangat</option>
                            <option value="Air Mineral">Air Mineral</option>
                        </select>
                        <input type="number" name="jumlah_minuman[]" placeholder="Jumlah" min="1" class="w-20 p-2 border rounded" required>
                    </div>
                </div>
                <button type="button" onclick="tambahMinuman()" class="text-blue-600 underline mt-1">+ Tambah Minuman</button>
            </div>

            <div>
                <label class="block text-black font-medium mb-1">Jam Booking</label>
                <select name="jam" required
                        class="form-input p-3 w-full rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-300 outline-none">
                    <option value="">Pilih Jam Booking</option>
                    @foreach (['09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00'] as $jam)
                        <option value="{{ $jam }}">{{ $jam }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-black font-medium mb-1">Tanggal Booking</label>
                <input type="date" name="tanggal" required
                       class="form-input p-3 w-full rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-300 outline-none">
            </div>

            <div>
                <button type="submit"
                        class="bg-blue-700 text-white p-3 w-full rounded-xl font-semibold hover:bg-blue-500 transition duration-300 shadow-md transform hover:scale-105">
                    Booking Sekarang
                </button>
            </div>
        </form>

        <div class="text-center mt-6">
            <a href="{{ route('booking.index') }}" class="text-blue-600 text-lg font-medium hover:underline">
                Lihat Daftar Booking
            </a>
        </div>
    </div>

    <script>
        function tambahMakanan() {
            const container = document.getElementById('makanan-container');
            container.insertAdjacentHTML('beforeend', `
                <div class="flex gap-2">
                    <select name="makanan[]" required class="form-input w-full p-2 border rounded">
                        <option value="">Pilih Makanan</option>
                        <option value="Gurami Bakar">Gurami Bakar</option>
                        <option value="Gurami Goreng">Gurami Goreng</option>
                        <option value="Bandeng Presto">Bandeng Presto</option>
                        <option value="Gurami Asam Manis">Gurami Asam Manis</option>
                        <option value="Patin Goreng">Patin Goreng</option>
                        <option value="Nasi Putih">Nasi Putih</option>
                    </select>
                    <input type="number" name="jumlah_makanan[]" placeholder="Jumlah" min="1" class="w-20 p-2 border rounded" required>
                </div>
            `);
        }

        function tambahMinuman() {
            const container = document.getElementById('minuman-container');
            container.insertAdjacentHTML('beforeend', `
                <div class="flex gap-2">
                    <select name="minuman[]" required class="form-input w-full p-2 border rounded">
                        <option value="">Pilih Minuman</option>
                        <option value="Es Teh">Es Teh</option>
                        <option value="Es Jeruk">Es Jeruk</option>
                        <option value="Teh Hangat">Teh Hangat</option>
                        <option value="Jeruk Hangat">Jeruk Hangat</option>
                        <option value="Air Mineral">Air Mineral</option>
                    </select>
                    <input type="number" name="jumlah_minuman[]" placeholder="Jumlah" min="1" class="w-20 p-2 border rounded" required>
                </div>
            `);
        }
    </script>
@endsection
