<x-app-layout>
    <div class="min-h-screen bg-gray-900 flex items-center justify-center">
        <div class="w-full max-w-7xl bg-white p-10 rounded-xl shadow-2xl mt-12">
            <h1 class="text-3xl font-bold mb-6 text-gray-900">Edit User</h1>

            <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block font-semibold mb-2 text-gray-700">Nama</label>
                    <input type="text" name="name" id="name"
                        value="{{ old('name', $user->name) }}"
                        class="w-full bg-white border border-gray-300 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-900"
                        required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block font-semibold mb-2 text-gray-700">Email</label>
                    <input type="email" name="email" id="email"
                        value="{{ old('email', $user->email) }}"
                        class="w-full bg-white border border-gray-300 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-900"
                        required>
                </div>

                <div class="mb-4">
                    <label for="role" class="block font-semibold mb-2 text-gray-700">Role</label>
                    <select name="role" id="role"
                        class="w-full bg-white border border-gray-300 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-900"
                        required>
                        <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="password" class="block font-semibold mb-2 text-gray-700">Password (kosongkan jika tidak ingin diubah)</label>
                    <input type="password" name="password" id="password"
                        class="w-full bg-white border border-gray-300 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-900">
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.users.index') }}"
                        class="bg-gray-600 hover:bg-gray-500 text-white px-6 py-3 rounded-lg font-semibold">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
