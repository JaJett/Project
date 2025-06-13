<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-100">Dashboard Kasir</h1>

        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Selamat datang, {{ auth()->user()->name }}!</h2>
            <p class="text-gray-600">Silahkan Masukkan Pesanan Yang Telah Di Order.</p>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                <h3 class="text-xl font-semibold mb-2 text-gray-700">Buat Pesanan</h3>
                <p class="text-gray-500 mb-4">Lihat dan pesan menu yang tersedia.</p>
                <a href="{{ route('user.orders.create') }}"
                   class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Pesan Sekarang
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                <h2 class="text-xl font-semibold mb-2 text-gray-700">Produk Terjual</h2>
                <p class="text-gray-500">Total Semua Produk Yang Penjualan:</p>
                <div class="text-3xl font-bold text-blue-600">Rp{{ number_format($totalKeuntungan, 0, ',', '.') }}</div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                <h3 class="text-xl font-semibold mb-2 text-gray-700">Data Pesanan</h3>
                <p class="text-gray-500 mb-4">Lihat semua pesanan yang sudah di tambahkan</p>
                <a href="{{ route('user.orders.index') }}"
                   class="inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                    Lihat Daftar Pesanan
                </a>
            </div>
            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                <h2 class="text-xl font-semibold mb-2 text-gray-700">Pesanan Selesai</h2>
                <p class="text-gray-500 mb-4">Lihat Pesanan yang sudah Selesai.</p>
                <a href="{{ route('user.order-items.index') }}"
                    class="inline-block bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded">
                    Lihat Semua Pesanan
               </a>
            </div>

            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                <h2 class="text-xl font-semibold mb-2 text-gray-700">Daftar Menu</h2>
                <p class="text-gray-500 mb-4">Lihat dan kelola menu yang tersedia di sistem.</p>
                <a href="{{ route('user.menus.index') }}"
                   class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                    Lihat Menu
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                <h2 class="text-xl font-semibold mb-2 text-gray-700">Tambah Menu</h2>
                <p class="text-gray-500 mb-4">Tambahkan menu baru ke dalam sistem.</p>
                <a href="{{ route('user.menus.create') }}"
                   class="inline-block bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded">
                    Tambah Menu
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
