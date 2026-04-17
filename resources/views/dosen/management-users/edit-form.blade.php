{{-- MODAL EDIT USER --}}
<div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title font-weight-bold" id="modalEditLabel{{ $item->id }}">
                    <i class="fas fa-edit mr-2"></i> Edit Data: {{ $item->nama }}
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <form action="{{ route('manajement-user-edit-user', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="modal-body text-dark">
                    <div class="row">
                        {{-- Nama Lengkap --}}
                        <div class="col-md-6 mb-3">
                            <div class="form-group small font-weight-bold">
                                <label><span class="text-danger">*</span> Nama Lengkap</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" name="nama" value="{{ old('nama', $item->nama) }}" class="form-control form-control-sm" required>
                                </div>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="col-md-6 mb-3">
                            <div class="form-group small font-weight-bold">
                                <label><span class="text-danger">*</span> Email</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email" name="email" value="{{ old('email', $item->email) }}" class="form-control form-control-sm" required>
                                </div>
                            </div>
                        </div>

                        {{-- NIM --}}
                        <div class="col-md-6 mb-3">
                            <div class="form-group small font-weight-bold">
                                <label>NIM (Khusus Mahasiswa)</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white"><i class="fas fa-id-card"></i></span>
                                    </div>
                                    <input type="text" name="nim" value="{{ $item->mahasiswa->nim ?? '' }}" class="form-control form-control-sm" placeholder="Contoh: 2021001">
                                </div>
                            </div>
                        </div>

                        {{-- NIDN --}}
                        <div class="col-md-6 mb-3">
                            <div class="form-group small font-weight-bold">
                                <label>NIDN (Khusus Dosen)</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white"><i class="fas fa-id-badge"></i></span>
                                    </div>
                                    <input type="text" name="NIDN" value="{{ $item->NIDN }}" class="form-control form-control-sm" placeholder="Contoh: 04123456">
                                </div>
                            </div>
                        </div>

                        {{-- Phone --}}
                        <div class="col-md-6 mb-3">
                            <div class="form-group small font-weight-bold">
                                <label>Phone</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" name="phone" value="{{ $item->phone }}" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div class="col-md-6 mb-3">
                            <div class="form-group small font-weight-bold">
                                <label>Jenis Kelamin</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white"><i class="fas fa-venus-mars"></i></span>
                                    </div>
                                    <select name="jenis_kelamin" class="form-control form-control-sm" required>
                                        <option value="L" {{ $item->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ $item->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Update Role --}}
                        <div class="col-md-6 mb-3">
                            <div class="form-group small font-weight-bold">
                                <label><span class="text-danger">*</span> Role User</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white"><i class="fas fa-user-tag"></i></span>
                                    </div>
                                    <select name="role_id" class="form-control form-control-sm" required>
                                        <option value="1" {{ $item->role_id == 1 ? 'selected' : '' }}>Admin</option>
                                        <option value="2" {{ $item->role_id == 2 ? 'selected' : '' }}>Dosen</option>
                                        <option value="3" {{ $item->role_id == 3 ? 'selected' : '' }}>Mahasiswa</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="col-md-6 mb-3">
                            <div class="form-group small font-weight-bold">
                                <label>Ganti Password</label>
                                <div class="input-group shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control form-control-sm" placeholder="Kosongkan jika tidak diubah">
                                </div>
                                <small class="text-muted text-italic">*Minimal 6 karakter jika ingin diubah</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light border-0">
                    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm shadow-sm">
                        <i class="fas fa-save mr-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>