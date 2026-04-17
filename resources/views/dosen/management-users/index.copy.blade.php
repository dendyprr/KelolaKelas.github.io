@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"> 
        <i class="fas fa-user-cog mr-2 text-primary"></i>
        {{ $title }}
    </h1>
    
    <div class="card shadow mb-4">
        <nav aria-label="breadcrumb" class="bg-primary p-2 rounded">
            <ol class="breadcrumb mb-0 bg-transparent">
                <li class="breadcrumb-item {{$activeGuru ?? ''}}">
                    <a href="" class="text-white">{{$title}}</a>
                </li>
                <li class="breadcrumb-item text-dark" aria-current="page">
                    <a href="" class="breadcrumb-item text-dark"> Tambah Data Guru </a>
                </li>
            </ol>
        </nav>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary mb-3">Filter Data Guru</h6>
             <form action="" method="get">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="filter-nama" class="form-label">Nama</label>
                        <input name="nama" type="text" class="form-control" id="filter-nama" placeholder="Cari Nama" value="{{ request('nama') }}">
                    </div>
 
                    <div class="col-md-3 mb-3">
                        <label for="filter-phone" class="form-label">Phone</label>
                        <input name="phone" type="phone" class="form-control" id="filter-phone" placeholder="Cari Phone" value="{{ request('phone') }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="filter-payment-status" class="form-label">Email</label>
                        <input name="email" type="email" class="form-control" id="filter-email" placeholder="Cari Email" value="{{ request('email') }}">
                    </div>

                    {{-- <div class="col-md-3 mb-3">
                        <label for="filter-status" class="form-label">Status Guru</label>
                        <select class="form-control" id="filter-status" name="status_guru">
                            <option value="">Semua Status</option>
                            <option value="yes" {{ request('status_guru') == 'yes' ? 'selected' : '' }}>Aktif</option>
                            <option value="no" {{ request('status_guru') == 'no' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div> --}}

                </div>

                <div class="d-flex justify-content-start">
                    <button type="submit" class="btn btn-info btn-sm mr-2">
                        <i class="fa fa-filter mr-1"></i> Filter
                    </button>
                    <a href="" class="btn btn-secondary btn-sm">
                        <i class="fa fa-undo mr-1"></i> Reset
                    </a>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <a href="#" class="btn btn-sm btn-success mr-2">
                    <i class="fa fa-file-excel mr-2"></i>
                    Export Excel
                </a>
                <a href="#" class="btn btn-sm btn-danger mr-2">
                    <i class="fa fa-file-pdf mr-2"></i>
                    Export PDF
                </a>
                
                <a href="" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus mr-2"></i>
                    Pendaftaran Guru
                </a>
            </div>
             <div class="table-responsive">
                     <table class="table table-bordered text-nowrap" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Umur</th>
                                <th>Pendidikan</th>
                                <th>Mengajar</th>
                                <th>Status Mengajar</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Tanggal Bergabung Sebagai Guru</th>
                                <th>
                                    Action
                                    <i class="fas fa-cog"></i>
                                </th>
                            </tr>
                        </thead>          
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td class="text-center"> {{ $loop->iteration }}</td>
                                    <td> 
                                        <a style="text-decoration: none;" href="">
                                            {{$item->nama}} 
                                        </a>
                                    </td>
                                    <td> {{$item->username}} </td>
                                    <td> {{$item->umur}} </td>
                                    <td> {{$item->email}} </td>
                                    <td> {{$item->phone}} </td>
                                    <td> {{$item->jenis_kelamin}}</td>
                                    <td> {{$item->alamat}}</td>
                                    <td>{{ $item->created_at ? $item->created_at->format('d F Y') : '-' }}</td>
                                    <td class="text-center">
                                        <a href="" class="btn btn-success btn-sm mb-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm mb-1" data-toggle="modal" data-target="#konfirmasiHapusModal" data-id="{{ $item->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
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
                <form action="#" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group small font-weight-bold">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group small font-weight-bold">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group small font-weight-bold">
                                    <label>Role</label>
                                    <select name="role_id" class="form-control" required>
                                        <option value="1">Admin</option>
                                        <option value="2">Dosen</option>
                                        <option value="3">Mahasiswa</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group small font-weight-bold">
                                    <label>NIDN (Khusus Dosen)</label>
                                    <input type="text" name="NIDN" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group small font-weight-bold">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm shadow-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>  
@endsection


