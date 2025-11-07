@extends('layouts.app')

@section('title', 'Item | Edit')

@section('content')
<div class="row">
  <div class="col-lg-8 mx-auto">
    <div class="card">
      <div class="card-body p-4">
        <h5 class="card-title fw-semibold mb-4">Edit Item: {{ $item->nama }}</h5>

        <form action="{{ route('item.update', $item->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label for="nama" class="form-label">Nama Item</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $item->nama) }}" required>
            @error('nama') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="harga_pasar" class="form-label">Harga Pasar</label>
            <input type="number" class="form-control" id="harga_pasar" name="harga_pasar" value="{{ old('harga_pasar', $item->harga_pasar) }}">
          </div>

          <div class="mb-3">
            <label for="note" class="form-label">Catatan</label>
            <textarea class="form-control" id="note" name="note" rows="3">{{ old('note', $item->note) }}</textarea>
          </div>

          <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('item.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-success">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
