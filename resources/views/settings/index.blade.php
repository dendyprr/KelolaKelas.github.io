@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-shield-alt fa-sm fa-fw mr-2 text-primary"></i>
        {{ $title }} 
    </h1>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4 border-0">
                <div class="card-body p-lg-5">
                    <div class="row">
                        <div class="col-xl-4 text-center border-right-xl mb-4 mb-xl-0 d-block">
                            <div class="icon-circle bg-primary text-white my-4 shadow" style="width: 80px; height: 80px; display: inline-flex; align-items: center; justify-content: center; font-size: 35px;">
                                <i class="fas fa-lock"></i>
                            </div>
                            <h4 class="font-weight-bold text-gray-900">Ganti Password</h4>
                            <p class="text-muted px-3 small">Amankan akun kamu dengan memperbarui password secara berkala.</p>
                            
                            <div class="alert alert-light border-0 small text-left mt-4 mx-3 shadow-sm">
                                <h6 class="font-weight-bold text-gray-800"><i class="fas fa-info-circle mr-2 text-info"></i>Tips Keamanan:</h6>
                                <ul class="pl-3 mb-0 text-muted">
                                    <li>Minimal 8 karakter.</li>
                                    <li>Gunakan kombinasi huruf besar, kecil, dan angka.</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xl-8 col-lg-12">
                            <form action="#" method="POST" class="px-lg-4">
                                @csrf
                                @method('PUT')

                                <div class="form-group mb-4">
                                    <label class="small font-weight-bold text-primary text-uppercase">Password Saat Ini</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light border-right-0"><i class="fas fa-key text-muted"></i></span>
                                        </div>
                                        <input type="password" name="current_password" id="current_password"
                                               class="form-control border-left-0 border-right-0 @error('current_password') is-invalid @enderror" 
                                               placeholder="Masukkan password lama" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-light border-left-0 text-muted toggle-password" type="button" data-target="current_password">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="small font-weight-bold text-primary text-uppercase">Password Baru</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light border-right-0"><i class="fas fa-lock-open text-muted"></i></span>
                                                </div>
                                                <input type="password" name="new_password" id="new_password"
                                                       class="form-control border-left-0 border-right-0 @error('new_password') is-invalid @enderror" 
                                                       placeholder="Minimal 8 karakter" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-light border-left-0 text-muted toggle-password" type="button" data-target="new_password">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="small font-weight-bold text-primary text-uppercase">Konfirmasi Password Baru</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light border-right-0"><i class="fas fa-check-double text-muted"></i></span>
                                                </div>
                                                <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                                       class="form-control border-left-0 border-right-0" 
                                                       placeholder="Ulangi password baru" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-light border-left-0 text-muted toggle-password" type="button" data-target="new_password_confirmation">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 pt-3">
                                    <button type="submit" class="btn btn-primary btn-block shadow-sm py-2">
                                        <i class="fas fa-save mr-2"></i> Simpan Perubahan Password
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

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButtons = document.querySelectorAll('.toggle-password');
        
        toggleButtons.forEach(button => {
            // Set icon awal ke eye-slash saat halaman dimuat (titik-titik)
            const icon = button.querySelector('i');
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');

            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const currentIcon = this.querySelector('i');

                if (input.type === 'password') {
                    // Password jadi kelihatan -> Icon jadi Mata Biasa
                    input.type = 'text';
                    currentIcon.classList.remove('fa-eye-slash');
                    currentIcon.classList.add('fa-eye');
                } else {
                    // Password jadi titik-titik -> Icon jadi Mata Coret
                    input.type = 'password';
                    currentIcon.classList.remove('fa-eye');
                    currentIcon.classList.add('fa-eye-slash');
                }
            });
        });
    });
</script>

<style>
    @media (min-width: 1200px) {
        .border-right-xl { border-right: 1px solid #e3e6f0; }
    }
    .input-group-text, .btn-outline-light {
        background-color: #f8f9fc !important;
        border-color: #d1d3e2 !important;
    }
    .btn-outline-light:hover {
        background-color: #eaecf4 !important;
    }
</style>