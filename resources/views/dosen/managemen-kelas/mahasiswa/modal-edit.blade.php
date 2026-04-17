{{-- MODAL EDIT MAHASISWA --}}
<div class="modal fade" id="modalEdit{{ $mhs->id }}" tabindex="-1" role="dialog" aria-labelledby="editLabel{{ $mhs->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="editLabel{{ $mhs->id }}">
                    <i class="fas fa-edit mr-2"></i> Edit Data Mahasiswa
                </h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            {{-- Sesuaikan route update kamu di sini --}}
            <form action="{{route('anggota-group-edit-mahasiswa', $mhs->id)}}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="modal-body text-left">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold small">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" value="{{ $mhs->user->nama ?? '' }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold small">NIM</label>
                                <input type="text" name="nim" class="form-control" value="{{ $mhs->nim }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold small">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $mhs->user->email ?? '' }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold small">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" required>
                                    <option value="L" {{ $mhs->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ $mhs->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold small">Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{ $mhs->user->phone }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold small">Angkatan</label>
                                <input type="number" name="angkatan" class="form-control" value="{{ $mhs->angkatan }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm shadow-sm">
                        <i class="fas fa-save mr-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>