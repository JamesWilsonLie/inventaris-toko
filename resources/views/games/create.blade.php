@extends('layouts.app')

@section('title', 'Games | Tambah')

@section('content')
<div class="container">
    <h3>Tambah Game Baru</h3>

    <form action="{{ route('games.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Game</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
            @error('nama')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('games.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
