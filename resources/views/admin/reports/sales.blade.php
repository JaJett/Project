<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6 text-gray-100">Laporan Penjualan</h1>

        <!-- Tombol Cetak -->
        <div class="mb-4">
            <a href="#" onclick="window.print()" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Cetak Laporan
            </a>
        </div>

        <form method="GET" class="mb-4 flex flex-wrap items-end gap-4">
            <div>
                <label for="from" class="block text-sm text-gray-700">Dari Tanggal:</label>
                <input type="date" name="from" id="from" value="{{ request('from') }}" class="border rounded px-2 py-1">
            </div>

            <div>
                <label for="to" class="block text-sm text-gray-700">Sampai Tanggal:</label>
                <input type="date" name="to" id="to" value="{{ request('to') }}" class="border rounded px-2 py-1">
            </div>

            <div>
                <label for="menu_id" class="block text-sm text-gray-700">Menu:</label>
                <select name="menu_id" id="menu_id" class="border rounded px-2 py-1">
                    <option value="">Semua Menu</option>
                    @foreach ($menus as $menu)
                        <option value="{{ $menu->id }}" {{ request('menu_id') == $menu->id ? 'selected' : '' }}>
                            {{ $menu->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Filter
                </button>
            </div>
        </form>

        <div class="overflow-x-auto bg-white rounded-lg shadow p-6">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-100 text-left text-sm text-gray-600 uppercase">
                        <th class="px-4 py-2">Tanggal</th>
                        <th class="px-4 py-2">Menu</th>
                        <th class="px-4 py-2">Jumlah</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-4 py-2">Total Harga</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($items as $item)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $item->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-2">{{ $item->menu->name }}</td>
                            <td class="px-4 py-2">{{ $item->quantity }}</td>
                            <td class="px-6 py-4">{{ ucfirst($item->order->status) }}</td>
                            <td class="px-4 py-2">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr class="bg-gray-200 font-semibold">
                        <td colspan="4" class="px-4 py-2 text-right">Total Pendapatan:</td>
                        <td class="px-4 py-2">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
