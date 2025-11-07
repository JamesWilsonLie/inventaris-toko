<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::orderBy('nama')->get();
        return view('games.index', compact('games'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|unique:games,nama|max:255',
        ]);

        Game::create($validated);

        return redirect()->back()->with('success', 'Game berhasil ditambahkan!');
    }

    public function destroy(Game $game)
    {
        $game->delete();
        return redirect()->back()->with('success', 'Game berhasil dihapus!');
    }
}
