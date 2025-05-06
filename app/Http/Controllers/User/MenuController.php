<?php


namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('user.menus.index', compact('menus'));
    }
    public function create()
    {
        return view('user.menus.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Debug input
        \Log::info('Request masuk ke store()', $request->all());

        // Proses upload gambar jika ada
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('menu_images', 'public');
        }

        // Simpan data ke database, dengan penanganan error
        try {
            Menu::create($validated);
            return redirect()->route('user.menus.index')->with('success', 'Menu berhasil ditambahkan.');
        } catch (\Exception $e) {
            \Log::error('Gagal menyimpan menu: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }


    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('user.menus.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $menu = Menu::findOrFail($id);

        // Hapus gambar lama jika ada dan user upload gambar baru
        if ($request->hasFile('image')) {
            if ($menu->image && Storage::disk('public')->exists($menu->image)) {
                Storage::disk('public')->delete($menu->image);
            }

            // Simpan gambar baru
            $validated['image'] = $request->file('image')->store('menu_images', 'public');
        }

        // Update data menu
        $menu->update($validated);

        return redirect()->route('user.menus.index')->with('success', 'Menu berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('user.menus.index')->with('success', 'Menu berhasil dihapus!');
    }
}

