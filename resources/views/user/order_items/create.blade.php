<x-app-layout>
    <div class="max-w-2xl mx-auto py-10 px-6 bg-white rounded shadow">
        <h2 class="text-2xl font-bold mb-6">Tambah Item Pesanan</h2>

        <form action="{{ route('user.order-items.store') }}" method="POST">
            @csrf

            <!-- Tambahkan hidden input untuk order_id -->
            <input type="hidden" name="order_id" value="{{ $order->id }}">

            <div class="mb-4">
                <label for="menu_id" class="block font-medium text-sm text-gray-700">Menu</label>
                <select name="menu_id" class="form-select w-full">
                    <option value="">-- Pilih Menu --</option>
                    @foreach ($menus as $menu)
                        <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="quantity" class="block font-medium text-sm text-gray-700">Jumlah</label>
                <input type="number" name="quantity" id="quantity" class="mt-1 block w-full border-gray-300 rounded" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Simpan Item
            </button>
        </form>
    </div>
</x-app-layout>
