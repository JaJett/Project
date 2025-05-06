<x-app-layout>
    <div class="min-h-screen bg-gray-900 p-10">
        <div class="max-w-7xl mx-auto bg-white p-10 rounded-2xl shadow-2xl mt-12">
            <h1 class="text-4xl font-bold mb-8 text-gray-900">Manajemen User</h1>
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-8">
                <a href="{{ route('admin.users.create') }}"
                    class="bg-green-600 hover:bg-green-500 text-gray-900 px-8 py-4 rounded-lg font-semibold text-lg shadow">
                    + Tambah User
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-gray-800 border border-gray-700 rounded-lg text-lg text-gray-100">
                    <thead>
                        <tr class="bg-gray-700 uppercase text-sm text-gray-300">
                            <th class="px-8 py-4 text-left">Nama</th>
                            <th class="px-8 py-4 text-left">Email</th>
                            <th class="px-8 py-4 text-left">Role</th>
                            <th class="px-8 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b border-gray-700 hover:bg-gray-700 transition">
                                <td class="px-8 py-4">{{ $user->name }}</td>
                                <td class="px-8 py-4">{{ $user->email }}</td>
                                <td class="px-8 py-4">{{ ucfirst($user->role) }}</td>
                                <td class="px-8 py-4 text-center space-x-6">
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                        class="text-blue-400 hover:text-blue-300 font-semibold">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
