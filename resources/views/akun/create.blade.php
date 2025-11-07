@extends('layouts.app')

@section('title', 'Akun | Tambah')

@section('content')
<div class="container">
    <h3>Tambah Akun Baru</h3>
    <form action="{{ route('akun.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="game_id" class="form-label">Pilih Game</label>
            <select name="game_id" id="game_id" class="form-select" required>
                <option value="">-- Pilih Game --</option>
                @foreach ($games as $game)
                    <option value="{{ $game->id }}">{{ $game->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Akun</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis Akun</label>
            <select name="jenis" id="jenis" class="form-select" required>
                <option value="personal">Personal</option>
                <option value="reseller">Reseller</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="harga_beli" class="form-label">Harga Beli</label>
            <input type="number" step="0.01" name="harga_beli" id="harga_beli" class="form-control">
        </div>

        <div class="mb-3">
            <label for="harga_jual" class="form-label">Harga Jual</label>
            <input type="number" step="0.01" name="harga_jual" id="harga_jual" class="form-control">
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="note" class="form-label">Catatan</label>
            <textarea name="note" id="note" rows="2" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('akun.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
