<x-app-layout>
    <div class="min-h-screen bg-gray-900 flex items-center justify-center">
        <div class="w-full max-w-2xl bg-white p-10 rounded-xl shadow-2xl mt-12">
            <h1 class="text-3xl font-bold mb-6 text-gray-900">Edit Menu</h1>

            <form method="POST" action="{{ route('user.menus.update', $menu->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block font-semibold mb-2 text-gray-700">Nama Menu</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $menu->name) }}"
                        class="w-full bg-white border border-gray-300 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-900"
                        required>
                </div>

                <div class="mb-4">
                    <label for="price" class="block font-semibold mb-2 text-gray-700">Harga</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $menu->price) }}"
                        class="w-full bg-white border border-gray-300 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-900"
                        required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block font-semibold mb-2 text-gray-700">Deskripsi</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full bg-white border border-gray-300 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-900"
                    >{{ old('description', $menu->description) }}</textarea>
                </div>

                <div class="mb-6">
                    <label for="image" class="block font-semibold mb-2 text-gray-700">Gambar</label>
                    @if ($menu->image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $menu->image) }}" alt="Gambar Menu" class="w-24 h-24 object-cover rounded">
                        </div>
                    @endif
                    <input type="file" name="image" id="image"
                        class="w-full bg-white border border-gray-300 px-4 py-3 rounded-lg text-gray-900 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('user.menus.index') }}"
                        class="bg-gray-600 hover:bg-gray-500 text-white px-6 py-3 rounded-lg font-semibold">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
