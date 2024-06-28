<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AkunController extends Controller
{
    public function detailakun($id)
    {
            $akunuser = User::where('id', $id)->get(); // Mengambil data berdasarkan id
            return view('backend.admin.detailakun', ["akunuser" => $akunuser]);
    }

    public function detailakunpembeli($id)
    {
        $akunuser = User::where('id', $id)->get(); // Mengambil data berdasarkan id
        return view('backend.admin.pembeli.detail', ["akunuser" => $akunuser]);
    }

    public function profiladmin()
    {
        $akunuser = Auth::user();
        return view('backend.admin.detailadmin', ["akunuser" => $akunuser]);
    }

    public function profilkeswan()
    {
        $akunuser = Auth::user();
        return view('backend.keswan.detailkeswan', ["akunuser" => $akunuser]);
    }

    public function profilwastukan()
    {
        $akunuser = Auth::user();
        return view('backend.wastukan.profil.detailprofil', ["akunuser" => $akunuser]);
    }

    public function profilwasbitnak()
    {
        $akunuser = Auth::user();
        return view('backend.wasbitnak.profil.detailprofil', ["akunuser" => $akunuser]);
    }

    public function profilppid()    
    {
        $akunuser = Auth::user();
        return view('backend.ppid.profil.detailprofil', ["akunuser" => $akunuser]);
    }


    public function edit($id)
    {
        $akunuser = User::findOrFail($id);
        return view('backend.admin.edit', compact('akunuser'));
    }

    public function update(Request $request, $id)
    {
        $akunuser = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required|string',
            'nohp' => 'required|numeric',
            'alamat' => 'required|string',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|confirmed',
        ]);

        // Tambahkan pesan error custom 
        $validator->after(function ($validator) use ($request, $akunuser) {
            if ($request->filled('current_password') && !Hash::check($request->current_password, $akunuser->password)) {
                $validator->errors()->add('current_password', 'Password tidak sesuai');
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Mengambil semua data dari request kecuali password
        $data = $request->except('password', 'new_password', 'current_password', 'new_password_confirmation');

        // Jika password baru diberikan, hash password tersebut
        if ($request->filled('new_password')) {
            $data['password'] = Hash::make($request->new_password);
        }

        // Update data pengguna dengan data yang telah dimodifikasi
        $akunuser->update($data);

        // Redirect dengan pesan sukses
        return redirect()->route('detailakun', $akunuser->id)->with('berhasil.edit', 'Akun berhasil diperbarui');
    }

    public function editpegawai($id)
    {
        $akunuser = User::findOrFail($id);
        return view('backend.auth.pegawai.edit-profil', compact('akunuser'));
    }

    public function updatepegawai(Request $request, $id)
    {
        $akunuser = User::findOrFail($id);
        $data = $request->all(); // Mengambil semua data dari request

        // Jika password baru diberikan dalam permintaan, hash password tersebut
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            // Jika tidak ada password baru dalam permintaan, hapus 'password' dari data
            unset($data['password']);
        }

        // Update data pengguna dengan data yang telah dimodifikasi
        $akunuser->update($data);

        // Redirect ke URL sebelumnya atau ke halaman akun admin jika URL sebelumnya tidak ada
        $previousUrl = $request->input('previous_url', route('akunadmin'));

        // Redirect dengan pesan sukses
        return redirect($previousUrl)->with('success', 'Akun berhasil diperbarui');
    }

    public function delete($id)
    {
        $akunuser = User::findOrFail($id);
        $akunuser->delete();

        return redirect()->route('akunadmin')->with('berhasil.hapus', 'Akun berhasil dihapus');
    }

    public function indexpembeli()
    {
        $akunuser = User::whereNotIn('role', ['admin', 'ppid', 'wastukan', 'wasbitnak', 'kepala', 'keswan', 'bendahara'])->get();
        $jumlahPembeli = User::whereNotIn('role', ['admin', 'ppid', 'wastukan', 'wasbitnak', 'kepala', 'keswan', 'bendahara'])->count();
        return view('backend.admin.pembeli', ['akunuser' => $akunuser, 'jumlahPembeli' => $jumlahPembeli]);
    }

    public function detailpembeli($id)
    {
        $akunuser = User::where('id', $id)->get(); // Mengambil data berdasarkan id
        return view('backend.pembeli.detailakun', ["akunuser" => $akunuser]);
    }
}
