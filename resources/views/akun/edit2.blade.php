@extends('layouts.app')

@section('title', 'Edit Item | Akun')

@section('content')
<div class="row">
  <div class="col-lg-12 d-flex align-items-stretch">
    <div class="card w-100">
      <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="container">
                <h3>Edit Akun Item: {{ $akunItem->nama }}</h3>

                <form action="{{ route('akun_item.update', [$akun->id, $item->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ old('jumlah', $akunItem->pivot->jumlah) }}" min="1" required>
                    </div>

                    <div class="mb-3">
                        <label for="harga_jual" class="form-label">Harga Jual</label>
                        <input type="number" name="harga_jual" id="harga_jual" class="form-control" value="{{ old('harga_jual', $akunItem->pivot->harga_jual) }}">
                    </div>

                    <div class="mb-3">
                        <label for="note" class="form-label">Note</label>
                        <input type="text" name="note" id="note" class="form-control" value="{{ old('note', $akunItem->pivot->note) }}">
                    </div>

                    <button type="submit" class="btn btn-success">Update Item</button>
                    <a href="{{ route('akun.show', $akun->id) }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
