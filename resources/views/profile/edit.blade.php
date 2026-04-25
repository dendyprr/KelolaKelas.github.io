@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-user-edit fa-sm fa-fw mr-2 text-primary"></i>
        Lengkapi Profil
    </h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4 border-0">
                <div class="card-body p-lg-5">
                    <div class="row">
                        <div class="col-xl-3 text-center border-right-xl mb-4 mb-xl-0">
                            <div class="icon-circle bg-primary text-white my-4 shadow" style="width: 70px; height: 70px; display: inline-flex; align-items: center; justify-content: center; font-size: 30px;">
                                <i class="fas fa-address-card"></i>
                            </div>
                            <h5 class="font-weight-bold text-gray-900">Biodata Diri</h5>
                            <p class="text-muted small px-2">Pastikan seluruh data diri Anda sudah sesuai dengan dokumen identitas resmi untuk keperluan administrasi.</p>
                            <p class="text-muted small px-2">Kolom dengan tanda <span class="text-danger font-weight-bold">*</span> wajib diisi.</p>
                        </div>

                        <div class="col-xl-9 col-lg-12">
                            <form action="{{route('profile-edit-proccess', Auth::user()->id)}}" method="POST" class="px-lg-4" autocomplete="off">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="role_id" value="{{ Auth::user()->role_id }}">

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mb-4">
                                            <label><span class="text-danger">*</span></label>
                                            <label class="small font-weight-bold text-primary text-uppercase">Nama Lengkap</label>
                                            <input type="text" name="nama" class="form-control" value="{{ old('nama', Auth::user()->nama) }}"  autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="small font-weight-bold text-primary text-uppercase">Email</label>
                                            <input type="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}"  autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="small font-weight-bold text-primary text-uppercase">Nomor Telepon</label>
                                            <input type="text" name="phone" class="form-control" placeholder="08xxxx" value="{{ old('phone', Auth::user()->phone) }}"  autocomplete="off">
                                        </div>
                                    </div>
                                    @if (Auth::user()->role_id == 3)
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label><span class="text-danger">*</span></label>
                                            <label class="small font-weight-bold text-primary text-uppercase">Jurusan</label>
                                            <input type="jurusan" name="jurusan" class="form-control" value="{{ old('jurusan', Auth::user()->mahasiswa->jurusan) }}"  autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label><span class="text-danger">*</span></label>
                                            <label class="small font-weight-bold text-primary text-uppercase">Angkatan</label>
                                            <input type="text" name="angkatan" class="form-control" value="{{ old('angkatan', Auth::user()->mahasiswa->angkatan) }}"  autocomplete="off">
                                        </div>
                                    </div>
                                    @endif

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label><span class="text-danger">*</span></label>
                                            <label class="small font-weight-bold text-primary text-uppercase">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" class="form-control">
                                                <option value="L" {{ old('jenis_kelamin', Auth::user()->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="P" {{ old('jenis_kelamin', Auth::user()->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                        
                                    @if (Auth::user()->role_id == 1)
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label><span class="text-danger">*</span></label>
                                                <label class="small font-weight-bold text-primary text-uppercase">NIDN</label>
                                                <input type="text" name="NIDN" class="form-control" value="{{ old('NIDN', Auth::user()->NIDN) }}"  autocomplete="off">
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label><span class="text-danger">*</span></label>
                                                <label class="small font-weight-bold text-primary text-uppercase">NIM</label>
                                                <input type="text" name="nim" class="form-control" value="{{ old('nim', Auth::user()->mahasiswa->nim) }}"  autocomplete="off">
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <div class="col-12">
                                        <div class="form-group mb-4">
                                            <label class="small font-weight-bold text-primary text-uppercase">Alamat Lengkap</label>
                                            <textarea name="alamat" class="form-control"  autocomplete="off" rows="3">{{ old('alamat', Auth::user()->alamat) }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="  btn btn-secondary px-5 shadow-sm ">
                                        <a href="{{route('profile-profile')}}" class="text-white">Kembali</a>
                                    </button>
                                    <button type="submit" class="btn btn-success px-5 shadow-sm">
                                        <i class="fas fa-save mr-2"></i> Edit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    /* CSS agar terlihat profesional */
    @media (min-width: 1200px) {
        .border-right-xl { border-right: 1px solid #e3e6f0; }
    }
    .form-control {
        border-radius: 10px;
        padding: 1.2rem 0.75rem;
        border: 1px solid #d1d3e2;
    }
    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.1);
    }
</style>