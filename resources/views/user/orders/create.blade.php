<x-app-layout>
    <div class="min-h-screen bg-gray-900 flex items-center justify-center">
        <div class="w-full max-w-7xl bg-white p-10 rounded-xl shadow-2xl mt-12">
            <h1 class="text-3xl font-bold mb-6 text-gray-900">Buat Pesanan</h1>

            @if ($errors->any())
                <div class="mb-4 text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('user.orders.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="customer_name" class="block font-semibold mb-2 text-gray-700">Nama Pemesan</label>
                    <input type="text" name="customer_name" id="customer_name"
                           class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 text-gray-900"
                           required>
                </div>

                <div class="mb-4">
                    <label for="customer_address" class="block font-semibold mb-2 text-gray-700">Alamat Pemesan</label>
                    <input type="text" name="customer_address" id="customer_address"
                           class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 text-gray-900"
                           required>
                </div>

                <div class="mb-4">
                    <label for="customer_phone" class="block font-semibold mb-2 text-gray-700">Nomor HP</label>
                    <input type="text" name="customer_phone" id="customer_phone"
                           class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 text-gray-900"
                           required>
                </div>

                <div class="mb-4">
                    <label for="pickup_date" class="block font-semibold mb-2 text-gray-700">Tanggal Ambil</label>
                    <input type="date" name="pickup_date" id="pickup_date"
                        class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 text-gray-900"
                        required>
                </div>

                {{-- Tambahkan menu dan kuantitas --}}
                @foreach ($menus as $menu)
                    <div class="mb-4">
                        <label class="block font-semibold mb-1 text-gray-700">{{ $menu->name }} - Rp{{ number_format($menu->price, 0, ',', '.') }}</label>
                        <input type="number" name="menus[{{ $menu->id }}]" min="0"
                               class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-500 text-gray-900"
                               placeholder="Jumlah pesanan">
                    </div>
                @endforeach

                <div class="flex justify-end space-x-4 mt-6">
                    <a href="{{ route('user.orders.index') }}"
                        class="bg-gray-600 hover:bg-gray-500 text-white px-6 py-3 rounded-lg font-semibold">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
