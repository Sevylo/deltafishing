<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Edit Pembayaran</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-100 min-h-screen py-12 px-4">

    <div class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center text-blue-700 mb-6">Edit Data Pembayaran</h2>


        <form action="{{ route('bayar.update', $bayar->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Nama Barang (readonly) -->
            <div>
                <label for="nama_barang" class="block font-medium">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" value="{{ $bayar->nama_barang }}" readonly class="w-full border rounded px-3 py-2 mt-1 bg-gray-100 text-gray-700">
            </div>            <!-- Harga Satuan (disimpan dalam input hidden) -->
            <input type="hidden" name="harga_satuan" id="harga_satuan" value="{{ $bayar->total_harga / $bayar->jumlah }}">

            <!-- Nama Penyewa -->
            <div>
                <label for="nama" class="block font-medium">Nama</label>
                <input type="text" name="nama" id="nama" value="{{ $bayar->nama }}" required class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <!-- Alamat -->
            <div>
                <label for="alamat" class="block font-medium">Alamat</label>
                <input type="text" name="alamat" id="alamat" value="{{ $bayar->alamat }}" required class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <!-- No HP -->
            <div>
                <label for="nohp" class="block font-medium">No HP</label>
                <input type="text" name="nohp" id="nohp" value="{{ $bayar->nohp }}" required class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <!-- Jumlah -->
            <div>
                <label for="jumlah" class="block font-medium">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" value="{{ $bayar->jumlah }}" required class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <!-- Tanggal -->
            <div>
                <label for="tanggal" class="block font-medium">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ $bayar->tanggal }}" required class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <!-- Total Harga -->
            <div>
                <label for="total_harga" class="block font-medium">Total Harga</label>
                <input type="number" name="total_harga" id="total_harga" value="{{ $bayar->total_harga }}" readonly required class="w-full border rounded px-3 py-2 mt-1 bg-gray-100 text-gray-700">
            </div>

            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-200 w-full">
                Simpan Perubahan
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const jumlahInput = document.getElementById('jumlah');
            const totalHargaInput = document.getElementById('total_harga');
            const hargaSatuan = parseInt(document.getElementById('harga_satuan').value);

            function updateTotalHarga() {
                const jumlah = parseInt(jumlahInput.value) || 0;
                totalHargaInput.value = jumlah * hargaSatuan;
            }

            jumlahInput.addEventListener('input', updateTotalHarga);
            updateTotalHarga();
        });
    </script>

</body>
</html>
