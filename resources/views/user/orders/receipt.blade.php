<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pesanan</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f3f3f3; }
    </style>
</head>
<body>
    <h2>Struk Pesanan #{{ $order->id }}</h2>
    <p><strong>Nama Pemesan:</strong> {{ $order->customer_name }}</p>
    <p><strong>No. HP:</strong> {{ $order->customer_phone }}</p>
    <p><strong>Alamat:</strong> {{ $order->customer_address }}</p>
    <p><strong>Tanggal Ambil:</strong> {{ $order->pickup_date->format('d M Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Menu</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->menu->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total: Rp{{ number_format($order->total_price, 0, ',', '.') }}</h3>
</body>
</html>
