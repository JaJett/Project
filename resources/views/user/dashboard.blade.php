<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6 text-white">Dashboard Kasir</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-gray-600">Produk Terjual</h2>
                <p class="text-2xl text-blue-500 font-semibold">{{ $totalProdukTerjual }}</p>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-gray-600">Total Keuntungan</h2>
                <p class="text-2xl text-green-500 font-semibold">Rp{{ number_format($totalKeuntungan, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
