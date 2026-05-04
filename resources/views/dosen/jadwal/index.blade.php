@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">
                <i class="fas fa-chalkboard-teacher text-primary mr-2"></i>
                {{ $title }}
            </h1>
            <p class="mb-0 text-gray-600 small">
                <span class="badge badge-primary-soft text-primary border border-primary px-2" style="background-color: #eef2ff;">
                    <i class="fas fa-info-circle mr-1"></i> Periode: {{ $periodeAktif }} {{ $tahunSekarang }}
                </span>
            </p>
        </div>
        <div class="badge badge-white shadow-sm border p-2 text-gray-700">
            <i class="fas fa-calendar-alt text-primary mr-1"></i>
            <span class="font-weight-bold">{{ $hariIni }}, {{ date('d F Y') }}</span>
        </div>
    </div>

    <ul class="nav nav-tabs border-bottom-0" id="jadwalTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active font-weight-bold shadow-sm" id="today-tab" data-toggle="tab" href="#today" role="tab" style="border-radius: 10px 10px 0 0;">
                <i class="fas fa-play-circle mr-1 text-success"></i> Hari Ini
            </a>
        </li>
        <li class="nav-item ml-2">
            <a class="nav-link font-weight-bold shadow-sm text-gray-600" id="tomorrow-tab" data-toggle="tab" href="#tomorrow" role="tab" style="border-radius: 10px 10px 0 0;">
                <i class="fas fa-forward mr-1 text-primary"></i> Besok ({{ $besok }})
            </a>
        </li>
    </ul>

    <div class="tab-content card shadow mb-4 border-top-0" id="jadwalTabContent" style="border-radius: 0 0 15px 15px;">
        
        {{-- TAB HARI INI --}}
        <div class="tab-pane fade show active p-4" id="today" role="tabpanel">
            <div class="row">
                @forelse($jadwalHariIni as $key => $item)
                    @php
                        $now = date('H:i:s');
                        $isOngoing = ($now >= $item->jam_mulai && $now <= $item->jam_selesai);
                        
                        // Array warna untuk variasi card
                        $colors = ['primary', 'info', 'warning', 'danger', 'secondary', 'dark'];
                        // Ambil warna berdasarkan sisa bagi (modulo) index
                        $variantColor = $colors[$key % count($colors)];
                        
                        // Jika Sedang Berlangsung, warna wajib Hijau (Success)
                        $currentColor = $isOngoing ? 'success' : $variantColor;
                    @endphp
                    <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                        <div class="card border-left-{{ $currentColor }} shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div class="text-xs font-weight-bold text-{{ $currentColor }} text-uppercase">
                                                <i class="fas fa-qrcode mr-1"></i> {{ $item->kode_kelas }}
                                            </div>
                                            @if($isOngoing)
                                                <div class="badge badge-success shadow-sm px-2 py-1 animate-pulse" style="font-size: 0.65rem;">
                                                    <i class="fas fa-broadcast-tower mr-1"></i> LIVE
                                                </div>
                                            @endif
                                        </div>
                                        <div class="h5 mb-1 font-weight-bold text-gray-800">{{ $item->nama_matakuliah }}</div>
                                        <div class="text-xs mb-3 text-muted">
                                            <span class="mr-2"><i class="fas fa-layer-group mr-1 text-{{ $currentColor }}"></i> Smt {{ $item->semester }}</span>
                                            <span><i class="fas fa-tag mr-1 text-{{ $currentColor }}"></i> {{ $item->tahun_ajaran }}</span>
                                        </div>
                                        
                                        <div class="mt-3 p-3 bg-light rounded border">
                                            <div class="row mb-2">
                                                <div class="col-1 text-{{ $currentColor }}"><i class="fas fa-clock fa-fw"></i></div>
                                                <div class="col-10 small font-weight-bold text-dark">{{ date('H:i', strtotime($item->jam_mulai)) }} - {{ date('H:i', strtotime($item->jam_selesai)) }} WIB</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-1 text-{{ $currentColor }}"><i class="fas fa-map-marker-alt fa-fw"></i></div>
                                                <div class="col-10 small text-dark">Ruang: {{ $item->ruangan ?? '-' }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-1 text-{{ $currentColor }}"><i class="fas fa-users fa-fw"></i></div>
                                                <div class="col-10 small text-dark">SKS: {{ $item->jumlah_sks ?? '-' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-0 pt-0 mt-2">
                                <a href="{{ route('detail-manajement-kelas', ['id' => $item->id]) }}" class="btn btn-sm btn-{{ $currentColor }} btn-block shadow-sm font-weight-bold py-2">
                                    <i class="fas fa-sign-in-alt mr-1"></i> Masuk Kelas
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="text-gray-300 mb-3"><i class="fas fa-calendar-times fa-4x"></i></div>
                        <h5 class="text-gray-500 font-weight-bold">Tidak ada agenda mengajar hari ini.</h5>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- TAB BESOK --}}
        <div class="tab-pane fade p-4" id="tomorrow" role="tabpanel">
            <div class="row">
                @forelse($jadwalBesok as $key => $item)
                    @php
                        $colors = ['primary', 'info', 'warning', 'danger', 'secondary', 'dark'];
                        $currentColor = $colors[$key % count($colors)];
                    @endphp
                    <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                        <div class="card border-left-{{ $currentColor }} shadow h-100 py-2" style="opacity: 0.85;">
                            <div class="card-body">
                                <div class="text-xs font-weight-bold text-{{ $currentColor }} text-uppercase mb-2">
                                    <i class="fas fa-qrcode mr-1"></i> {{ $item->kode_kelas }}
                                </div>
                                <div class="h5 mb-1 font-weight-bold text-gray-800">{{ $item->nama_matakuliah }}</div>
                                <div class="text-xs mb-3 text-muted">
                                    <span class="mr-2"><i class="fas fa-layer-group mr-1 text-{{ $currentColor }}"></i> Smt {{ $item->semester }}</span>
                                    <span><i class="fas fa-tag mr-1 text-{{ $currentColor }}"></i> {{ $item->tahun_ajaran }}</span>
                                </div>
                                <div class="mt-3 p-3 bg-light rounded border text-dark">
                                    <div class="small mb-1"><i class="fas fa-clock mr-2 text-{{ $currentColor }}"></i>{{ date('H:i', strtotime($item->jam_mulai)) }} WIB</div>
                                    <div class="small mb-1"><i class="fas fa-map-marker-alt mr-2 text-{{ $currentColor }}"></i>Ruang: {{ $item->ruangan }}</div>
                                    <div class="small"><i class="fas fa-users mr-2 text-{{ $currentColor }}"></i>SKS: {{ $item->jumlah_sks }}</div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-0 pt-0 mt-2">
                                <button class="btn btn-sm btn-outline-{{ $currentColor }} btn-block disabled shadow-sm font-weight-bold">
                                    <i class="fas fa-lock mr-1"></i> Belum Dibuka
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="text-gray-300 mb-3"><i class="fas fa-mug-hot fa-4x"></i></div>
                        <h5 class="text-gray-500 font-weight-bold">Besok tidak ada jadwal mengajar.</h5>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

<style>
    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: .7; transform: scale(0.95); }
    }
    .badge-primary-soft {
        font-weight: 600;
        letter-spacing: 0.5px;
    }
</style>
@endsection