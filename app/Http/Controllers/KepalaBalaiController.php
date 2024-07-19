<?php

namespace App\Http\Controllers;

use App\Models\ModSapi;
use App\Models\ModRumput;
use App\Models\ModKandang;
use App\Models\ModJenisSapi;
use Illuminate\Http\Request;
use App\Models\ModJenisLahan;
use App\Models\ModJenisRumput;
use App\Models\ModPengajuanSapi;
use App\Models\ModPengajuanRumput;
use Illuminate\Routing\Controller;

class KepalaBalaiController extends Controller
{
    public function dashboard()
    {
        $jumlahPengajuanSapi = ModPengajuanSapi::count();
        $jumlahPengajuanRumput = ModPengajuanRumput::count();
        $jumlahSapi = ModSapi::count();
        $jumlahRumput = ModRumput::count();
        $jumlahKandangSapi = ModKandang::count();
        $jumlahLahanRumput = ModJenisLahan::count();

        return view('backend.kepala.index', compact('jumlahPengajuanSapi', 'jumlahSapi', 'jumlahRumput', 'jumlahPengajuanRumput', 'jumlahKandangSapi', 'jumlahLahanRumput'));
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
