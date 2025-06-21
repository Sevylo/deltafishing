@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Rincian Pesanan</h2>
    <form id="form-rincian" method="POST" action="{{ route('rincian.simpan') }}">
        @csrf
        <div id="rincian-container"></div>
        <div class="text-right mt-4">
            <p class="font-bold text-lg">Total: Rp <span id="total-harga">0</span></p>
        </div>
        <input type="hidden" name="orders" id="orders-data">
        <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Simpan Pesanan</button>
    </form>
</div>

<script>
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    let total = 0;
    const rincian = cart.map(item => {
        let subtotal = item.harga * item.jumlah;
        total += subtotal;
        return `<p>${item.nama} x ${item.jumlah} = Rp ${subtotal.toLocaleString()}</p>`;
    });

    document.getElementById('rincian-container').innerHTML = rincian.join('');
    document.getElementById('total-harga').textContent = total.toLocaleString();
    document.getElementById('orders-data').value = JSON.stringify(cart);
</script>
@endsection
