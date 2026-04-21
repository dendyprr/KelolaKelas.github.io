@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"> 
        <i class="fas fa-user-cog mr-2 text-primary"></i>
        {{ $title }}
    </h1>

    <div class="card shadow mb-4">
        <nav aria-label="breadcrumb" class="bg-primary p-2 rounded-top">
            <ol class="breadcrumb mb-0 bg-transparent">
                <li class="breadcrumb-item"><a href="#" class="text-white">Data Mahasiswa</a></li>
                <li class="breadcrumb-item active text-white-50" aria-current="page"></li>
            </ol>
        </nav>
        <div class="card-header py-3">
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
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIDN</th>
                            <th>NIM</th>
                            <th>Angkatan</th>
                            <th>Jurusan</th>
                            <th>Email</th>
                            <th>Jenis Kelamin</th>
                            <th>Role</th>
                            <th>Phone</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="fw-bold">{{ $item->nama }}</div>
                                </td>
                                <td>{{ $item->NIDN ?? '-' }}</td>
                                <td>{{ $item->mahasiswa->nim ?? '-' }}</td>
                                <td>{{ $item->mahasiswa->angkatan ?? '-' }}</td>
                                <td>{{ $item->mahasiswa->jurusan ?? '-' }}</td>
                                <td>{{ $item->email ?? '-' }}</td>

                                <td class="text-center">
                                    @if($item->role_id == 1)
                                        <span class="badge badge-dark">Admin</span>
                                    @elseif($item->role_id == 2)
                                        <span class="badge badge-info text-white">Dosen</span>
                                    @elseif($item->role_id == 3)
                                        <span class="badge badge-primary text-white">Mahasiswa</span>
                                    @else
                                        <span class="badge badge-secondary">User</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if($item->jenis_kelamin == 'L')
                                        <span class="badge bg-primary text-white">
                                            <i class="fas fa-mars"></i> Laki-laki
                                        </span>
                                    @elseif($item->jenis_kelamin == 'P')
                                        <span class="badge bg-success text-white">
                                            <i class="fas fa-venus"></i> Perempuan
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">-</span>
                                    @endif
                                </td>

                                <td>{{ $item->phone ?? '-' }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-sm btn-success shadow-sm mr-2" 
                                                data-toggle="modal" 
                                                data-target="#modalEdit{{ $item->id }}" 
                                                style="width: 32px; height: 32px; margin-right: 5px;">
                                            <i class="fas fa-edit fa-fw small"></i>
                                        </button>
                                        
                                        @include('dosen.management-users.edit-form')
                                        
                                        {{-- Tombol Pemicu Modal --}}
                                        <button type="button" 
                                                class="btn btn-sm btn-danger shadow-sm d-flex align-items-center justify-content-center" 
                                                data-toggle="modal" 
                                                data-target="#modalHapusUser{{ $item->id }}" 
                                                style="width: 32px; height: 32px;" 
                                                title="Hapus User">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        {{-- Struktur Modal --}}
                                        <div class="modal fade" id="modalHapusUser{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                        Apakah Anda yakin ingin menghapus user **{{ $item->name }}**? 
                                                        <br>
                                                        <small class="text-muted">Data yang sudah dihapus mungkin tidak dapat dikembalikan.</small>
                                                    </div>
                                                    <div class="modal-footer bg-light">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        
                                                        {{-- Form Hapus --}}
                                                        <form action="{{ route('manajement-user-hapus-user', $item->id) }}" method="POST" class="m-0 p-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Ya, Hapus User</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

     {{-- MODAL TAMBAH USER --}}
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content border-0">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold"><i class="fas fa-user-plus mr-2"></i> Tambah User Baru</h5>
                    <button class="close text-white" type="button" data-dismiss="modal"><span>×</span></button>
                </div>
                <form action="{{route('manajement-user-proccess')}}" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-body text-dark">
                        <div class="alert alert-info small">
                            <div>
                                <span class="text-dark font-weight"><i class="fas fa-info-circle mr-1"> Panduan Pengisian:</i> </span><br>
                                Pastikan seluruh data profil sudah sesuai. Kolom dengan tanda <span class="text-danger font-weight-bold">*</span> wajib diisi.
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group small font-weight-bold">
                                    <label><span class="text-danger">*</span> Nama Lengkap</label>
                                    <div class="input-group shadow-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" name="nama" value="{{ old('nama') }}" class="form-control form-control-sm @error('nama') is-invalid @enderror" placeholder="Masukkan Nama" required>
                                    </div>
                                    @error('nama')
                                        <small class="text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group small font-weight-bold">
                                    <label>NIM (Khusus Mahasiswa)</label>
                                    <div class="input-group shadow-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white"><i class="fas fa-id-card"></i></span>
                                        </div>
                                        <input type="text" name="nim" value="{{ old('nim') }}" class="form-control form-control-sm" placeholder="Contoh: 2021001">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group small font-weight-bold">
                                    <label>NIDN (Khusus Dosen)</label>
                                    <div class="input-group shadow-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white"><i class="fas fa-id-badge"></i></span>
                                        </div>
                                        <input type="text" name="NIDN" value="{{ old('NIDN') }}" class="form-control form-control-sm" placeholder="Contoh: 04123456">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group small font-weight-bold">
                                    <label><span class="text-danger">*</span> Email</label>
                                    <div class="input-group shadow-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" name="email" value="{{ old('email') }}" class="form-control form-control-sm @error('email') is-invalid @enderror" placeholder="nama@email.com" required>
                                    </div>
                                    @error('email')
                                        <small class="text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group small font-weight-bold">
                                    <label><span class="text-danger">*</span> Phone</label>
                                    <div class="input-group shadow-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control form-control-sm @error('phone') is-invalid @enderror" placeholder="08xxxxxx" required>
                                    </div>
                                    @error('phone')
                                        <small class="text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group small font-weight-bold">
                                    <label><span class="text-danger">*</span> Jenis Kelamin</label>
                                    <div class="input-group shadow-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white"><i class="fas fa-venus-mars"></i></span>
                                        </div>
                                        <select name="jenis_kelamin" class="form-control form-control-sm @error('jenis_kelamin') is-invalid @enderror" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                    @error('jenis_kelamin')
                                        <small class="text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group small font-weight-bold">
                                    <label><span class="text-danger">*</span> Role</label>
                                    <div class="input-group shadow-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white"><i class="fas fa-user-tag"></i></span>
                                        </div>
                                        <select name="role_id" class="form-control form-control-sm @error('role_id') is-invalid @enderror" required>
                                            <option value="" disabled selected>-- Pilih Role --</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Dosen</option>
                                            <option value="3">Mahasiswa</option>
                                        </select>
                                    </div>
                                    @error('role_id')
                                        <small class="text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group small font-weight-bold">
                                    <label><span class="text-danger">*</span> Password</label>
                                    <div class="input-group shadow-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-primary text-white"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" name="password" class="form-control form-control-sm @error('password') is-invalid @enderror" placeholder="******" required>
                                    </div>
                                    <small class="text-muted text-italic">
                                        <span class="text-danger"> *Password Minimal Harus 5 Karakter</span>
                                    </small>
                                    @error('password')
                                        <small class="text-danger font-weight-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-0">
                        <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm shadow-sm">
                            <i class="fas fa-save mr-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>  
@endsection