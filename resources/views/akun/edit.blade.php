@extends('layouts.app')

@section('title', 'Akun | Edit')

@section('content')
<div class="container">
    <h3>Edit Akun: {{ $akun->nama }}</h3>
    <form action="{{ route('akun.update', $akun->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="game_id" class="form-label">Pilih Game</label>
            <select name="game_id" id="game_id" class="form-select" required>
                @foreach ($games as $game)
                    <option value="{{ $game->id }}" {{ $akun->game_id == $game->id ? 'selected' : '' }}>
                        {{ $game->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Akun</label>
            <input type="text" name="nama" id="nama" value="{{ $akun->nama }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis Akun</label>
            <select name="jenis" id="jenis" class="form-select" required>
                <option value="personal" {{ $akun->jenis == 'personal' ? 'selected' : '' }}>Personal</option>
                <option value="reseller" {{ $akun->jenis == 'reseller' ? 'selected' : '' }}>Reseller</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="harga_beli" class="form-label">Harga Beli</label>
            <input type="number" step="0.01" name="harga_beli" id="harga_beli" 
                value="{{ $akun->harga_beli }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="harga_jual" class="form-label">Harga Jual</label>
            <input type="number" step="0.01" name="harga_jual" id="harga_jual" 
                value="{{ $akun->harga_jual }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control">{{ $akun->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label for="note" class="form-label">Catatan</label>
            <textarea name="note" id="note" rows="2" class="form-control">{{ $akun->note }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('akun.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
