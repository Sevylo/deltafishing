<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pesanan</title>
</head>
<body>
    <h1>Daftar Pesanan</h1>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Menu</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->menu }}</td>
                    <td>{{ $order->harga }}</td>
                    <td>{{ $order->jumlah }}</td>
                    <td>{{ $order->subtotal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
