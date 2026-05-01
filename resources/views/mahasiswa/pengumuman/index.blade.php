@extends('layouts.app')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-bullhorn mr-2 text-primary"></i>Pusat Informasi
        </h1>
        <div class="small text-muted font-weight-bold">
            <i class="far fa-calendar-alt"></i> {{ date('d M Y') }}
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            @forelse($pengumumans as $item)
                <div class="card shadow mb-4 border-left-{{ $item->is_urgent ? 'danger' : 'primary' }}">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-xs font-weight-bold text-uppercase mb-1 {{ $item->is_urgent ? 'text-danger' : 'text-primary' }}">
                                        {{ $item->is_urgent ? 'PENTING!' : 'Informasi' }}
                                    </span>
                                    <small class="text-muted">
                                        <i class="fas fa-clock mr-1"></i> {{ $item->created_at->diffForHumans() }}
                                    </small>
                                </div>
                                
                                <h5 class="font-weight-bold text-dark mb-2">{{ $item->judul }}</h5>
                                
                                {{-- Potong teks agar tidak terlalu panjang di index --}}
                                <p class="text-dark mb-3" style="line-height: 1.6;">
                                    {{ Str::limit($item->isi, 200) }}
                                </p>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        @if($item->file)
                                            <a href="{{ asset('storage/pengumuman/' . $item->file) }}" target="_blank" class="btn btn-sm btn-light border-danger text-danger font-weight-bold">
                                                <i class="fas fa-download mr-1"></i> Lampiran File
                                            </a>
                                        @endif
                                    </div>
                                    <a href="{{ route('pengumuman-mahasiswa-show', $item->id) }}" class="btn btn-primary btn-sm px-4 shadow-sm">
                                        Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card shadow py-5 text-center border-0">
                    <div class="card-body">
                        <i class="fas fa-bell-slash fa-3x text-gray-300 mb-3"></i>
                        <p class="text-muted">Belum ada pengumuman untuk kamu saat ini.</p>
                    </div>
                </div>
            @endforelse

            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {{ $pengumumans->links() }}
            </div>
        </div>
    </div>
@endsection