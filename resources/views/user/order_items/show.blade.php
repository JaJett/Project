<x-app-layout>
    <div class="min-h-screen bg-gray-900 p-10 text-gray-100">
        <div class="max-w-4xl mx-auto bg-gray-800 p-10 rounded-2xl shadow-xl">
            <h1 class="text-3xl font-bold mb-6 text-white">Detail Item Pesanan</h1>

            <div class="space-y-4 text-lg">
                <p><strong>Menu:</strong> {{ $orderItem->menu->name }}</p>
                <p><strong>Jumlah:</strong> {{ $orderItem->quantity }}</p>
                <p><strong>Harga Satuan:</strong> Rp{{ number_format($orderItem->price, 0, ',', '.') }}</p>
                <p><strong>Subtotal:</strong> Rp{{ number_format($orderItem->subtotal, 0, ',', '.') }}</p>
                <hr class="my-4 border-gray-600">
                <p><strong>Nama Pemesan:</strong> {{ $orderItem->order->customer_name }}</p>
                <p><strong>Alamat Pemesan:</strong> {{ $orderItem->order->customer_address }}</p>
                <p><strong>No. HP Pemesan:</strong> {{ $orderItem->order->customer_phone }}</p>
                <p><strong>Tanggal Ambil:</strong> {{ \Carbon\Carbon::parse($orderItem->order->pickup_date)->format('d M Y') }}</p>
                <p><strong>Status Pesanan:</strong> {{ ucfirst($orderItem->order->status) }}</p>
            </div>

            <div class="mt-8 flex space-x-4">
                <a href="{{ route('user.order-items.index') }}"
                    class="bg-gray-600 hover:bg-gray-500 text-white px-6 py-3 rounded-lg shadow font-semibold">
                    ⬅️ Kembali ke daftar
                </a>

                <a href="{{ route('user.order-items.print', $orderItem->id) }}" target="_blank"
                    class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-500">
                     🧾 Cetak Struk
                 </a>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            .printable, .printable * {
                visibility: visible;
            }

            .printable {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                padding: 20px;
            }
        }
    </style>
</x-app-layout>
