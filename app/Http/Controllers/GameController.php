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

    public function create()
    {
        return view('games.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|unique:games,nama|max:255',
        ]);

        Game::create($validated);

        return redirect()->route('games.index')->with('success', 'Game berhasil ditambahkan!');
    }

    public function edit(Game $game)
    {
        return view('games.edit', compact('game'));
    }

    public function update(Request $request, Game $game)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:games,nama,' . $game->id,
        ]);

        $game->update($validated);

        return redirect()->route('games.index')->with('success', 'Game berhasil diperbarui!');
    }

    public function destroy(Game $game)
    {
        $game->delete();
        return redirect()->route('games.index')->with('success', 'Game berhasil dihapus!');
    }
}
