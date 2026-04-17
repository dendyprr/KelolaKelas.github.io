<?php

namespace App\Http\Controllers\dosen;

use App\Models\Mahasiswa;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManagementUserController extends Controller
{
   
    public function index()
    {
        $data = [
            'title'                 => 'Management User',
            'activeManagemenUser'   => 'active',
            'data'                  => User::with('role', 'mahasiswa')->get()
        ];

        return view('dosen.management-users.index', $data);
    }

   public function addProccess(Request $request)
   {

        // dd($request->all());
        $request->validate([
            'nama'          => 'required',
            'email'         => 'required|email|unique:users,email', // Tambahkan validasi format email & unik
            'phone'         => 'required',
            'jenis_kelamin' => 'required',
            'role_id'       => 'required',
            'password'      => 'required|min:8', // Minimal 8 karakter
        ],
        [
            'nama.required'          => 'Nama lengkap tidak boleh kosong',
            'email.required'         => 'Email tidak boleh kosong', // Tadi kamu kurang .required
            'email.email'            => 'Format email tidak valid',
            'email.unique'           => 'Email sudah terdaftar',
            'phone.required'         => 'Nomor telepon tidak boleh kosong',
            'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong',
            'password.required'      => 'Password tidak boleh kosong',
            'password.min'           => 'Password minimal 8 karakter',
            'role_id.required'       => 'Role tidak boleh kosong',
        ]);

        User::create([
            'nama'                      => $request->nama,
            'email'                     => $request->email,
            'phone'                     => $request->phone,
            'jenis_kelamin'             => $request->jenis_kelamin,
            'password'                  => Hash::make($request->password), 
            'role_id'                   => $request->role_id
        ]);

        return back()->with('success', 'Mahasiswa berhasil didaftarkan!');
    }

    public function editProccess(Request $request, $id)
    {
   
        // Validasi data (opsional tapi disarankan)
        $request->validate([
            'nama'          => 'required',
            'email'         => 'nullable|email',
            'NIDN'          => 'nullable',
            'nim'           => 'nullable',
            'phone'         => 'nullable',
            'jenis_kelamin' => 'nullable',
            'role_id'       => 'nullable',
            'password'      => 'nullable|min:8',
        ]);

        DB::beginTransaction();

        try {
            $user = User::findOrFail($id);

            $userData = $request->only([
                'nama', 
                'email', 
                'phone', 
                'jenis_kelamin', 
                'role_id', 
                'NIDN'
            ]);
            
            if ($request->filled('password')) {
                $userData['password'] = bcrypt($request->password);
            }

            $user->update($userData);
            if ($request->role_id == 3) {
                // Update atau Create jika sebelumnya belum ada datanya
                Mahasiswa::updateOrCreate(
                    ['user_id' => $user->id], // Cari berdasarkan user_id
                    ['nim' => $request->nim]  // Update kolom NIM
                );
            }

            DB::commit();
            return redirect()->route('manajement-user-index')->with('success', 'Data berhasil diubah');

        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function hapus($id)
    {
        $user = User::findOrFail($id);
        Mahasiswa::where('user_id', $id)->delete();
        $user->delete();


        return redirect()->route('manajement-user-index')->with('success', 'Data berhasil dihapus');
    }

    
}