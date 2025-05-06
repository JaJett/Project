<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Struk Pesanan</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        .header { text-align: center; margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid #000; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Nota Pesanan</h2>
    </div>

    <p><strong>Nama Pemesan:</strong> {{ $orderItem->order->customer_name ?? '-' }}</p>
    <p><strong>Nomor HP:</strong> {{ $orderItem->order->customer_phone ?? '-' }}</p>
    <p><strong>Alamat:</strong> {{ $orderItem->order->customer_address ?? '-' }}</p>
    <p><strong>Tanggal Ambil:</strong> {{ $orderItem->order->pickup_date }}</p>

    <table class="table">
        <thead>
            <tr>
                <th>Menu</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $orderItem->menu->name }}</td>
                <td>Rp{{ number_format($orderItem->price, 0, ',', '.') }}</td>
                <td>{{ $orderItem->quantity }}</td>
                <td>Rp{{ number_format($orderItem->subtotal, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <p style="text-align:right; margin-top: 20px;"><strong>Total: Rp{{ number_format($orderItem->subtotal, 0, ',', '.') }}</strong></p>
</body>
</html>
    