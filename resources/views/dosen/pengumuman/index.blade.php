@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"> 
        <i class="fas fa-bullhorn mr-2 text-primary"></i>
        {{ $title }} 
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
                <li class="breadcrumb-item"><a href="#" class="text-white font-weight-bold">{{ $title }} </a></li>
                <li class="breadcrumb-item active text-white-50" aria-current="page">
                    <a href="{{route('pengumuman-tambah')}}" class="text-white"> Tambah Pengumuman</a>
                </li>
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
                            <th width="150">Publish</th>
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
                                    {{-- <small class="text-muted">Oleh: {{ $item->user->nama ?? 'Admin' }}</small> --}}
                                </td>
                                <td class="text-center align-middle">
                                    @if($item->target == 1)
                                        <span class="badge badge-pill badge-danger px-3">
                                            <i class="fas fa-user-shield mr-1 small"></i> Admin
                                        </span>
                                    @elseif($item->target == 2)
                                        <span class="badge badge-pill badge-success px-3">
                                            <i class="fas fa-user-tie mr-1 small"></i> Dosen
                                        </span>
                                    @elseif($item->target == 3)
                                        <span class="badge badge-pill badge-info px-3">
                                            <i class="fas fa-user-graduate mr-1 small"></i> Mahasiswa
                                        </span>
                                    @else
                                        <span class="badge badge-pill badge-primary px-3">
                                            <i class="fas fa-users mr-1 small"></i> Semua
                                        </span>
                                    @endif
                                </td>
                               
                               <td class="text-center align-middle">
                                    @if($item->file)
                                        @php
                                            $ekstensi = strtolower(pathinfo($item->file, PATHINFO_EXTENSION));
                                        @endphp

                                        @if(in_array($ekstensi, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                            {{-- IMAGE --}}
                                            <a href="{{ asset('storage/pengumuman/' . $item->file) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                                <i class="fas fa-image"></i> IMAGE
                                            </a>
                                        @elseif($ekstensi == 'pdf')
                                            {{-- PDF --}}
                                            <a href="{{ asset('storage/pengumuman/' . $item->file) }}" target="_blank" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-file-pdf"></i> PDF
                                            </a>
                                        @elseif(in_array($ekstensi, ['doc', 'docx']))
                                            {{-- WORD --}}
                                            <a href="{{ asset('storage/pengumuman/' . $item->file) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-file-word"></i> WORD
                                            </a>
                                        @elseif(in_array($ekstensi, ['xls', 'xlsx', 'csv']))
                                            {{-- EXCEL --}}
                                            <a href="{{ asset('storage/pengumuman/' . $item->file) }}" target="_blank" class="btn btn-sm btn-outline-success">
                                                <i class="fas fa-file-excel"></i> EXCEL
                                            </a>
                                        @elseif(in_array($ekstensi, ['ppt', 'pptx']))
                                            {{-- PPT --}}
                                            <a href="{{ asset('storage/pengumuman/' . $item->file) }}" target="_blank" class="btn btn-sm btn-outline-warning">
                                                <i class="fas fa-file-powerpoint"></i> PPT
                                            </a>
                                        @else
                                            {{-- FILE LAINNYA --}}
                                            <a href="{{ asset('storage/pengumuman/' . $item->file) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                                <i class="fas fa-file-alt"></i> FILE
                                            </a>
                                        @endif
                                    @else
                                        <span class="text-muted small"><i>Tidak ada</i></span>
                                    @endif
                                </td>
                                <td class="align-middle"> 
                                    <div class="font-weight-bold text-primary mb-0" style="font-size: 0.9rem;">
                                       {{ $item->user->nama ?? 'Admin' }}
                                    </div>
                                </td>
                                <td class="text-center align-middle">
                                    <span class="text-dark">{{ date('d/m/Y', strtotime($item->created_at)) }}</span><br>
                                    <small class="text-muted">{{ date('H:i', strtotime($item->created_at)) }} WIB</small>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('pengumuman.edit', $item->id) }}" 
                                        class="btn btn-success btn-sm shadow-sm d-flex align-items-center justify-content-center mr-1" 
                                        style="width: 30px; height: 30px;" title="Edit">
                                            <i class="fas fa-edit fa-sm"></i>
                                        </a>

                                        <button type="button" 
                                                class="btn btn-danger btn-sm shadow-sm d-flex align-items-center justify-content-center" 
                                                data-toggle="modal" 
                                                data-target="#modalHapus{{ $item->id }}"
                                                title="Hapus Pengumuman"
                                                style="width: 30px; height: 30px;">
                                            <i class="fas fa-trash fa-sm"></i>
                                        </button>
                                        {{-- Modal Konfirmasi Hapus --}}
                                        <div class="modal fade" id="modalHapus{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document" style="margin-top: 50px;">
                                                <div class="modal-content border-0 shadow">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title font-weight-bold">
                                                            <i class="fas fa-exclamation-triangle mr-2"></i>Konfirmasi Hapus
                                                        </h5>
                                                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-left text-dark">
                                                        Apakah Anda yakin ingin menghapus pengumuman: <br>
                                                        <strong class="text-danger">"{{ $item->judul }}"</strong>?
                                                        <br><br>
                                                        <small class="text-muted italic">
                                                            *Tindakan ini akan menghapus data di database dan file lampiran secara permanen.
                                                        </small>
                                                    </div>
                                                    <div class="modal-footer bg-light">
                                                        <button type="button" class="btn btn-secondary btn-sm px-3" data-dismiss="modal">Batal</button>
                                                        
                                                        {{-- Form Hapus Sebenarnya --}}
                                                        <form action="{{ route('pengumuman-hapus', $item->id) }}" method="POST" class="m-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm px-3 shadow-sm">
                                                                <i class="fas fa-trash mr-1"></i> Ya, Hapus Data
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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