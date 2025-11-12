@extends('layouts.app')

@section('title', 'Dashboard | Sistem Inventaris')

@section('content')
<link href="{{ asset('graph/css/sb-admin-2.min.css')}}" rel="stylesheet">
<link href="{{ asset('graph/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

<h3 class="fw-semibold mb-4">Selamat datang, {{ Auth::user()->name }}!</h3>
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Akun (Personal)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ number_format($personalCount, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Akun (Reseller)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ number_format($resellerCount, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Game</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ number_format($gameCount, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Item</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ number_format($itemCount, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <h4 class="mb-4 fw-semibold text-primary">Estimasi Keuntungan Akun Reseller</h4>

    <div class="d-flex justify-content-end align-items-center mb-3 gap-3 flex-wrap">
        <div>
            <label for="sortSelect" class="fw-semibold me-2">Urutkan berdasarkan:</label>
            <select id="sortSelect" class="form-select d-inline-block w-auto">
                <option value="default">Default</option>
                <option value="profit_desc">Keuntungan Tertinggi</option>
                <option value="profit_asc">Keuntungan Terendah</option>
                <option value="jual_desc">Harga Jual Tertinggi</option>
                <option value="beli_asc">Harga Beli Terendah</option>
            </select>
        </div>

        <div>
            <label for="limitSelect" class="fw-semibold me-2">Tampilkan:</label>
            <select id="limitSelect" class="form-select d-inline-block w-auto">
                <option value="5">5 Data</option>
                <option value="10">10 Data</option>
                <option value="20">20 Data</option>
                <option value="all">Semua</option>
            </select>
        </div>
    </div>

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

    <div class="card shadow mb-4">
        <div class="card-body">
            <h5 class="fw-semibold text-secondary mb-3">Tren Keuntungan Akun</h5>
            <canvas id="profitLineChart" height="100"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const originalData = {
        labels: {!! json_encode($labels) !!},
        profit: {!! json_encode($profit) !!},
        hargaBeli: {!! json_encode($hargaBeli) !!},
        hargaJual: {!! json_encode($hargaJual) !!}
    };

    let combinedData = originalData.labels.map((label, i) => ({
        label,
        profit: originalData.profit[i],
        beli: originalData.hargaBeli[i],
        jual: originalData.hargaJual[i],
    }));

    const ctxBar = document.getElementById('profitChart').getContext('2d');
    const profitChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: originalData.labels,
            datasets: [
                {
                    label: 'Estimasi Keuntungan (Rp)',
                    data: originalData.profit,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                },
                {
                    label: 'Harga Beli (Rp)',
                    data: originalData.hargaBeli,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                },
                {
                    label: 'Harga Jual (Rp)',
                    data: originalData.hargaJual,
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
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: v => 'Rp ' + v.toLocaleString('id-ID')
                    }
                }
            }
        }
    });

    const ctxLine = document.getElementById('profitLineChart').getContext('2d');
    const profitLineChart = new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: originalData.labels,
            datasets: [{
                label: 'Trend Keuntungan (Rp)',
                data: originalData.profit,
                fill: false,
                borderColor: 'rgba(255, 206, 86, 1)',
                backgroundColor: 'rgba(255, 206, 86, 0.3)',
                tension: 0.3,
                pointRadius: 4,
                pointHoverRadius: 6,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                title: {
                    display: true,
                    text: 'Tren Keuntungan per Akun Reseller',
                    font: { size: 16 }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: v => 'Rp ' + v.toLocaleString('id-ID')
                    }
                }
            }
        }
    });

    function updateCharts(sortedData) {
        const limit = document.getElementById('limitSelect').value;
        let limitedData = [...sortedData];

        if (limit !== 'all') {
            limitedData = sortedData.slice(0, parseInt(limit));
        }

        const labels = limitedData.map(d => d.label);
        const profit = limitedData.map(d => d.profit);
        const beli = limitedData.map(d => d.beli);
        const jual = limitedData.map(d => d.jual);

        profitChart.data.labels = labels;
        profitChart.data.datasets[0].data = profit;
        profitChart.data.datasets[1].data = beli;
        profitChart.data.datasets[2].data = jual;
        profitChart.update();

        profitLineChart.data.labels = labels;
        profitLineChart.data.datasets[0].data = profit;
        profitLineChart.update();
    }

    document.getElementById('sortSelect').addEventListener('change', function() {
        const val = this.value;
        let sorted = [...combinedData];

        switch (val) {
            case 'profit_desc':
                sorted.sort((a, b) => b.profit - a.profit);
                break;
            case 'profit_asc':
                sorted.sort((a, b) => a.profit - b.profit);
                break;
            case 'jual_desc':
                sorted.sort((a, b) => b.jual - a.jual);
                break;
            case 'beli_asc':
                sorted.sort((a, b) => a.beli - b.beli);
                break;
            default:
                sorted = [...combinedData];
        }

        updateCharts(sorted);
    });

    document.getElementById('limitSelect').addEventListener('change', function() {
        document.getElementById('sortSelect').dispatchEvent(new Event('change'));
    });

    updateCharts(combinedData);
</script>

@endsection
