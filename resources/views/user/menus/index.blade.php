<x-app-layout>
    <div class="min-h-screen bg-gray-900 p-10">
        <div class="max-w-7xl mx-auto bg-white p-10 rounded-2xl shadow-2xl mt-12">
            <h1 class="text-4xl font-bold mb-8 text-gray-900">Daftar Menu</h1>

            <div class="mb-8">
                <a href="{{ route('user.menus.create') }}"
                    class="bg-green-600 hover:bg-green-500 text-gray-900 px-8 py-4 rounded-lg font-semibold text-lg shadow">
                    + Tambah Menu
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-gray-800 border border-gray-700 rounded-lg text-lg text-gray-100">
                    <thead>
                        <tr class="bg-gray-700 uppercase text-sm text-gray-300">
                            <th class="px-6 py-4 text-left">Gambar</th>
                            <th class="px-6 py-4 text-left">Nama</th>
                            <th class="px-6 py-4 text-left">Harga</th>
                            <th class="px-6 py-4 text-left">Deskripsi</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($menus as $menu)
                            <tr class="border-b border-gray-700 hover:bg-gray-700 transition">
                                <td class="px-6 py-4">
                                    @if ($menu->image)
                                        <img src="{{ asset('menu_images/' . $menu->image) }}" alt="{{ $menu->name }}" width="150" class="w-16 h-16 object-cover rounded">
                                    @else
                                        <span class="text-gray-400 italic">Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ $menu->name }}</td>
                                <td class="px-6 py-4">Rp{{ number_format($menu->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 max-w-xs truncate">{{ $menu->description }}</td>
                                <td class="px-6 py-4 text-center space-x-6">
                                    <a href="{{ route('user.menus.edit', $menu->id) }}"
                                        class="text-blue-400 hover:text-blue-300 font-semibold">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('user.menus.destroy', $menu->id) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Yakin ingin menghapus menu ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-400 hover:text-red-300 font-semibold">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-6 text-gray-400">Belum ada menu ditambahkan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
