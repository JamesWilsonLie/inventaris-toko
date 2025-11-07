<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Game;
use App\Models\Item;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function index(Request $request)
    {
        $query = Akun::with('game');

        if ($request->has('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        if ($request->has('game_id')) {
            $query->where('game_id', $request->game_id);
        }

        $akun = $query->orderBy('id', 'desc')->paginate(10);
        $games = Game::all();

        return view('akun.index', compact('akun', 'games'));
    }

    public function home()
    {
        // Ambil semua akun reseller
        $resellerAccounts = Akun::where('jenis', 'reseller')->get();

        // Label untuk grafik: nama akun
        $labels = $resellerAccounts->pluck('nama')->toArray();

        // Dataset: estimasi keuntungan = harga_jual - harga_beli
        $profit = $resellerAccounts->map(function($akun){
            return $akun->harga_jual - $akun->harga_beli;
        })->toArray();

        // Dataset tambahan: harga_beli dan harga_jual (opsional untuk perbandingan)
        $hargaBeli = $resellerAccounts->pluck('harga_beli')->toArray();
        $hargaJual = $resellerAccounts->pluck('harga_jual')->toArray();

        // Total tahunan dan bulanan
        $totalProfit = array_sum($profit);
        $monthlyProfit = round($totalProfit / 12, 2); // estimasi per bulan

        return view('index', compact('labels', 'profit', 'hargaBeli', 'hargaJual', 'totalProfit', 'monthlyProfit'));
    }


    public function create()
    {
        $games = Game::all();
        return view('akun.create', compact('games'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'game_id' => 'required|exists:games,id',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'note' => 'nullable|string',
            'jenis' => 'required|in:personal,reseller',
            'harga_beli' => 'nullable|numeric',
            'harga_jual' => 'nullable|numeric',
        ]);

        Akun::create($validated);

        return redirect()->route('akun.index')->with('success', 'Akun berhasil ditambahkan!');
    }

    public function show($id)
    {
        $akun = Akun::with('items')->findOrFail($id);
        $allItems = Item::orderBy('nama')->get(); // untuk dropdown

        return view('akun.show', compact('akun', 'allItems'));
    }


    public function edit(Akun $akun)
    {
        $games = Game::all();
        return view('akun.edit', compact('akun', 'games'));
    }

    public function update(Request $request, Akun $akun)
    {
        $validated = $request->validate([
            'game_id' => 'required|exists:games,id',
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'note' => 'nullable|string',
            'jenis' => 'required|in:personal,reseller',
            'harga_beli' => 'nullable|numeric',
            'harga_jual' => 'nullable|numeric',
        ]);

        $akun->update($validated);

        return redirect()->route('akun.index')->with('success', 'Akun berhasil diperbarui!');
    }

    public function destroy(Akun $akun)
    {
        $akun->delete();
        return redirect()->route('akun.index')->with('success', 'Akun berhasil dihapus!');
    }
}
