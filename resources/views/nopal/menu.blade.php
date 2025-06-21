<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Menu Makanan & Minuman</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Header -->
    <div class="bg-blue-600 text-white text-center py-4 text-2xl font-bold">
        Menu Makanan & Minuman
    </div>

    <!-- Tombol Keranjang -->
    <div class="flex justify-end px-4 py-2">
        <button onclick="toggleCartModal()" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded shadow">
            🛒 Keranjang
        </button>
    </div>

    <!-- Daftar Menu -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 p-4">
        @php
            $menus = [
                ['name' => 'Gurami Bakar', 'price' => 25000, 'image' => 'Gurami_bakar.jpg'],
                ['name' => 'Gurami Asam Manis', 'price' => 20000, 'image' => 'Gurami_asam_manis.jpg'],
                ['name' => 'Gurami Goreng', 'price' => 30000, 'image' => 'Gurami_goreng.jpg'],
                ['name' => 'Patin Goreng', 'price' => 5000, 'image' => 'Patin_goreng.jpg'],
                ['name' => 'Bandeng Presto', 'price' => 12000, 'image' => 'Bandeng_presto.jpg'],
                ['name' => 'Nasi Putih', 'price' => 12000, 'image' => 'Nasi_putih.jpg'],
                ['name' => 'Es Jeruk', 'price' => 12000, 'image' => 'Es_jeruk.jpg'],
                ['name' => 'Es Teh', 'price' => 12000, 'image' => 'Es_teh.jpg'],
                ['name' => 'Teh Hangat', 'price' => 12000, 'image' => 'Teh_hangat.jpg'],
                ['name' => 'Jeruk Hangat', 'price' => 12000, 'image' => 'Jeruk_hangat.jpg'],
            ];
        @endphp

        @foreach ($menus as $menu)
        <div class="bg-white rounded-lg shadow p-4 text-center">
            <img src="{{ asset('images/' . $menu['image']) }}" alt="{{ $menu['name'] }}" class="w-32 h-32 mx-auto mb-2 rounded">
            <h3 class="text-lg font-semibold">{{ $menu['name'] }}</h3>
            <p class="text-gray-600 mb-2">Rp{{ number_format($menu['price'], 0, ',', '.') }}</p>
            <button onclick="addToCart('{{ $menu['name'] }}', {{ $menu['price'] }})" class="bg-green-500 text-white px-4 py-2 rounded">+ Tambah</button>
        </div>
        @endforeach
    </div>

    <!-- Modal Keranjang -->
    <div id="cartModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">Keranjang Belanja</h2>
            <ul id="cartItems" class="mb-4 space-y-2"></ul>
            <p class="font-semibold">Total Harga: <span id="totalPrice">Rp0</span></p>
            <div class="mt-4 space-y-2">
                <button onclick="submitBooking()" class="w-full bg-green-600 text-white px-4 py-2 rounded">Pesan Sekarang</button>
                <button onclick="toggleCartModal()" class="w-full bg-red-500 text-white px-4 py-2 rounded">Tutup</button>
            </div>
        </div>
    </div>

    <!-- Script Keranjang -->
    <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        function addToCart(name, price) {
            const existing = cart.find(item => item.name === name);
            if (existing) {
                existing.quantity += 1;
            } else {
                cart.push({ name, price, quantity: 1 });
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            alert(name + " ditambahkan ke keranjang.");
        }

        function renderCart() {
            const cartItemsEl = document.getElementById('cartItems');
            const totalPriceEl = document.getElementById('totalPrice');
            cartItemsEl.innerHTML = '';
            let total = 0;

            if (cart.length === 0) {
                cartItemsEl.innerHTML = '<li class="text-gray-500">Keranjang kosong.</li>';
            } else {
                cart.forEach(item => {
                    const li = document.createElement('li');
                    li.classList = 'flex justify-between';
                    li.innerHTML = `<span>${item.name} x${item.quantity}</span><span>Rp${(item.price * item.quantity).toLocaleString('id-ID')}</span>`;
                    cartItemsEl.appendChild(li);
                    total += item.price * item.quantity;
                });
            }
            totalPriceEl.textContent = 'Rp' + total.toLocaleString('id-ID');
        }

        function toggleCartModal() {
            renderCart();
            document.getElementById('cartModal').classList.toggle('hidden');
        }

        function submitBooking() {
    const nama = prompt("Masukkan nama Anda:");
    const meja = prompt("Masukkan nomor meja:");
    if (!nama || !meja) {
        alert("Nama dan nomor meja wajib diisi!");
        return;
    }

    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Pastikan semua item memiliki quantity
    const formattedCart = cart.map(item => ({
        name: item.name,
        price: item.price,
        quantity: item.quantity ?? 1
    }));

    fetch('/bookings', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            nama,
            meja,
            cart: formattedCart
        })
    })
    .then(response => {
        if (response.ok) {
            alert("Booking berhasil!");
            localStorage.removeItem('cart');
            window.location.href = "/menu"; // atau ke /booking-history kalau mau
        } else {
            return response.json().then(data => {
                alert(data.error || "Gagal menyimpan booking.");
            });
        }
    })
    .catch(() => {
        alert("Terjadi kesalahan saat mengirim booking.");
    });
}

    </script>

</body>
</html>
