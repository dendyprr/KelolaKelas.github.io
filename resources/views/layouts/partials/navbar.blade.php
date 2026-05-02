     <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow sticky-top">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw text-gray-600"></i>
                                {{-- Angka badge tetap hanya menghitung yang BELUM dibaca --}}
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <span class="badge badge-danger badge-counter">
                                        {{ auth()->user()->unreadNotifications->count() }}
                                    </span>
                                @endif
                            </a>
                            
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header bg-primary border-0 d-flex justify-content-between align-items-center">
                                    Pusat Notifikasi
                                    @if(auth()->user()->unreadNotifications->count() > 0)
                                        <a href="{{ route('pengumuman-mahasiswa-mark-all-read') }}" class="text-white small" style="text-decoration: underline;">
                                            Baca Semua
                                        </a>
                                    @endif
                                </h6>
                                
                                {{-- Kita ambil 5 notifikasi TERBARU (baik sudah dibaca atau belum) --}}
                                @forelse(auth()->user()->notifications()->take(5)->get() as $notification)
                                    <a class="dropdown-item d-flex align-items-center {{ $notification->read_at == null ? 'bg-light' : '' }}" href="{{ route('pengumuman-mahasiswa-show', $notification->data['id']) }}">
                                        <div class="mr-3">
                                            {{-- Ganti warna icon kalau sudah dibaca biar ada bedanya --}}
                                            <div class="icon-circle {{ $notification->read_at == null ? 'bg-primary' : 'bg-secondary' }} text-white">
                                                <i class="fas fa-bullhorn"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small {{ $notification->read_at == null ? 'text-primary font-weight-bold' : 'text-gray-500' }}">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </div>
                                            <span class="{{ $notification->read_at == null ? 'font-weight-bold text-dark' : 'text-gray-600' }}">
                                                {{ $notification->data['judul'] }}
                                            </span>
                                        </div>
                                    </a>
                                @empty
                                    <a class="dropdown-item text-center small text-gray-500" href="#">Tidak ada riwayat pengumuman</a>
                                @endforelse
                                
                                <a class="dropdown-item text-center small text-gray-500" href="{{route('pengumuman-mahasiswa-index')}}">Lihat Semua Pengumuman</a>
                            </div>
                        </li>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                
                                <span class="mr-3 d-none d-lg-inline text-right">
                                    {{-- Nama User --}}
                                    <div class="text-gray-600 small font-weight-bold mb-0">{{ Auth::user()->nama }}</div>
                                    
                                    {{-- Label/Badge Role --}}
                                    @if(Auth::user()->role_id == 1)
                                        <span class="badge badge-danger" style="font-size: 0.6rem;">Admin</span>
                                    @elseif(Auth::user()->role_id == 2)
                                        <span class="badge badge-success" style="font-size: 0.6rem;">Dosen</span>
                                    @else
                                        <span class="badge badge-primary" style="font-size: 0.6rem;">Mahasiswa</span>
                                    @endif
                                </span>

                                <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{route('profile-profile')}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="{{route('pengaturan-settings')}}">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('auth-logout')}}" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>