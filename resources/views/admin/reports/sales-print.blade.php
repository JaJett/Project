<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Penjualan</title>
    <style>
        * {
            font-family: sans-serif;
            font-size: 12px;
        }

        @page {
            size: A4;
            margin: 20mm;
        }

        body {
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            page-break-inside: auto;
        }

        thead {
            background-color: #f0f0f0;
        }

        th, td {
            border: 1px solid #999;
            padding: 6px 10px;
            text-align: left;
        }

        tfoot td {
            font-weight: bold;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }
    </style>
</head>
<body onload="window.print()">

    <h2>Laporan Penjualan</h2>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Menu</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @php $totalSemua = 0; @endphp
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->created_at->format('d M Y') }}</td>
                    <td>{{ $item->menu->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ ucfirst($item->order->status) }}</td>
                    <td>Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
                @php $totalSemua += $item->subtotal; @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align: right;">Total Keseluruhan:</td>
                <td>Rp{{ number_format($totalSemua, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

</body>
</html>
