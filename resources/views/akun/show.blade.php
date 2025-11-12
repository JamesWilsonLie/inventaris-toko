@extends('layouts.app')

@section('title', 'Akun | Detail')

@section('content')
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="card-title fw-semibold">Detail Akun</h5>
                    <a href="{{ route('akun.index') }}" class="btn btn-secondary btn-sm">
                        <i class="ti ti-arrow-left"></i> Kembali
                    </a>
                </div>

                <div class="mb-4">
                    <h6 class="fw-semibold">Game:</h6>
                    <p>{{ $akun->game->nama }}</p>

                    <h6 class="fw-semibold">Nama Akun:</h6>
                    <p>{{ $akun->nama }}</p>

                    <h6 class="fw-semibold">Jenis: 
                        <span class="badge 
                            @if($akun->jenis == 'personal') bg-primary 
                            @else bg-success @endif 
                            rounded-3 fw-semibold">
                            {{ ucfirst($akun->jenis) }}
                        </span>
                    </h6>

                    <h6 class="fw-semibold">Deskripsi:</h6>
                    <p>{{ $akun->deskripsi }}</p>
                    <h6 class="fw-semibold">Catatan:</h6>
                    <p>{{ $akun->note }}</p>
                    <p><strong>Harga Beli:</strong> Rp {{ number_format($akun->harga_beli, 0, ',', '.') }}</p>
                    <p><strong>Harga Jual:</strong> Rp {{ number_format($akun->harga_jual, 0, ',', '.') }}</p>
                    <p><strong>Estimasi Keuntungan:</strong> 
                        <span class="fw-bold text-success">Rp {{ number_format($profit, 0, ',', '.') }}</span>
                    </p>
                </div>

                <hr>

                <div class="mb-4">
                    <h5 class="card-title fw-semibold">Daftar Item</h5>

                    <form action="{{ route('akun_item.store', $akun->id) }}" method="POST" class="mb-3 d-flex gap-2 align-items-center">
                        @csrf
                        <select name="item_id" class="form-control" required>
                            <option value="">-- Pilih Item --</option>
                            @foreach($allItems as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }} ({{ number_format($item->harga_pasar,0,',','.') }})</option>
                            @endforeach
                        </select>
                        <input type="number" name="jumlah" placeholder="Jumlah" class="form-control" min="1" required>
                        <input type="number" name="harga_jual" placeholder="Harga Jual" class="form-control">
                        <input type="text" name="note" placeholder="Note" class="form-control">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>

                    @if($akun->items->isEmpty())
                        <p><em>Belum ada item terkait akun ini.</em></p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered text-nowrap align-middle">
                                <thead class="text-dark fs-5">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Item</th>
                                        <th>Jumlah</th>
                                        <th>Harga Jual</th>
                                        <th>Note</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($akun->items as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->pivot->jumlah }}</td>
                                            <td>{{ number_format($item->pivot->harga_jual ?? 0,0,',','.') }}</td>
                                            <td>{{ $item->pivot->note }}</td>
                                            <td class="d-flex gap-1">
                                                <a href="{{ route('akun_item.edit', [$akun->id, $item->id]) }}" class="btn btn-sm btn-warning">
                                                    <i class="ti ti-pencil"></i>
                                                </a>
                                                
                                                <form action="{{ route('akun_item.destroy', [$akun->id, $item->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus item ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <h5 class="fw-semibold mb-3">Grafik Estimasi Keuntungan</h5>
                            <canvas id="akunProfitChart" height="120"></canvas>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('akunProfitChart').getContext('2d');
    const akunProfitChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Nilai (Rp)',
                data: {!! json_encode($values) !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(54, 162, 235, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Perbandingan Harga & Keuntungan',
                    font: { size: 16 }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const value = context.raw || 0;
                            return 'Rp. ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    },
                    title: {
                        display: true,
                        text: 'Rupiah (Rp)',
                        font: { size: 12 }
                    }
                }
            }
        }
    });
</script>

@endsection
