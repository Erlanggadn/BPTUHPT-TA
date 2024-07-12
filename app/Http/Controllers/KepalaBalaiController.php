<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModPengajuanSapi;
use App\Models\ModPengajuanRumput;
use Illuminate\Routing\Controller;
use App\Models\ModJenisSapi;
use App\Models\ModJenisRumput;

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

    public function pengajuanrumput()
    {
        $PRumput = ModPengajuanRumput::with('pembeli')->get();
        return view('backend.kepala.pengajuan_rumput.index', compact('PRumput'));
    }
    public function detailpengajuanrumput($id)
    {
        $rumputJenis = ModJenisRumput::all();
        $pengajuan = ModPengajuanRumput::with('detailPengajuanRumput', 'pembeli')->find($id);
        if (!$pengajuan) {
            return redirect()->back()->withErrors(['Pengajuan tidak ditemukan']);
        }

        return view('backend.kepala.pengajuan_rumput.detail', compact('pengajuan', 'rumputJenis'));
    }
    public function updatepengajuanrumput(Request $request, $id)
    {
        $request->validate([
            'belirum_status' => 'required|string',
            'belirum_keterangan' => 'required|string',
        ]);

        $pengajuan = ModPengajuanRumput::find($id);
        if (!$pengajuan) {
            return redirect()->back()->withErrors(['Pengajuan tidak ditemukan']);
        }

        $pengajuan->belirum_status = $request->belirum_status;
        $pengajuan->belirum_keterangan = $request->belirum_keterangan;
        $pengajuan->save();

        return redirect()->route('detail.kepala.prumput', $id)->with('success', 'Pengajuan berhasil diupdate');
    }
}
