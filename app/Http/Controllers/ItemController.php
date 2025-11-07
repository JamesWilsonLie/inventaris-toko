<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::orderBy('nama')->paginate(10);
        return view('item.index', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'harga_pasar' => 'nullable|numeric',
            'note' => 'nullable|string',
        ]);

        Item::create($validated);
        return redirect()->back()->with('success', 'Item berhasil ditambahkan!');
    }

    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'harga_pasar' => 'nullable|numeric',
            'note' => 'nullable|string',
        ]);

        $item->update($validated);
        return redirect()->back()->with('success', 'Item berhasil diperbarui!');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->back()->with('success', 'Item berhasil dihapus!');
    }
}
