<x-app-layout>
    <div class="min-h-screen bg-gray-900 flex items-center justify-center">
        <div class="w-full max-w-7xl bg-white p-10 rounded-xl shadow-2xl mt-12">
            <h1 class="text-3xl font-bold mb-6 text-gray-900">Tambah Menu</h1>

            @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 text-red-600">
                {{ session('error') }}
            </div>
        @endif
            <form method="POST" action="{{ route('admin.menus.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block font-semibold mb-2 text-gray-700">Nama Menu</label>
                    <input type="text" name="name" id="name"
                        class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 text-gray-900"
                        required>
                </div>

                <div class="mb-4">
                    <label for="price" class="block font-semibold mb-2 text-gray-700">Harga</label>
                    <input type="number" name="price" id="price" step="0.01"
                        class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 text-gray-900"
                        required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block font-semibold mb-2 text-gray-700">Deskripsi</label>
                    <textarea name="description" id="description" rows="3"
                        class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 text-gray-900"></textarea>
                </div>

                <div class="mb-6">
                    <label for="image" class="block font-semibold mb-2 text-gray-700">Gambar</label>
                    <input type="file" name="image" id="image"
                        class="w-full border border-gray-300 px-4 py-3 rounded-lg focus:ring-2 focus:ring-blue-500 text-gray-900">
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.menus.index') }}"
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
