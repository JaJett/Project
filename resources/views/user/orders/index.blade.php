<x-app-layout>
    <div class="min-h-screen bg-gray-900 p-10">
        <div class="max-w-7xl mx-auto bg-white p-10 rounded-2xl shadow-2xl mt-12">
            <h1 class="text-4xl font-bold mb-8 text-gray-900">Daftar Pesanan</h1>

            <div class="mb-8">
                <a href="{{ route('user.orders.create') }}"
                    class="bg-green-600 hover:bg-green-500 text-gray-900 px-8 py-4 rounded-lg font-semibold text-lg shadow">
                    + Buat Pesanan
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-gray-800 border border-gray-700 rounded-lg text-lg text-gray-100">
                    <thead>
                        <tr class="bg-gray-700 uppercase text-sm text-gray-300">
                            <th class="px-6 py-4 text-left">Nama Pemesan</th>
                            <th class="px-6 py-4 text-left">Alamat Pemesan</th>
                            <th class="px-6 py-4 text-left">Nomor Pemesan</th>
                            <th class="px-6 py-4 text-left">Tanggal Ambil</th>
                            <th class="px-6 py-4 text-left">Total Harga</th>
                            <th class="px-6 py-4 text-left">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr class="border-b border-gray-700 hover:bg-gray-700 transition">
                                <td class="px-6 py-4">{{ $order->customer_name}}</td>
                                <td class="px-6 py-4">{{ $order->customer_address}}</td>
                                <td class="px-6 py-4">{{ $order->customer_phone}}</td>
                                <td class="px-6 py-4">{{ $order->pickup_date->format('d M Y') }}</td>
                                <td class="px-6 py-4">Rp{{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('user.orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" class="bg-gray-800 border border-gray-600 rounded text-white px-2 py-1">
                                            @foreach (['menunggu', 'diproses', 'siap', 'selesai', 'dibatalkan'] as $status)
                                                <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                                    {{ ucfirst($status) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td class="px-6 py-4 text-center space-x-4 whitespace-nowrap">
                                    <a href="{{ route('user.orders.edit', $order->id) }}"
                                        class="text-blue-400 hover:text-blue-300 font-semibold">✏️ Edit</a>
                                    <form action="{{ route('user.orders.destroy', $order->id) }}" method="POST" class="inline-block"
                                          onsubmit="return confirm('Yakin ingin menghapus pesanan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300 font-semibold">🗑️ Hapus</button>
                                    </form>
                                    <a href="{{ route('user.orders.print', $order->id) }}"
                                        class="text-green-500 hover:text-green-400 font-semibold">🧾 Cetak Struk</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-6 text-gray-400">Belum ada pesanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
