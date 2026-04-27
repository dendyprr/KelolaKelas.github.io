@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"> 
        <i class="fas fa-bullhorn mr-2 text-primary"></i>
        Manajemen Pengumuman
    </h1>

    {{-- Alert Pesan --}}
    @if(session('success'))
        <div class="alert alert-success border-left-success shadow alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        {{-- Breadcrumb Navigation --}}
        <nav aria-label="breadcrumb" class="bg-primary p-2 rounded-top">
            <ol class="breadcrumb mb-0 bg-transparent">
                <li class="breadcrumb-item"><a href="#" class="text-white font-weight-bold">Dashboard</a></li>
                <li class="breadcrumb-item active text-white-50" aria-current="page">Pengumuman</li>
            </ol>
        </nav>
        
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-primary mb-3"><i class="fa fa-filter mr-1"></i> Filter Pengumuman</h6>
            
            <form action="{{ url()->current() }}" method="GET" autocomplete="off">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label class="form-label small font-weight-bold">Cari Judul / Isi</label>
                        <input name="cari" type="text" class="form-control form-control-sm" placeholder="Ketik kata kunci..." value="{{ request('cari') }}">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label class="form-label small font-weight-bold">Target Audience</label>
                        <select class="form-control form-control-sm" name="target">
                            <option value="">Semua Target</option>
                            <option value="Semua" {{ request('target') == 'Semua' ? 'selected' : '' }}>Semua Mahasiswa</option>
                            <option value="TI" {{ request('target') == 'TI' ? 'selected' : '' }}>Teknik Informatika</option>
                            <option value="SI" {{ request('target') == 'SI' ? 'selected' : '' }}>Sistem Informasi</option>
                        </select>
                    </div>
                </div>
                
                <div class="d-flex justify-content-start mt-2">
                    <button type="submit" class="btn btn-info btn-sm mr-2 shadow-sm px-3">
                        <i class="fa fa-search mr-1"></i> Cari Data
                    </button>
                    <a href="{{ url()->current() }}" class="btn btn-secondary btn-sm shadow-sm px-3">
                        <i class="fa fa-undo mr-1"></i> Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="mb-0 small text-muted">Menampilkan daftar informasi terbaru untuk Civitas Akademika.</p>
                <a href="{{ route('pengumuman-tambah') }}" class="btn btn-sm btn-primary shadow-sm px-3">
                    <i class="fa fa-plus-circle mr-2"></i>Buat Pengumuman
                </a>
            </div>
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-gray-100">
                        <tr class="text-center small font-weight-bold text-dark text-uppercase">
                            <th width="50">No</th>
                            <th>Judul Pengumuman</th>
                            <th width="150">Target</th>
                            <th width="150">Lampiran</th>
                            <th width="150">Tanggal Publish</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>       
                    <tbody>
                        {{-- Gunakan @forelse untuk handle data kosong --}}
                        @forelse($pengumumans as $index => $item)
                            <tr class="small text-dark">
                                <td class="text-center align-middle">{{ $index + 1 }}</td>
                                <td class="align-middle"> 
                                    <div class="font-weight-bold text-primary mb-0" style="font-size: 0.9rem;">
                                        @if($item->is_urgent) 
                                            <i class="fas fa-exclamation-circle text-danger mr-1 animate-pulse" title="Penting!"></i> 
                                        @endif
                                        {{ $item->judul }}
                                    </div>
                                    <small class="text-muted">Oleh: {{ $item->user->nama ?? 'Admin' }}</small>
                                </td>
                                <td class="text-center align-middle">
                                    <span class="badge badge-pill {{ $item->target == 'Semua' ? 'badge-primary' : 'badge-info' }} px-3">
                                        <i class="fas fa-bullseye mr-1 small"></i>{{ $item->target }}
                                    </span>
                                </td>
                                <td class="text-center align-middle">
                                    @if($item->file)
                                        <a href="{{ asset('storage/pengumuman/' . $item->file) }}" target="_blank" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-file-pdf mr-1"></i> PDF
                                        </a>
                                    @else
                                        <span class="text-muted italic small">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    <span class="text-dark">{{ date('d/m/Y', strtotime($item->created_at)) }}</span><br>
                                    <small class="text-muted">{{ date('H:i', strtotime($item->created_at)) }} WIB</small>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center">
                                        {{-- Edit --}}
                                        <a href="#" class="btn btn-success btn-sm shadow-sm d-flex align-items-center justify-content-center mr-1" 
                                           style="width: 30px; height: 30px;" title="Edit">
                                            <i class="fas fa-edit fa-sm"></i>
                                        </a>
                                        
                                        {{-- Hapus --}}
                                        <button class="btn btn-danger btn-sm shadow-sm d-flex align-items-center justify-content-center" 
                                                style="width: 30px; height: 30px;" title="Hapus"
                                                onclick="confirmDelete('{{ $item->id }}')">
                                            <i class="fas fa-trash fa-sm"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <img src="https://illustrations.popsy.co/gray/no-messages.svg" style="width: 150px;" class="mb-3">
                                    <p class="text-muted">Belum ada pengumuman yang dibuat.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>         
            </div>

            {{-- Tambahkan Pagination jika data banyak --}}
            <div class="mt-3">
                {{ $pengumumans->links() }}
            </div>
        </div>
    </div>  
@endsection