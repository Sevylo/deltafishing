@extends('layouts.app')

@section('content')
    <header class="bg-blue-600 text-white py-4 text-center">
        <h1 class="text-2xl font-semibold">Menu Makanan & Minuman</h1>
    </header>

    @php
        $menus = [
            ['name' => 'Gurami bakar', 'price' => 50000, 'image' => 'Gurami_bakar.jpg'],
            ['name' => 'Gurami goreng', 'price' => 25000, 'image' => 'Gurami_goreng.jpg'],
            ['name' => 'Gurami asam manis', 'price' => 30000, 'image' => 'Gurami_asam_manis.jpg'],
            ['name' => 'Bandeng presto', 'price' => 15000, 'image' => 'Bandeng_presto.jpg'],
            ['name' => 'Patin goreng', 'price' => 15000, 'image' => 'Patin_goreng.jpg'],
            ['name' => 'Nasi putih', 'price' => 5000, 'image' => 'Nasi_putih.jpg'],
            ['name' => 'Es teh', 'price' => 4000, 'image' => 'Es_teh.jpg'],
            ['name' => 'Es jeruk', 'price' => 4000, 'image' => 'Es_jeruk.jpg'],
            ['name' => 'Teh hangat', 'price' => 3000, 'image' => 'Teh_hangat.jpg'],
            ['name' => 'Jeruk hangat', 'price' => 3000, 'image' => 'Jeruk_hangat.jpg'],
            ['name' => 'Air mineral', 'price' => 3000, 'image' => 'Air_mineral.jpg'],
        ];
    @endphp

    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 p-4">
        @foreach ($menus as $menu)
            <div class="bg-white border rounded-lg overflow-hidden shadow-sm relative">
                <img src="{{ asset('images/' . $menu['image']) }}" alt="{{ $menu['name'] }}" class="w-full h-32 object-cover">
                <div class="p-2">
                    <h2 class="text-sm font-semibold">{{ $menu['name'] }}</h2>
                    <p class="text-sm text-gray-600">Rp {{ number_format($menu['price'], 0, ',', '.') }}</p>
                </div>
                <button 
    data-name="{{ $menu['name'] }}" 
    data-price="{{ $menu['price'] }}" 
    onclick="handleAddToCart(event)"
    class="absolute bottom-2 right-2 bg-green-500 hover:bg-green-600 text-white w-6 h-6 text-xs rounded-full flex items-center justify-center">
    +
</button>
            </div>
        @endforeach
    </div>

    <button onclick="toggleCartModal()" class="fixed top-4 right-4 bg-yellow-500 hover:bg-yellow-600 text-white p-3 rounded-full shadow">
        🛒
    </button>

    <div id="cartModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-40">
        <div class="bg-white w-full max-w-md rounded-lg shadow p-4 relative">
            <button onclick="toggleCartModal()" class="absolute top-2 right-3 text-xl text-gray-600">&times;</button>
            <h2 class="text-xl font-bold mb-3">Keranjang</h2>
            <ul id="cartItems" class="space-y-2 text-sm"></ul>
            <div class="mt-4 font-medium text-base">Total: Rp <span id="totalPrice">0</span></div>
        </div>
    </div>
    <a href="/rincian" class="fixed bottom-6 right-6 bg-yellow-500 text-white p-4 rounded-full shadow-lg z-50">
    <i class="fas fa-shopping-cart"></i>
</a>


    @vite('resources/js/app.js')
@endsection
