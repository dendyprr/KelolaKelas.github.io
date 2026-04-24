@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"> 
        <i class="fas fa-fw fa-book-open"></i>
        {{ $title }} 
    </h1>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body text-center py-5">
                    
                    <div class="animation-container">
                        <div class="gear-background"></div>
                        <i class="fas fa-tools main-icon"></i>
                        <div class="dot dot-1"></div>
                        <div class="dot dot-2"></div>
                        <div class="dot dot-3"></div>
                    </div>

                    <h1 class="display-4 font-weight-bold text-gray-800">Oops!</h1>
                    <h2 class="h4 text-primary mb-3">Website Sedang Dalam Perbaikan</h2>
                    <p class="text-muted mx-auto" style="max-width: 500px;">
                        Kami sedang melakukan pemeliharaan sistem rutin untuk meningkatkan layanan kami. 
                        Mohon maaf atas ketidaknyamanannya. Kami akan segera kembali online!
                    </p>
                    
                    <a href="javascript:location.reload();" class="btn btn-primary btn-icon-split mt-3">
                        <span class="icon text-white-50">
                            <i class="fas fa-sync-alt"></i>
                        </span>
                        <span class="text">Coba Segarkan Halaman</span>
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection