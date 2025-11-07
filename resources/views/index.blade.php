@extends('layouts.app')

@section('title', 'Dashboard | Sistem Inventaris')

@section('content')
  <h3 class="fw-semibold mb-4">Selamat datang, {{ Auth::user()->name }}!</h3>

<div class="container">
    <h4 class="mb-4 fw-semibold text-primary">Estimasi Keuntungan Akun Reseller</h4>

    <div class="card shadow mb-4">
        <div class="card-body">
            <canvas id="profitChart" height="120"></canvas>
        </div>
    </div>

    <div class="row text-center mt-4">
        <div class="col-md-6">
            <div class="card bg-light shadow-sm p-3">
                <h6 class="fw-semibold text-secondary">Total Estimasi Keuntungan Tahunan</h6>
                <h4 class="text-success fw-bold">Rp. {{ number_format($totalProfit, 0, ',', '.') }}</h4>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-light shadow-sm p-3">
                <h6 class="fw-semibold text-secondary">Estimasi Keuntungan Bulanan</h6>
                <h4 class="text-primary fw-bold">Rp. {{ number_format($monthlyProfit, 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('profitChart').getContext('2d');
    const profitChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [
                {
                    label: 'Estimasi Keuntungan (Rp)',
                    data: {!! json_encode($profit) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                },
                {
                    label: 'Harga Beli (Rp)',
                    data: {!! json_encode($hargaBeli) !!},
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                },
                {
                    label: 'Harga Jual (Rp)',
                    data: {!! json_encode($hargaJual) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                title: {
                    display: true,
                    text: 'Grafik Estimasi Keuntungan Akun Reseller',
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
                },
                x: {
                    title: {
                        display: true,
                        text: 'Nama Akun',
                        font: { size: 12 }
                    }
                }
            }
        }
    });
</script><div class="card shadow mt-4">
    <div class="card-body">
        <canvas id="profitLineChart" height="100"></canvas>
    </div>
</div>

<script>
const lineCtx = document.getElementById('profitLineChart').getContext('2d');
const profitLineChart = new Chart(lineCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode($labels) !!},
        datasets: [{
            label: 'Trend Keuntungan',
            data: {!! json_encode($profit) !!},
            fill: false,
            borderColor: 'rgba(255, 206, 86, 1)',
            backgroundColor: 'rgba(255, 206, 86, 0.2)',
            tension: 0.3
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'top' },
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return 'Rp ' + value.toLocaleString('id-ID');
                    }
                }
            }
        }
    }
});
</script>

@endsection
