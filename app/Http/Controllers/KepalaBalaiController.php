<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModPengajuanSapi;
use Illuminate\Routing\Controller;
use App\Models\ModJenisSapi;

class KepalaBalaiController extends Controller
{
    public function dashboard()
    {
        // Ambil jumlah pengajuan sapi
        $jumlahPengajuanSapi = ModPengajuanSapi::count();
        $jumlahPengajuan = ModPengajuanSapi::count();

        // // Tambahkan data lain yang dibutuhkan
        // $jumlahAnotherModel = AnotherModel::count(); // Ganti AnotherModel dengan model lain yang Anda gunakan

        return view('backend.kepala.index', compact('jumlahPengajuanSapi'));
    }

    public function pengajuansapi()
    {
        $PSapi = ModPengajuanSapi::with('user')->get();
        return view('backend.kepala.pengajuan_sapi.index', compact('PSapi'));
    }

    public function detailpengajuansapi($id)
    {
        $sapiJenis = ModJenisSapi::all();
        $pengajuan = ModPengajuanSapi::with('details', 'user')->find($id);
        if (!$pengajuan) {
            return redirect()->back()->withErrors(['Pengajuan tidak ditemukan']);
        }

        return view('backend.kepala.pengajuan_sapi.detail', compact('pengajuan', 'sapiJenis'));
    }
    public function updatepengajuansapi(Request $request, $id)
    {
        $request->validate([
            'belisapi_status' => 'required|string',
            'belisapi_keterangan' => 'required|string',
        ]);

        $pengajuan = ModPengajuanSapi::find($id);
        if (!$pengajuan) {
            return redirect()->back()->withErrors(['Pengajuan tidak ditemukan']);
        }

        $pengajuan->belisapi_status = $request->belisapi_status;
        $pengajuan->belisapi_keterangan = $request->belisapi_keterangan;
        $pengajuan->save();

        return redirect()->route('detail.kepala.psapi', $id)->with('success', 'Pengajuan berhasil diupdate');
    }
}
