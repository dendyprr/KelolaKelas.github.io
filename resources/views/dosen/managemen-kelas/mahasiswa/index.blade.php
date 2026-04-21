@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"> 
        <i class="fas fa-users mr-2 text-primary"></i>
        {{ $title }}
    </h1>

    {{-- Pesan Sukses Setelah Hapus --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="bg-primary p-2 rounded-top">
            <ol class="breadcrumb mb-0 bg-transparent">
                <li class="breadcrumb-item"><a href="#" class="text-white">Data Mahasiswa</a></li>
                <li class="breadcrumb-item active text-white-50" aria-current="page">{{ $data->nama_matakuliah }}</li>
            </ol>
        </nav>
        
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary mb-3">Filter Data Mahasiswa</h6>
            
            {{-- FORM FILTER GAYA MAS DENDY --}}
            <form action="{{ url()->current() }}" method="GET" class="mb-3" autocomplete="off">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="filter-cari" class="form-label small font-weight-bold">Nama / NIM / Email</label>
                        <input name="cari" type="text" class="form-control" id="filter-cari" placeholder="Cari Mahasiswa..." value="{{ request('cari') }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="filter-angkatan" class="form-label small font-weight-bold">Angkatan</label>
                        <select class="form-control" id="filter-angkatan" name="angkatan">
                            <option value="">Semua Angkatan</option>
                            @for ($i = date('Y'); $i >= 2020; $i--)
                                <option value="{{ $i }}" {{ request('angkatan') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="filter-jk" class="form-label small font-weight-bold">Jenis Kelamin</label>
                        <select class="form-control" id="filter-jk" name="jenis_kelamin">
                            <option value="">Semua</option>
                            <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>
                
                <div class="d-flex justify-content-start">
                    <a href="{{route('detail-manajement-kelas', $data->id)}}" type="submit" class="btn btn-secondary btn-sm mr-2  shadow-sm" >
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-info btn-sm mr-2 shadow-sm">
                        <i class="fa fa-filter mr-1"></i> Filter Data
                    </button>
                    <a href="{{ url()->current() }}" class="btn btn-secondary btn-sm shadow-sm mr-2">
                        <i class="fa fa-undo mr-1"></i> Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="card-body">
            <div class="d-flex justify-content-end mb-4">
                <a href="" class="btn btn-sm btn-success mr-2 shadow-sm">
                    <i class="fa fa-file-excel mr-2"></i>
                    Export Excel
                </a>
                <a href="" class="btn btn-sm btn-danger mr-2 shadow-sm">
                    <i class="fa fa-file-pdf mr-2"></i>
                    Export PDF
                </a>
                <button class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modalTambah">
                    <i class="fa fa-plus mr-2"></i>
                    Tambah Mahasiswa
                </button>
            </div>
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-gray-100">
                        <tr class="text-center small font-weight-bold">
                            <th width="50">No</th>
                            <th>Nama NIM</th>
                            <th>NIM</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Jenis Kelamin</th>
                            <th>Jurusan</th>
                            <th>Angkatan</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>       
                    <tbody>
                        @forelse($data->mahasiswas as $index => $mhs)
                            <tr class="small text-dark">
                                <td class="text-center align-middle">{{ $index + 1 }}</td>
                               
                                <td class="align-middle"> 
                                    <div class="font-weight-bold text-primary">{{ $mhs->user->nama ?? 'N/A' }}</div>
                                </td>
                                <td>{{ $mhs->nim }}</td>
                                <td>{{ $mhs->user->phone }}</td>
                                <td>{{ $mhs->user->email ?? '-' }}</td>
                                <td class="text-center align-middle">
                                    @if ($mhs->jenis_kelamin === 'L')
                                        <span class="badge badge-info px-2">Laki-laki</span>
                                    @else
                                        <span class="badge badge-danger px-2">Perempuan</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <div class="font-weight-bold">{{ $mhs->jurusan }}</div>
                                </td>
                                <td>{{ $mhs->angkatan }}</td>
                                <td class="text-center align-middle">
                                    {{-- Container Flex untuk menyatukan Button & Form --}}
                                    <div class="d-flex justify-content-center align-items-center">
                                        
                                        {{-- TOMBOL EDIT --}}
                                        <button class="btn btn-success btn-sm shadow-sm d-flex align-items-center justify-content-center" 
                                                data-toggle="modal" 
                                                data-target="#modalEdit{{ $mhs->id }}" 
                                                title="Edit Data"
                                                style="width: 32px; height: 32px; margin-right: 5px;">
                                            <i class="fas fa-edit fa-fw small"></i>
                                        </button>

                                        {{-- FORM HAPUS --}}
                                        <button type="button" 
                                                class="btn btn-danger btn-sm shadow-sm d-flex align-items-center justify-content-center" 
                                                data-toggle="modal" 
                                                data-target="#modalHapusAbsen{{ $mhs->id }}"
                                                title="Hapus"
                                                style="width: 32px; height: 32px;">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        {{-- Struktur Modal --}}
                                         <div class="modal fade" id="modalHapusAbsen{{ $mhs->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            {{-- Margin-top 40px supaya posisi di atas, tidak terlalu ke tengah --}}
                                            <div class="modal-dialog" role="document" style="margin-top: 40px;">
                                                <div class="modal-content border-0 shadow">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title">Konfirmasi Hapus User</h5>
                                                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-start">
                                                        Apakah Anda yakin ingin **{{  $mhs->user->nama }}**? 
                                                        <br>
                                                        <small class="text-muted">Data yang sudah dihapus mungkin tidak dapat dikembalikan.</small>
                                                    </div>
                                                    <div class="modal-footer bg-light">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            
                                                        {{-- Form Hapus --}}
                                                        <form action="{{ route('anggota-group-hapus-absen-mahasiswa', $mhs->id) }}" method="POST" class="m-0 p-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </td>
                            </tr>
                            @include('dosen.managemen-kelas.mahasiswa.modal-edit')
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Mahasiswa tidak ditemukan.</td>
                            </tr>
                        @endforelse          
                    </tbody>
                </table>         
            </div>
        </div>
    </div>  

@endsection

{{-- Modal Tetap Sama Seperti Kode Kamu --}}

<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel text-white">
                    <i class="fas fa-user-plus mr-2"></i> Tambah Mahasiswa ke Kelas
                </h5>
                <button class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modalTambah">
                    <i class="fa fa-plus mr-1"></i> Tambah Mahasiswa
                </button>
            </div>
            
            <form action="{{route('anggota-group-proccess', $data->id)}}" method="POST" autocomplete="off">
                @csrf
                <input type="hidden" name="kelas_id" value="{{ $data->id }}">
                <div class="modal-body">
                    <div class="alert alert-info small">
                        <i class="fas fa-info-circle mr-1"></i> 
                        Mahasiswa yang didaftarkan otomatis akan memiliki akun login dengan <strong>Password default = NIM</strong>.
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold small">NIM (Nomor Induk Mahasiswa)</label>
                                <input type="text" name="nim" class="form-control" placeholder="Contoh: 20240001" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold small">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap..." required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold small">Email Kampus/Pribadi</label>
                                <input type="email" name="email" class="form-control" placeholder="email@contoh.com" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold small">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold small">Program Studi / Jurusan</label>
                                <input type="text" name="jurusan" class="form-control" value="Teknik Informatika" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold small">Angkatan</label>
                                <input type="number" name="angkatan" class="form-control" value="{{ date('Y') }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm shadow-sm">
                        <i class="fas fa-save mr-1"></i> Simpan & Daftarkan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>