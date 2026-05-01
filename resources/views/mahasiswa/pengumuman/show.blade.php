@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center mb-4">
        {{-- 1. Tombol Kembali (Paling Kiri) --}}
        <a href="{{ route('pengumuman-mahasiswa-index') }}" class="btn btn-sm btn-white shadow-sm mr-3 border rounded-circle" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-arrow-left text-primary"></i>
        </a>
        
        {{-- 2. Judul Halaman dengan Icon Bullhorn --}}
        <h1 class="h3 mb-0 text-gray-800 font-weight-bold">
            <i class="fas fa-bullhorn mr-2 text-primary small"></i>Detail Pengumuman
        </h1>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4 border-left-{{ $item->is_urgent ? 'danger' : 'primary' }}">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-white">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-bullhorn mr-2"></i>Informasi Akademik
                    </h6>
                    @if($item->is_urgent)
                        <span class="badge badge-danger px-3 py-2">PENTING</span>
                    @endif
                </div>
                <div class="card-body text-dark">
                    <h4 class="font-weight-bold mb-3">{{ $item->judul }}</h4>
                    <div class="mb-3">
                        <small class="text-muted mr-3"><i class="fas fa-calendar-alt mr-1"></i> {{ $item->created_at->format('d M Y') }}</small>
                        <small class="text-muted"><i class="fas fa-clock mr-1"></i> {{ $item->created_at->format('H:i') }} WIB</small>
                    </div>
                    <hr>
                    <div class="isi-pengumuman" style="line-height: 1.8; white-space: pre-line; font-size: 1.1rem;">
                        {{ $item->isi }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-white">
                    <h6 class="m-0 font-weight-bold text-primary">Lampiran & File</h6>
                </div>
                <div class="card-body">
                    @if($item->file)
                        @php
                            $ekstensi = strtolower(pathinfo($item->file, PATHINFO_EXTENSION));
                        @endphp

                        <div class="text-center py-4 bg-light rounded mb-3 border">
                            {{-- Pengecekan Jenis File --}}
                            @if(in_array($ekstensi, ['jpg', 'jpeg', 'png', 'webp']))
                                {{-- Tampilan Gambar --}}
                                <img src="{{ asset('storage/pengumuman/' . $item->file) }}" class="img-fluid rounded shadow-sm border" style="max-height: 200px">
                                <div class="small font-weight-bold text-dark mt-2">Gambar Lampiran</div>

                            @elseif($ekstensi == 'pdf')
                                {{-- Tampilan PDF --}}
                                <i class="fas fa-file-pdf fa-4x text-danger mb-2"></i>
                                <div class="small font-weight-bold text-dark">Dokumen PDF</div>

                            @elseif(in_array($ekstensi, ['doc', 'docx']))
                                {{-- Tampilan Word --}}
                                <i class="fas fa-file-word fa-4x text-primary mb-2"></i>
                                <div class="small font-weight-bold text-dark">Dokumen Word</div>

                            @elseif(in_array($ekstensi, ['xls', 'xlsx', 'csv']))
                                {{-- Tampilan Excel --}}
                                <i class="fas fa-file-excel fa-4x text-success mb-2"></i>
                                <div class="small font-weight-bold text-dark">File Spreadsheet (Excel)</div>

                            @elseif(in_array($ekstensi, ['ppt', 'pptx']))
                                {{-- Tampilan PowerPoint --}}
                                <i class="fas fa-file-powerpoint fa-4x text-warning mb-2"></i>
                                <div class="small font-weight-bold text-dark">Presentasi (PPT)</div>

                            @elseif(in_array($ekstensi, ['zip', 'rar']))
                                {{-- Tampilan Archive --}}
                                <i class="fas fa-file-archive fa-4x text-secondary mb-2"></i>
                                <div class="small font-weight-bold text-dark">File Archive (Compressed)</div>

                            @else
                                {{-- Tampilan File Lainnya --}}
                                <i class="fas fa-file-alt fa-4x text-dark mb-2"></i>
                                <div class="small font-weight-bold text-dark">Dokumen Lampiran</div>
                            @endif
                        </div>

                        <div class="alert alert-info border-0 small shadow-sm">
                            <i class="fas fa-info-circle mr-1"></i> Nama File: <br>
                            <span class="font-weight-bold text-truncate d-block">{{ $item->file }}</span>
                        </div>

                        <a href="{{ asset('storage/pengumuman/' . $item->file) }}" target="_blank" class="btn btn-primary btn-block shadow-sm font-weight-bold">
                            <i class="fas fa-download mr-2"></i> Download Lampiran
                        </a>

                    @else
                        {{-- Tampilan jika tidak ada file --}}
                        <div class="text-center py-4 text-gray-400">
                            <i class="fas fa-file-slash fa-3x mb-2"></i>
                            <p class="small">Tidak ada lampiran</p>
                        </div>
                    @endif

                    <hr>
                    {{-- Info Penerbit --}}
                    <div class="p-3 bg-light rounded border shadow-xs">
                        <small class="d-block text-muted mb-1">Diterbitkan oleh:</small>
                        <div class="font-weight-bold text-dark text-sm">
                            <i class="fas fa-user-circle mr-1 text-primary"></i> 
                            {{ $item->user->name ?? 'Bagian Akademik' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

