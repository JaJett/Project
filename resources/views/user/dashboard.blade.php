<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6 text-white">Dashboard Kasir</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- Produk Terjual --}}
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-gray-600 text-lg font-semibold">Produk Terjual</h2>
                <p class="text-2xl text-blue-500 font-bold mt-2">{{ $totalProdukTerjual }}</p>
            </div>

            {{-- Total Keuntungan --}}
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-gray-600 text-lg font-semibold">Total Keuntungan</h2>
                <p class="text-2xl text-green-500 font-bold mt-2">Rp{{ number_format($totalKeuntungan, 0, ',', '.') }}</p>
            </div>

            {{-- Pesanan Hari Ini --}}
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-gray-600 text-lg font-semibold">Pesanan Hari Ini</h2>
                <p class="text-2xl text-blue-600 font-bold mt-2">{{ $jumlahPesananHariIni ?? 0 }}</p>
            </div>

            {{-- Produk Terlaris --}}
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-gray-600 text-lg font-semibold">Produk Terlaris</h2>
                <p class="text-xl text-indigo-600 font-semibold mt-2">{{ $produkTerlaris->nama ?? 'Belum ada' }}</p>
                <p class="text-sm text-gray-500">Terjual: {{ $produkTerlaris->jumlah ?? 0 }}</p>
            </div>

            {{-- Pendapatan Hari Ini --}}
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-gray-600 text-lg font-semibold">Pendapatan Hari Ini</h2>
                <p class="text-2xl text-green-600 font-bold mt-2">Rp{{ number_format($pendapatanHariIni ?? 0, 0, ',', '.') }}</p>
            </div>

            {{-- Produk Belum Selesai --}}
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-gray-600 text-lg font-semibold">Pesanan Belum Selesai</h2>
                <p class="text-2xl text-red-500 font-bold mt-2">{{ $pesananBelumSelesai }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
