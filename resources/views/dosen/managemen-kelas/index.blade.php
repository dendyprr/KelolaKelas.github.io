@extends('layouts.app')

@section('content')
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> 
            <i class="fas fa-fw fa-chalkboard-teacher text-primary"></i>
            {{ $title }} 
        </h1>

        <a href="{{ route('add-manajement-kelas') }}" class="btn btn-sm btn-primary shadow-sm font-weight-bold mt-3">
            <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> 
            Tambah Kelas Baru
        </a>
    </div>

    {{-- Pesan Sukses Setelah Hapus --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- Form Filter --}}
    <div class="card shadow mb-4">
        <div class="card-body bg-light">
            <form action="{{ route('manajement-kelas') }}" method="GET" class="row align-items-end">
                <div class="col-md-4 mb-2 mb-md-0">
                    <label class="small font-weight-bold">Filter Periode:</label>
                    <select name="filter_periode" class="form-control form-control-sm">
                        <option value="">Semua Periode</option>
                        {{-- Gunakan variabel $filter_periode dari controller --}}
                        <option value="Ganjil" {{ $filter_periode == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                        <option value="Genap" {{ $filter_periode == 'Genap' ? 'selected' : '' }}>Genap</option>
                    </select>
                </div>
                
                <div class="col-md-4 mb-2 mb-md-0">
                    <label class="small font-weight-bold">Tahun Ajaran:</label>
                    <select name="filter_tahun" class="form-control form-control-sm">
                        <option value="">Semua Tahun</option>
                        <option value="2023" {{ $filter_tahun == '2023' ? 'selected' : '' }}>2023</option>
                        <option value="2024" {{ $filter_tahun == '2024' ? 'selected' : '' }}>2024</option>
                        <option value="2025" {{ $filter_tahun == '2025' ? 'selected' : '' }}>2025</option>
                        <option value="2026" {{ $filter_tahun == '2026' ? 'selected' : '' }}>2026</option>
                    </select>
                </div>

                <div class="col-md-4">
                    {{-- Tombol Submit --}}
                    <button type="submit" class="btn btn-sm btn-info shadow-sm mr-1">
                        <i class="fas fa-filter fa-sm text-white-50 mr-1"></i> Terapkan
                    </button>

                    {{-- TARUH TOMBOL RESET DI SINI --}}
                    <a href="{{ route('reset-filter-kelas') }}" class="btn btn-sm btn-secondary shadow-sm">
                        <i class="fas fa-undo fa-sm text-white-50 mr-1"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        @php
            $colors = ['primary', 'success', 'info', 'warning', 'danger', 'secondary'];
        @endphp

        @forelse($data as $item)
            @php
                $currentColor = $colors[$item->id % count($colors)];
            @endphp

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-{{ $currentColor }} shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                {{-- HEADER KARTU: Kode Kelas & Tombol Hapus --}}
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <div class="text-xs font-weight-bold text-{{ $currentColor }} text-uppercase">
                                            <i class="fas fa-qrcode mr-1"></i> {{ $item->kode_kelas }}
                                        </div>
                                        <div class="badge badge-light text-dark border mt-1">
                                            <i class="fas fa-calendar-day mr-1 text-{{ $currentColor }}"></i> {{ $item->hari }}
                                        </div>
                                    </div>
                                    
                                    {{-- Tombol Hapus (Sampah) --}}
                                    <form action="{{route('hapus-manajement-kelas', $item->id)}}" method="POST" onsubmit="return confirm('Hapus jadwal {{ $item->nama_matakuliah }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-circle btn-light text-danger shadow-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>

                                <div class="h5 mb-1 font-weight-bold text-gray-800">
                                    {{ $item->nama_matakuliah }}
                                </div>

                                <div class="text-xs mb-3 text-muted">
                                    <span class="mr-2 font-weight-bold"><i class="fas fa-redo-alt mr-1 text-{{ $currentColor }}"></i>Periode {{ $item->periode }}</span>
                                    <span class="mr-2"><i class="fas fa-layer-group mr-1 text-{{ $currentColor }}"></i> Semester {{ $item->semester }}</span>
                                    <span><i class="fas fa-calendar-check mr-1 text-{{ $currentColor }}"></i> Tahun Ajaran {{ $item->tahun_ajaran }}</span>
                                </div>
                                
                                <div class="mt-3 p-2 bg-light rounded shadow-sm border">
                                    <div class="small text-dark mb-1">
                                        <i class="fas fa-door-open fa-fw text-{{ $currentColor }}"></i> 
                                        <strong>Ruang:</strong> {{ $item->ruangan ?? '-' }}
                                    </div>
                                    <div class="small text-dark mb-1">
                                        <i class="fas fa-clock fa-fw text-{{ $currentColor }}"></i> 
                                        <strong>Waktu:</strong> {{ date('H:i', strtotime($item->jam_mulai)) }} - {{ date('H:i', strtotime($item->jam_selesai)) }}
                                    </div>
                                    <div class="small text-dark">
                                        <i class="fas fa-award fa-fw text-{{ $currentColor }}"></i> 
                                        <strong>Bobot:</strong> {{ $item->jumlah_sks }} SKS
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0">
                        <a href="{{ route('detail-manajement-kelas', ['id' => $item->id, 'filter_periode' => request('filter_periode'), 'filter_tahun' => request('filter_tahun')]) }}" class="btn btn-sm btn-{{ $currentColor }} btn-block shadow-sm font-weight-bold">
                            <i class="fas fa-sign-in-alt mr-1"></i> Masuk Kelas
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                @if(!$hasFilter)
                    <div class="mb-3 text-gray-200">
                        <i class="fas fa-filter fa-4x"></i>
                    </div>
                    <h5 class="text-gray-500">Silakan gunakan filter untuk menampilkan jadwal.</h5>
                @else
                    <div class="mb-3 text-gray-200">
                        <i class="fas fa-search fa-4x"></i>
                    </div>
                    <h5 class="text-gray-500">Data tidak ditemukan.</h5>
                    <a href="{{ url()->current() }}" class="text-primary font-weight-bold">Reset Pencarian</a>
                @endif
            </div>
        @endforelse
    </div>
@endsection