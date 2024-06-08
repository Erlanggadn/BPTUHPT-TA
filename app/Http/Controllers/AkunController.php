<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{



    public function detailakun($id)
    {
        $akunuser = User::where('id', $id)->get(); // Mengambil data berdasarkan id
        return view('backend.admin.detailakun', ["akunuser" => $akunuser]);
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

        return redirect()->route('akunadmin')->with('success', 'Akun berhasil dihapus');
    }

    public function indexpembeli()
    {
        $akunuser = User::whereNotIn('role', ['wasbitnak', 'wastukan', 'kepala', 'admin', 'ppid', 'bendahara', 'keswan'])->get();
        return view('backend.admin.pembeli', ['akunuser' => $akunuser]);
    }

    public function detailpembeli($id)
    {
        $akunuser = User::where('id', $id)->get(); // Mengambil data berdasarkan id
        return view('backend.pembeli.detailakun', ["akunuser" => $akunuser]);
    }
}
