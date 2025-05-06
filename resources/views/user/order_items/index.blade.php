<x-app-layout>
    <div class="min-h-screen bg-gray-900 p-10">
        <div class="max-w-7xl mx-auto bg-white p-10 rounded-2xl shadow-2xl mt-12">
            <h1 class="text-4xl font-bold mb-8 text-gray-900">Daftar Item Pesanan</h1>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-gray-800 border border-gray-700 rounded-lg text-lg text-gray-100">
                    <thead>
                        <tr class="bg-gray-700 uppercase text-sm text-gray-300">
                            <th class="px-6 py-4 text-left">Menu</th>
                            <th class="px-6 py-4 text-left">Jumlah</th>
                            <th class="px-6 py-4 text-left">Harga Satuan</th>
                            <th class="px-6 py-4 text-left">Subtotal</th>
                            <th class="px-6 py-4 text-left">Pesanan oleh</th>
                            <th class="px-6 py-4 text-left">Tanggal Ambil</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr class="border-b border-gray-700 hover:bg-gray-700 transition">
                                <td class="px-6 py-4">{{ $item->menu->name }}</td>
                                <td class="px-6 py-4">{{ $item->quantity }}</td>
                                <td class="px-6 py-4">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">{{ $item->order->customer_name }}</td>
                                <td class="px-6 py-4">{{ $item->order->pickup_date->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('user.order-items.show', $item) }}"
                                       class="text-blue-400 hover:text-blue-300 font-semibold">
                                        👁️ Lihat
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-6 text-gray-400">Belum ada item pesanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
