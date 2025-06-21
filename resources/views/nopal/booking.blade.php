@extends('nopal.layouts.app') {{-- Memakai layout utama agar navbar muncul --}}

@section('content')
<div class="min-h-screen bg-gradient-to-b from-sky-400 to-blue-600 py-12 px-4">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <nav class="fixed w-full top-0 z-50 bg-blue-400/30 backdrop-blur-sm border-b border-white/20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl text-white font-bold flex items-center">
                        Delta Fishing
                    </a>
                </div>
                <div class="hidden sm:flex items-center space-x-8 text-semibold">
                    <a href="/about" class="text-white hover:text-blue-200">About</a>
                    <a href="/gallery" class="text-white hover:text-blue-200">Gallery</a>
                    <a href="/sewa" class="text-white hover:text-blue-200">Sewa</a>
                    <a href="/event" class="text-white hover:text-blue-200 ">Event</a>
                    <a href="/booking" class="text-white hover:text-blue-200">Booking & Menu</a>
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
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-1">
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-500 hover:text-white">
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
    <main class="max-w-6xl mx-auto pt-20">
        <div class="bg-white/20 backdrop-blur-sm border border-white/30 shadow-xl rounded-2xl p-8">
            <h2 class="text-3xl font-bold text-center text-white mb-8">Booking & Pesan Menu</h2>
            
            <form id="bookingForm" action="{{ route('booking.store') }}" method="POST" onsubmit="return submitBooking(event)">
                @csrf
                
                {{-- Bagian Kiri: Form Data Diri & Keranjang --}}
                <div class="grid md:grid-cols-2 gap-x-12 gap-y-8 mb-10">
                    <div class="space-y-4">
                        <div>
                            <label class="block font-semibold mb-1 text-white/90">Nama Pemesan</label>
                            <input type="text" name="nama" class="w-full bg-white/50 border border-white/30 rounded-lg px-4 py-2 text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-blue-300 transition" required>
                        </div>
                        <div>
                            <label class="block font-semibold mb-1 text-white/90">No. Telepon</label>
                            <input type="text" name="telepon" class="w-full bg-white/50 border border-white/30 rounded-lg px-4 py-2 text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-blue-300 transition" required>
                        </div>
                        <div>
                            <label class="block font-semibold mb-1 text-white/90">Tanggal</label>
                            <input type="date" name="tanggal" class="w-full bg-white/50 border border-white/30 rounded-lg px-4 py-2 text-gray-800" required>
                        </div>
                        <div>
                            <label class="block font-semibold mb-1 text-white/90">Jam</label>
                            <input type="time" name="jam" class="w-full bg-white/50 border border-white/30 rounded-lg px-4 py-2 text-gray-800" required>
                        </div>
                    </div>

                    {{-- Bagian Kanan: Keranjang Belanja --}}
                    <div>
                        <h3 class="font-bold mb-2 text-xl text-white">Keranjang Pesanan</h3>
                        <div id="cartList" class="bg-white/30 rounded-lg p-4 min-h-[180px] max-h-64 overflow-y-auto border border-white/20 space-y-3">
                            <span class="text-white/70">Keranjang kosong</span>
                        </div>
                        <div class="flex justify-between mt-4 font-bold text-white text-lg border-t border-white/30 pt-3">
                            <span>Total:</span>
                            <span id="cartTotal">Rp 0</span>
                        </div>
                    </div>
                </div>

                {{-- Bagian Bawah: Pilihan Menu --}}
                <div>
                    <h3 class="font-bold text-xl mb-4 text-white">Pilih Menu</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 mb-6">
                        @foreach(App\Models\Menu::all() as $menu)
                            <div class="bg-white/20 backdrop-blur-sm rounded-lg shadow-md p-3 flex flex-col items-center border border-white/30">
                                <img src="{{ asset('images/' . ($menu->image ?? 'default.jpg')) }}" alt="{{ $menu->name }}" class="w-24 h-24 object-cover rounded-md mb-3 border-2 border-white/50">
                                <div class="text-center flex-1 flex flex-col">
                                    <div class="font-semibold text-base text-white">{{ $menu->name }}</div>
                                    <div class="text-cyan-200 font-bold">Rp {{ number_format($menu->price,0,',','.') }}</div>
                                    <div class="text-xs text-white/80 mb-2 flex-1">{{ $menu->description }}</div>
                                    <button type="button" class="mt-auto w-full bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-md text-sm font-semibold transition" onclick="addToCart({{ $menu->id }}, '{{ $menu->name }}', {{ $menu->price }})">Tambah</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <input type="hidden" name="cart" id="cartInput">
                
                <div class="flex justify-end mt-8 border-t border-white/30 pt-6">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-bold shadow-lg transform hover:scale-105 transition">Booking & Pesan</button>
                </div>
            </form>
        </div>
    </main>
</div>

{{-- SCRIPT TETAP SAMA, TIDAK PERLU DIUBAH --}}
<script>
let cart = [];

function addToCart(id, name, price) {
    const idx = cart.findIndex(item => item.id === id);
    if (idx > -1) {
        cart[idx].qty++;
    } else {
        cart.push({id, name, price, qty: 1});
    }
    renderCart();
}

function removeFromCart(id) {
    cart = cart.filter(item => item.id !== id);
    renderCart();
}

function changeQty(id, delta) {
    const idx = cart.findIndex(item => item.id === id);
    if (idx > -1) {
        cart[idx].qty += delta;
        if (cart[idx].qty < 1) {
            // Jika kuantitas jadi 0, hapus item dari keranjang
            removeFromCart(id);
        } else {
            renderCart();
        }
    }
}

function renderCart() {
    let html = '';
    let total = 0;
    cart.forEach(item => {
        total += item.price * item.qty;
        // Tombol + dan - dibuat lebih menarik
        html += `<div class='flex items-center justify-between text-white text-sm p-2 rounded bg-black/10'>
                    <span class='flex-1'>${item.name}</span>
                    <div class='flex items-center gap-2 mx-2'>
                        <button type='button' onclick='changeQty(${item.id},-1)' class='flex items-center justify-center w-6 h-6 bg-white/20 rounded-full hover:bg-white/40 transition'>-</button>
                        <span class='font-bold w-4 text-center'>${item.qty}</span>
                        <button type='button' onclick='changeQty(${item.id},1)' class='flex items-center justify-center w-6 h-6 bg-white/20 rounded-full hover:bg-white/40 transition'>+</button>
                    </div>
                    <span class='w-24 text-right'>Rp ${ (item.price * item.qty).toLocaleString('id-ID') }</span>
                    <button type='button' onclick='removeFromCart(${item.id})' class='ml-3 text-red-300 hover:text-red-500 font-bold text-lg'>×</button>
                </div>`;
    });
    document.getElementById('cartList').innerHTML = html || '<span class="text-white/70 flex items-center justify-center h-full">Keranjang kosong</span>';
    document.getElementById('cartTotal').innerText = 'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('cartInput').value = JSON.stringify(cart);
}

function submitBooking(e) {
    if (cart.length === 0) {
        // Menggunakan SweetAlert untuk notifikasi yang lebih cantik
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Keranjang pesanan masih kosong!',
            confirmButtonColor: '#3B82F6' // Warna biru
        });
        e.preventDefault();
        return false;
    }
    document.getElementById('cartInput').value = JSON.stringify(cart);
    return true;
}
</script>
@endsection