<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pembayaran Delta Fishing</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gradient-to-b from-sky-400 to-blue-600 min-h-screen">
    <!-- Navigation -->
    <nav class=" fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl text-white font-bold flex items-center">
                         Delta Fishing
                    </a>
                </div>
                <div class="flex items-center space-x-8">
                    <a href="/" class="text-white hover:text-blue-200">Home</a>
                    <a href="/about" class="text-white hover:text-blue-200">About Us</a>
                    <a href="/gallery" class="text-white hover:text-blue-200">Galeri</a>
                    <a href="/sewa" class="text-white hover:text-blue-200">Sewa</a>
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center text-white hover:text-blue-200">
                                {{ Auth::user()->name }}
                                <svg class="ml-1 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open" 
                                 x-cloak
                                 @click.away="open = false" 
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl">
                                @if(Auth::user()->is_admin)
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-500 hover:text-white">
                                        Admin Dashboard
                                    </a>
                                @endif
                                <a href="/history" class="block px-4 py-2 text-gray-800 hover:bg-blue-500 hover:text-white">
                                    Purchase History
                                </a>
                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-blue-500 hover:text-white">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('register') }}" class="text-white hover:text-blue-200">Daftar</a>
                        <a href="{{ route('login') }}" class="text-white hover:text-blue-200">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex justify-center items-center min-h-screen px-4 py-10 mt-8">
        <section class="bg-white bg-opacity-90 shadow-lg rounded-xl p-8 w-full max-w-lg transform transition duration-300">
            <h2 class="text-3xl font-bold mb-8 text-center text-gray-800">Detail Pemesanan</h2>
            
            <div id="param-warning" class="hidden text-center text-red-600 font-semibold mb-4"></div>
            
            <div class="text-center mb-8">
                <div class="mb-6">
                    <img id="gambar-barang" src="" alt="Gambar Barang" class="max-w-[250px] mx-auto rounded-lg shadow-md"/>
                </div>
                <p id="nama-barang" class="text-xl font-semibold text-gray-800 mb-2">Barang: -</p>
                <p id="harga-satuan" class="text-lg text-blue-600 font-semibold mb-2">Harga: Rp 0 / Hari</p>
                <p class="text-2xl font-bold text-blue-700">Total: <span id="total">Rp 0</span></p>
            </div>

            <form id="bayar-form" action="{{ route('bayar.store') }}" method="POST" class="space-y-6" oninput="updateTotal()">
                @csrf
                <input type="hidden" name="nama_barang" id="input-nama-barang">
                <input type="hidden" name="harga_satuan" id="input-harga">                <div>
                    <p class="block text-sm font-medium text-gray-700 mb-4">Nama Pemesan: <span class="font-semibold">{{ Auth::user()->name }}</span></p>
                </div>

                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">Jumlah:</label>
                    <input type="number" id="quantity" name="jumlah" value="1" min="1" required 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                </div>

                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Sewa:</label>
                    <input type="date" id="tanggal" name="tanggal" required 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                </div>

                <input type="hidden" name="total_harga" id="total_harga">

                <button type="submit" 
                        class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transform hover:scale-105 transition duration-200">
                    Konfirmasi Pesanan
                </button>
            </form>
        </section>
    </main>

    <script>
        const params = new URLSearchParams(window.location.search);
        const namaBarang = params.get("nama") || "-";
        const hargaSatuanRaw = params.get("harga");
        const hargaSatuan = hargaSatuanRaw && !isNaN(parseInt(hargaSatuanRaw)) ? parseInt(hargaSatuanRaw) : 0;
        const gambarBarang = params.get("gambar") || '';

        document.getElementById("nama-barang").textContent = `${namaBarang}`;
        document.getElementById("harga-satuan").textContent = `Rp ${hargaSatuan.toLocaleString()} / Hari`;
        document.getElementById("input-nama-barang").value = namaBarang;
        document.getElementById("input-harga").value = hargaSatuan;
        document.getElementById("gambar-barang").src = gambarBarang;

        // Show warning and disable form if harga is not set
        if (!hargaSatuanRaw || isNaN(hargaSatuan) || hargaSatuan <= 0) {
            document.getElementById('param-warning').textContent = 'Data harga barang tidak valid. Silakan kembali ke halaman sebelumnya dan pilih barang dengan benar.';
            document.getElementById('param-warning').classList.remove('hidden');
            document.getElementById('bayar-form').style.display = 'none';
        }

        function updateTotal() {
            const qty = parseInt(document.getElementById("quantity").value) || 0;
            const total = qty * hargaSatuan;
            document.getElementById("total").textContent = `Rp ${total.toLocaleString()}`;
            document.getElementById("total_harga").value = total;
        }

        updateTotal();        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('tanggal').min = today;
    </script>
</body>
</html>
