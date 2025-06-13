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

                <div class="mb-6">
                    <label class="block font-semibold mb-2 text-gray-700">Menu Pesanan</label>
                    <div id="menu-container"></div>

                    <button type="button" onclick="addMenuRow()"
                        class="mt-4 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
                        + Tambah Menu
                    </button>
                </div>

                {{-- Template row --}}
               <template id="menu-row-template">
                    <div class="menu-row grid grid-cols-12 gap-4 mb-4">
                        <select name="menus_ids[]" class="col-span-6 border border-gray-300 px-4 py-2 rounded-lg text-gray-900">
                            <option value="">Pilih Menu</option>
                            @foreach ($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->name }} - Rp{{ number_format($menu->price, 0, ',', '.') }}</option>
                            @endforeach
                        </select>

                        <input type="number" name="quantities[]" min="1"
                            class="col-span-4 border border-gray-300 px-4 py-2 rounded-lg text-gray-900"
                            placeholder="Jumlah">

                        <button type="button" onclick="removeMenuRow(this)"
                            class="col-span-2 bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg">
                            Hapus
                        </button>
                    </div>
                </template>


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

    <script>
        function addMenuRow() {
            const container = document.getElementById('menu-container');
            const template = document.getElementById('menu-row-template');
            const clone = template.content.cloneNode(true);
            container.appendChild(clone);
        }

        function removeMenuRow(button) {
            button.closest('.menu-row').remove();
        }

        // Tambahkan satu baris menu saat form pertama kali dibuka
        document.addEventListener('DOMContentLoaded', function () {
            addMenuRow();
        });
    </script>
</x-app-layout>
