@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        @if(Route::is('profile-profile'))
            <i class="fas fa-user fa-sm fa-fw mr-2 text-primary"></i> 
        @endif
        {{ $title }} 
    </h1>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4 border-0">
                <div class="bg-primary" style="height: 100px; border-radius: 0.35rem 0.35rem 0 0;"></div>
                
                <div class="card-body text-center" style="margin-top: -60px;">
                    <div class="mb-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($data->nama) }}&background=0D6EFD&color=fff" 
                             alt="avatar" 
                             class="rounded-circle img-fluid border border-4 border-white shadow" 
                             style="width: 120px; height: 120px; object-fit: cover;">
                    </div>

                    <h3 class="font-weight-bold text-gray-800 mb-1">{{ $data->nama }}</h3>
                    <div class="mb-4">
                        <span class="badge badge-pill {{ $data->role_id == 1 ? 'badge-danger' : ($data->role_id == 3 ? 'badge-primary' : 'badge-secondary') }} px-4 py-2 shadow-sm">
                            {{ $data->role->nama ?? 'N/A' }}
                        </span>
                    </div>

                    <div class="container">
                        <div class="row text-left mt-5">
                            <div class="col-md-6 px-lg-5">
                                <div class="mb-4">
                                    <label class="small font-weight-bold text-primary">NAMA LENGKAP</label>
                                    <p class="text-gray-700 h6 font-weight-bold">{{ $data->nama }}</p>
                                    <hr>
                                </div>
                                <div class="mb-4">
                                    <label class="small font-weight-bold text-primary">EMAIL</label>
                                        <p class="text-gray-700 h6 font-weight-bold">{{ $data->email }}</p>
                                    <hr>
                                </div>
                                <div class="mb-4">
                                    <label class="small font-weight-bold text-primary">JENIS KELAMIN</label>
                                    <p class="text-gray-700 h6 font-weight-bold">
                                        {{ $data->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                    </p>
                                    <hr>
                                </div>
                                @if ($data->role_id == 3)
                                    <div class="mb-4">
                                        <label class="small font-weight-bold text-primary">Jurusan</label>
                                        <p class="text-gray-700 h6 font-weight-bold">
                                            <p class="text-gray-700 h6 font-weight-bold">{{ $data->mahasiswa->jurusan }}</p>
                                        </p>
                                        <hr>
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-6 px-lg-5">
                                @if($data->role_id == 1)
                                <div class="mb-4">
                                    <label class="small font-weight-bold text-primary">NIDN</label>
                                    <p class="text-gray-700 h6 font-weight-bold">{{ $data->NIDN ?? '-' }}</p>
                                    <hr>
                                </div>
                                @endif

                                @if($data->role_id == 3)
                                    <div class="mb-4">
                                        <label class="small font-weight-bold text-primary">NIM</label>
                                        <p class="text-gray-700 h6 font-weight-bold">{{ $data->mahasiswa->nim ?? '-' }}</p>
                                        <hr>
                                    </div>
                                @endif

                                <div class="mb-4">
                                    <label class="small font-weight-bold text-primary">TELEPON</label>
                                    <p class="text-gray-700 h6 font-weight-bold">{{ $data->phone ?? '-' }}</p>
                                    <hr>
                                </div>
                                <div class="mb-4">
                                    <label class="small font-weight-bold text-primary">ALAMAT</label>
                                    <p class="text-gray-700 h6 font-weight-bold">{{ $data->alamat ?? 'Belum diatur' }}</p>
                                    <hr>
                                </div>  
                                @if ($data->role_id == 3)
                                    <div class="mb-4">
                                        <label class="small font-weight-bold text-primary">Angkatan</label>
                                            <p class="text-gray-700 h6 font-weight-bold">{{ $data->mahasiswa->angkatan }}</p>
                                        <hr>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 mb-3">
                        <a href="{{route('profile-edit', $data->id)}}" class="btn btn-primary btn-icon-split shadow-sm">
                            <span class="icon text-white-50">
                                <i class="fas fa-user-edit"></i>
                            </span>
                            <span class="text">Edit Profil Lengkap</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection