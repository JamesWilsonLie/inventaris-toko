@extends('layouts.app')

@section('title', 'Item | Index')

@section('content')
<div class="row">
  <div class="col-lg-12 d-flex align-items-stretch">
    <div class="card w-100">
      <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="card-title fw-semibold mb-0">List Item</h5>
          <a href="{{ route('item.create') }}" class="btn btn-primary btn-sm">
            <i class="ti ti-plus"></i> Tambah Item
          </a>
        </div>

        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="text-dark fs-4">
              <tr>
                <th><h6 class="fw-semibold mb-0">#</h6></th>
                <th><h6 class="fw-semibold mb-0">Nama Item</h6></th>
                <th><h6 class="fw-semibold mb-0">Harga Pasar</h6></th>
                <th><h6 class="fw-semibold mb-0">Catatan</h6></th>
                <th><h6 class="fw-semibold mb-0">Aksi</h6></th>
              </tr>
            </thead>
            <tbody>
              @forelse($items as $index => $item)
                <tr>
                  <td><h6 class="fw-semibold mb-0">{{ $index + 1 }}</h6></td>
                  <td><p class="mb-0 fw-normal">{{ $item->nama }}</p></td>
                  <td data-sort="{{ $item->harga_pasar ?? 0 }}">
                    <h6 class="fw-semibold mb-0 fs-4">
                      Rp. {{ $item->harga_pasar ? number_format($item->harga_pasar, 0, ',', '.') : '-' }}
                    </h6>
                  </td>
                  <td><p class="mb-0 fw-normal text-muted">{{ $item->note ?: '-' }}</p></td>
                  <td>
                    <div class="d-flex gap-2">
                      <a href="{{ route('item.edit', $item->id) }}" class="btn btn-sm btn-warning text-white">
                        <i class="ti ti-pencil"></i>
                      </a>
                      <form action="{{ route('item.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus item ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                          <i class="ti ti-trash"></i>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center py-4">
                    <em>Belum ada data item.</em>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
