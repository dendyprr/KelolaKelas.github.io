@extends('layouts.app')

@section('content')
     <i class="fas fa-fw fa-tachometer-alt text-primary"></i>
        {{ $title }}
    </h1>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4 border-0 shadow-sm overflow-hidden">
                    <div class="bg-primary" style="height: 70px;"></div>
                    
                    <div class="card-body text-center" style="margin-top: -50px;">
                        <div class="position-relative">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($data->nama) }}&background=0D6EFD&color=fff" 
                                alt="avatar" 
                                class="rounded-circle img-fluid border border-4 border-white shadow-sm" 
                                style="width: 120px; height: 120px; object-fit: cover;">
                        </div>
                        
                        <h5 class="mt-3 mb-1 fw-bold">{{ $data->nama }}</h5>
                        
                        <div class="mb-3">
                            <span class=" text-white badge rounded-pill {{ $data->role_id == 1 ? 'bg-danger' : ($data->role_id == 3 ? 'bg-primary' : 'bg-secondary') }} px-3">
                                {{ $data->role->nama ?? 'N/A' }}
                            </span>
                        </div>
                        
                        <div class="text-muted small mb-4">
                            <div class="mb-1">
                                <i class="fas fa-envelope me-1"></i> {{ $data->email }}
                            </div>
                            <div>
                                <i class="fas fa-map-marker-alt me-1"></i> {{ $data->alamat ?? 'Lokasi belum diatur' }}
                            </div>
                        </div>

                        <div class="row g-0 border-top border-bottom py-3 mb-4 bg-light">
                            <div class="col-6 border-end">
                                <p class="text-muted small mb-0">Status</p>
                                <span class="fw-bold text-success">Aktif</span>
                            </div>
                            <div class="col-6">
                                <p class="text-muted small mb-0">Periode</p>
                                <span class="fw-bold text-dark">2025/2026</span>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-center">
                            <a href="" class="btn btn-primary btn-sm px-4 mr-2">
                                <i class="fas fa-edit me-1"></i> Edit Profil
                            </a>
                            <button type="button" class="btn btn-outline-secondary btn-sm px-4">
                                <i class="fas fa-cog me-1"></i> Akun
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card mb-4 mb-lg-0 border-0 shadow-sm">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush rounded-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fas fa-globe fa-lg text-warning"></i>
                                <p class="mb-0">https://websiteanda.com</p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fab fa-github fa-lg text-dark"></i>
                                <p class="mb-0">username_github</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Nama Lengkap</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $data->nama }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $data->email }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Telepon</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $data->phone }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Alamat</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $data->alamat }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Role</p>
                            </div>
                            <div class="col-sm-9">
                                <span class="text-white badge {{ $data->role_id == 1 ? 'bg-danger' : ($data->role_id == 3 ? 'bg-primary' : 'bg-secondary') }} ">
                                    {{ $data->role->nama ?? 'N/A' }}
                                </span>
                            </div>
                        </div>
                        <hr>

                        @if($data->role_id == 1)
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">NIDN</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ $data->NIDN ?? '-' }}</p>
                                </div>
                            </div>
                            <hr>
                        @endif

                        @if($data->role_id == 3)
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">NIM</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        {{ $data->mahasiswa->nim ?? '-' }}
                                    </p>
                                </div>
                            </div>
                            <hr>
                        @endif
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Jenis Kelamin</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">Laki Laki</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4 mb-md-0 border-0 shadow-sm">
                            <div class="card-body">
                                <p class="mb-4"><span class="text-primary font-italic me-1">Status</span> Project Terkini</p>
                                <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                <div class="progress rounded" style="height: 5px;">
                                    <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                <div class="progress rounded" style="height: 5px;">
                                    <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection