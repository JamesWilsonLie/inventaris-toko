@extends('layouts.app')

@section('title', 'Akun | Index')

@section('content')
<div class="row">
  <div class="col-lg-12 d-flex align-items-stretch">
    <div class="card w-100">
      <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="card-title fw-semibold">List Akun</h5>
          <a href="{{ route('akun.create') }}" class="btn btn-primary btn-sm">
            <i class="ti ti-plus"></i> Tambah Akun
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
                <th><h6 class="fw-semibold mb-0">Game</h6></th>
                <th><h6 class="fw-semibold mb-0">Nama Akun</h6></th>
                <th><h6 class="fw-semibold mb-0">Jenis</h6></th>
                <th><h6 class="fw-semibold mb-0">Harga Beli</h6></th>
                <th><h6 class="fw-semibold mb-0">Harga Jual</h6></th>
                <th><h6 class="fw-semibold mb-0">Aksi</h6></th>
              </tr>
            </thead>
            <tbody>
              @forelse($akun as $index => $a)
                <tr>
                  <td><h6 class="fw-semibold mb-0">{{ $index + 1 }}</h6></td>
                  <td><p class="mb-0 fw-normal">{{ $a->game->nama }}</p></td>
                  <td><p class="mb-0 fw-normal">{{ $a->nama }}</p></td>
                  <td>
                    <span class="badge 
                      @if($a->jenis == 'personal') bg-primary 
                      @else bg-success @endif 
                      rounded-3 fw-semibold">
                      {{ ucfirst($a->jenis) }}
                    </span>
                  </td>
                  <td><h6 class="fw-semibold mb-0 fs-4">Rp. {{ number_format($a->harga_beli, 0, ',', '.') }}</h6></td>
                  <td><h6 class="fw-semibold mb-0 fs-4">Rp. {{ number_format($a->harga_jual, 0, ',', '.') }}</h6></td>
                  <td>
                    <div class="d-flex gap-2">
                      <a href="{{ route('akun.show', $a->id) }}" class="btn btn-sm btn-info text-white">
                        <i class="ti ti-eye"></i>
                      </a>
                      <a href="{{ route('akun.edit', $a->id) }}" class="btn btn-sm btn-warning text-white">
                        <i class="ti ti-pencil"></i>
                      </a>
                      <form action="{{ route('akun.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun ini?')">
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
                  <td colspan="7" class="text-center py-4">
                    <em>Belum ada data akun.</em>
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
