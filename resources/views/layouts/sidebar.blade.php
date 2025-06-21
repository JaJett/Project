<div class="fixed inset-0 w-64 bg-gray-900 text-white flex flex-col shadow-lg z-50 overflow-y-auto print:hidden no-print">
    <div class="text-2xl font-bold p-6 border-b border-gray-700">
        {{ Auth::user()->role === 'admin' ? 'Admin Panel' : 'Kasir Panel' }}
    </div>

    {{-- scroll hanya bagian menu/nav --}}
    <nav class="flex-1 p-4 space-y-2 text-lg overflow-y-auto">
        @if (Auth::user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition">
                🏠 Dashboard
            </a>
            <a href="{{ route('admin.users.index') }}"
               class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition">
                👥 Manajemen Akun
            </a>
            <a href="{{ route('admin.menus.index') }}"
               class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition">
                📋 Daftar Menu
            </a>
            <a href="{{ route('admin.reports.sales') }}"
               class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition">
                📈 Laporan Penjualan
            </a>
        @elseif (Auth::user()->role === 'user')
            <a href="{{ route('user.dashboard') }}"
               class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition">
                🏠 Dashboard
            </a>
            <a href="{{ route('user.orders.create') }}"
               class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition">
                🛒 Buat Pesanan
            </a>
            <a href="{{ route('user.orders.index') }}"
               class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition">
                📦 Data Pesanan
            </a>
            <a href="{{ route('user.order-items.index') }}"
               class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition">
                ✅ Pesanan Selesai
            </a>
            <a href="{{ route('user.menus.index') }}"
               class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition">
                🍽️ Daftar Menu
            </a>
            <a href="{{ route('user.menus.create') }}"
               class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition">
                ➕ Tambah Menu
            </a>
        @endif
    </nav>

    <div class="p-4 border-t border-gray-700 text-sm">
        <div class="text-white font-semibold text-base mb-2">
            👤 {{ Auth::user()->name }}
        </div>
        <a href="{{ route('profile.edit') }}"
           class="block text-gray-300 hover:text-white mb-1 text-base">
            ⚙️ Edit Profil
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="text-orange-400 hover:text-orange-600 text-base">
                🔓 Logout
            </button>
        </form>
    </div>
</div>
