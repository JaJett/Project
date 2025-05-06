<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-100">Dashboard Admin</h1>

        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Selamat datang, {{ auth()->user()->name }}!</h2>
            <p class="text-gray-500">Ini adalah halaman admin. Di sini kamu bisa mengelola menu, pesanan, dan pengguna.</p>
        </div>

        {{-- Statistik Ringkas --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded shadow text-center">
                <h2 class="text-2xl font-bold text-blue-600">{{ $totalMenus }}</h2>
                <p class="text-gray-600">Total Menu</p>
            </div>
            <div class="bg-white p-6 rounded shadow text-center">
                <h2 class="text-2xl font-bold text-green-600">{{ $totalUsers }}</h2>
                <p class="text-gray-600">User Terdaftar</p>
            </div>
            <div class="bg-white p-6 rounded shadow text-center">
                <h2 class="text-2xl font-bold text-yellow-600">{{ $totalAdmins }}</h2>
                <p class="text-gray-600">Admin</p>
            </div>
            <div class="bg-white p-6 rounded shadow text-center">
                <h2 class="text-2xl font-bold text-purple-600">Rp{{ number_format($totalPenjualan, 0, ',', '.') }}</h2>
                <p class="text-gray-600">Total Penjualan</p>
            </div>
        </div>

        {{-- Kartu Navigasi --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                <h2 class="text-xl font-semibold mb-2 text-gray-700">Manajemen Akun</h2>
                <p class="text-gray-500 mb-4">Kelola akun admin dan Kasir di sistem.</p>
                <a href="{{ route('admin.users.index') }}"
                   class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Lihat Daftar Akun
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                <h2 class="text-xl font-semibold mb-2 text-gray-700">Tambah Akun</h2>
                <p class="text-gray-500 mb-4">Tambahkan Akun Baru.</p>
                <a href="{{ route('admin.users.create') }}"
                   class="inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                    Buat Akun Baru
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                <h2 class="text-xl font-semibold mb-2 text-gray-700">Statistik</h2>
                <p class="text-gray-500 mb-4">Lihat statistik pesanan dan aktivitas pengguna.</p>
                <a href="{{ route('admin.statistics') }}"
                    class="inline-block bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded">
                      Lihat Statistik
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                <h2 class="text-xl font-semibold mb-2 text-gray-700">Daftar Menu</h2>
                <p class="text-gray-500 mb-4">Lihat dan kelola menu yang tersedia di sistem.</p>
                <a href="{{ route('admin.menus.index') }}"
                   class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                    Lihat Menu
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                <h2 class="text-xl font-semibold mb-2 text-gray-700">Tambah Menu</h2>
                <p class="text-gray-500 mb-4">Tambahkan menu baru ke dalam sistem.</p>
                <a href="{{ route('admin.menus.create') }}"
                   class="inline-block bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded">
                    Tambah Menu
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                <h2 class="text-xl font-semibold mb-2 text-gray-700">Laporan Penjualan</h2>
                <p class="text-gray-500 mb-4">Lihat dan unduh laporan penjualan.</p>
                <a href="{{ route('admin.reports.sales') }}"
                    class="inline-block bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                     Lihat Laporan
                </a>
            </div>
        </div>

        {{-- Daftar Menu Terbaru --}}
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Menu Terbaru</h2>
            @if($latestMenus->count())
                <ul class="text-gray-700">
                    @foreach ($latestMenus as $menu)
                        <li class="mb-2">
                            <strong>{{ $menu->name }}</strong> - Rp{{ number_format($menu->price, 0, ',', '.') }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">Belum ada menu ditambahkan.</p>
            @endif
        </div>
    </div>
</x-app-layout>
