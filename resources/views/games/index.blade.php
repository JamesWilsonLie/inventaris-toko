@extends('layouts.app')

@section('title', 'Games | Index')

@section('content')
<div class="row">
  <div class="col-lg-12 d-flex align-items-stretch">
    <div class="card w-100">
      <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="card-title fw-semibold mb-0">Daftar Game</h5>
          <a href="{{ route('games.create') }}" class="btn btn-primary btn-sm">
            <i class="ti ti-plus"></i> Tambah Game
          </a>
        </div>

        <div class="table-responsive">
          <table class="table text-nowrap mb-0 align-middle">
            <thead class="text-dark fs-4">
              <tr>
                <th><h6 class="fw-semibold mb-0">#</h6></th>
                <th><h6 class="fw-semibold mb-0">Nama Game</h6></th>
                <th><h6 class="fw-semibold mb-0">Aksi</h6></th>
              </tr>
            </thead>
            <tbody>
              @forelse($games as $index => $game)
                <tr>
                  <td><h6 class="fw-semibold mb-0">{{ $index + 1 }}</h6></td>
                  <td><p class="mb-0 fw-normal">{{ $game->nama }}</p></td>
                  <td>
                    <div class="d-flex gap-2">
                      <a href="{{ route('games.edit', $game->id) }}" class="btn btn-sm btn-warning text-white">
                        <i class="ti ti-pencil"></i>
                      </a>
                      <form action="{{ route('games.destroy', $game->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus game ini?')">
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
                  <td colspan="3" class="text-center py-4">
                    <em>Belum ada data game.</em>
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
