@extends('layouts.app')


@section('content')
    <h1 class="h3 mb-4 text-gray-800"> 
        <i class="fas fa-fw fa-tachometer-alt text-primary"></i>
        {{ $title }}
    </h1>

    {{-- <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Earnings (Monthly)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Kelas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$totalKelas}} </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Mahasiswa Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalMahasiswa }} Orang</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Persentase Kehadiran</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">85%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white">
                <div>
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-calendar-alt mr-2"></i>Jadwal Perkuliahan
                    </h6>
                    <small class="text-muted font-weight-bold">Semester Genap 2025/2026</small>
                </div>
                
                <div class="text-right">
                    <div class="badge badge-primary-soft text-primary p-2 mb-2" style="background-color: #eef2ff; border: 1px solid #4e73df; border-radius: 5px;">
                        <i class="fas fa-clock mr-1"></i> {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                    </div>
                    
                    <ul class="nav nav-pills small justify-content-end" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active py-1" id="hari-ini-tab" data-toggle="pill" href="#hari-ini" role="tab">Hari Ini</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-1" id="besok-tab" data-toggle="pill" href="#besok" role="tab">Besok</a>
                        </li>
                    </ul>
                </div>
            </div>       
            <div class="card-body">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="hari-ini" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover border-bottom text-center m-0">
                                <thead class="bg-light">
                                    <tr class="text-muted small text-uppercase">
                                        <th width="50">No</th>
                                        <th style="width: 25%">Jam</th>
                                        <th>Mata Kuliah</th>
                                        <th>Semester</th>
                                        <th>Ruang</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pertemuanHariIni as $p)
                                    <tr>
                                        <td class="align-middle">
                                            <span class="badge badge-light border">{{ $loop->iteration }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <strong class="text-primary">
                                                {{ date('H:i', strtotime($p->kelas->jam_mulai)) }} - {{ date('H:i', strtotime($p->kelas->jam_selesai)) }}
                                            </strong>
                                        </td>
                                        <td class="align-middle">
                                            <div class="text-dark font-weight-bold">{{ $p->kelas->nama_matakuliah ?? 'N/A' }}</div>
                                            <small class="text-muted text-uppercase">PERTEMUAN KE-{{ $p->pertemuan_ke }}</small>
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge badge-light border">{{ $p->kelas->semester ?? '-' }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge badge-light border">{{ $p->kelas->kode_kelas ?? '-' }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            @php
                                                $sekarang = date('H:i:s');
                                                $jamMulai = $p->kelas->jam_mulai;
                                                $jamSelesai = $p->kelas->jam_selesai;
                                            @endphp
                                            
                                            @if($sekarang > $jamSelesai)
                                                <span class="badge badge-success text-white px-3">Selesai</span>
                                            @elseif($sekarang >= $jamMulai && $sekarang <= $jamSelesai)
                                                <span class="badge badge-warning text-white pulse px-3">Berlangsung</span>
                                            @else
                                                <span class="badge badge-secondary text-white px-3">Belum Mulai</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">
                                            <i class="fas fa-calendar-times fa-3x mb-3 d-inline-block"></i>
                                            <p class="mb-0 font-weight-bold">Tidak ada jadwal pertemuan untuk hari ini.</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="besok" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-hover border-bottom text-center">
                                <thead class="bg-light">
                                    <tr class="text-muted small text-uppercase">
                                        <th>No</th>
                                        <th style="width: 25%">Jam</th>
                                        <th>Mata Kuliah</th>
                                        <th>Semester</th>
                                        <th>Ruang</th>
                                        <th class="text-center">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pertemuanBesok as $pb)
                                    <tr class="text-center">
                                        <td class="align-middle">
                                            <span class="badge badge-light border">{{ $loop->iteration }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <strong class="text-dark">{{ date('H:i', strtotime($pb->kelas->jam_mulai)) }} - {{ date('H:i', strtotime($pb->kelas->jam_selesai)) }}</strong>
                                        </td>
                                        <td class="align-middle">
                                            <div class="text-dark font-weight-bold">{{ $pb->kelas->nama_matakuliah }}</div>
                                            <small class="text-muted">PERTEMUAN KE-{{ $pb->pertemuan_ke }}</small>
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge badge-light border">{{ $p->kelas->semester ?? '-' }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge badge-light border">{{ $pb->kelas->kode_kelas }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="badge badge-info text-white px-3">Besok</span>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            {{-- Ubah colspan menjadi 6 agar sesuai dengan jumlah kolom di header --}}
                                            <td colspan="6" class="text-center py-5 text-muted">
                                                {{-- Ikon otomatis ke tengah karena class text-center pada <td> --}}
                                                <i class="fas fa-calendar-check fa-3x mb-3 d-inline-block"></i>
                                                <p class="mb-0">Tidak ada jadwal pertemuan untuk besok.</p>
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
    </div>

    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-white d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Rangkuman Kehadiran</h6>
                <i class="fas fa-chart-pie text-gray-300"></i>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="kehadiranChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2"><i class="fas fa-circle text-success"></i> Hadir</span>
                    <span class="mr-2"><i class="fas fa-circle text-info"></i> Izin</span>
                    <span class="mr-2"><i class="fas fa-circle text-danger"></i> Alfa</span>
                </div>
                <hr>
                <div class="text-center">
                    <div class="small text-muted mb-2">Statistik per April 2026</div>
                    <button class="btn btn-sm btn-outline-primary btn-block shadow-sm">Buka Laporan Absensi</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById("kehadiranChart").getContext('2d');
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Hadir", "Izin", "Alfa"],
                datasets: [{
                    data: [85, 10, 5],
                    backgroundColor: ['#1cc88a', '#36b9cc', '#e74a3b'],
                    hoverBackgroundColor: ['#17a673', '#2c9faf', '#be2617'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });
    });

    
</script>

<style>
    /* Tambahan styling agar lebih smooth */
    .card { transition: transform .2s; }
    .card:hover { transform: scale(1.01); }
    .table td { font-size: 0.9rem; }
    .badge { padding: 0.5em 0.8em; }
    .progress { border-radius: 10px; }

    /* Efek pulse untuk kelas yang sedang berlangsung */
   /* Animasi Halus untuk kelas yang sedang berlangsung */
    .pulse {
        animation: pulse-blue 2s infinite;
        box-shadow: 0 0 0 0 rgba(246, 194, 62, 0.7);
    }
    @keyframes pulse-blue {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(246, 194, 62, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(246, 194, 62, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(246, 194, 62, 0); }
    }
    .nav-pills .nav-link.active { background-color: #4e73df; color: #fff; }
    .nav-pills .nav-link { color: #4e73df; border: 1px solid #e3e6f0; margin-left: 5px; transition: 0.3s; }
</style>
@endsection