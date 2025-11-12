<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Item;
use App\Models\AkunItem;
use Illuminate\Http\Request;

class AkunItemController extends Controller
{
    public function store(Request $request, $akun_id)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:item,id',
            'jumlah' => 'required|integer|min:1',
            'harga_jual' => 'nullable|numeric',
            'note' => 'nullable|string',
        ]);

        AkunItem::create(array_merge(['akun_id' => $akun_id], $validated));

        return redirect()->route('akun.show', $akun_id)
            ->with('success', 'Item berhasil ditambahkan ke akun!');
    }

    public function edit($akun_id, $item_id)
    {
        $akun = Akun::findOrFail($akun_id);
        $item = Item::findOrFail($item_id);
        $akunItem = $akun->items()->where('item_id', $item_id)->first();

        return view('akun.edit2', compact('akun', 'item', 'akunItem'));
    }

    public function update(Request $request, $akun_id, $item_id)
    {
        $validated = $request->validate([
            'jumlah' => 'required|integer|min:1',
            'harga_jual' => 'nullable|numeric',
            'note' => 'nullable|string',
        ]);

        $akunItem = AkunItem::where('akun_id', $akun_id)->where('item_id', $item_id)->first();
        $akunItem->update($validated);

        return redirect()->route('akun.show', $akun_id)
            ->with('success', 'Item berhasil diperbarui!');
    }

    public function destroy($akun_id, $item_id)
    {
        $akunItem = AkunItem::where('akun_id', $akun_id)->where('item_id', $item_id)->firstOrFail();
        $akunItem->delete();

        return redirect()->route('akun.show', $akun_id)->with('success', 'Item berhasil dihapus dari akun!');
    }

}
