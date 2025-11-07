<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Item;
use App\Models\AkunItem;
use Illuminate\Http\Request;

class AkunItemController extends Controller
{
    public function index($akun_id)
    {
        $akun = Akun::with('items')->findOrFail($akun_id);
        $allItems = Item::orderBy('nama')->get();
        return view('akun_item.index', compact('akun', 'allItems'));
    }

    public function store(Request $request, $akun_id)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:item,id',
            'jumlah' => 'required|integer|min:1',
            'harga_jual' => 'nullable|numeric',
            'note' => 'nullable|string',
        ]);

        AkunItem::create([
            'akun_id' => $akun_id,
            ...$validated
        ]);

        return redirect()->back()->with('success', 'Item berhasil ditambahkan ke akun!');
    }

    public function destroy($akun_id, AkunItem $akunItem)
    {
        $akunItem->delete();
        return redirect()->back()->with('success', 'Item berhasil dihapus dari akun!');
    }
}
