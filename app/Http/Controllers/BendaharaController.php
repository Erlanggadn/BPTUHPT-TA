<?php

namespace App\Http\Controllers;

use App\Models\ModPembeli;
use App\Models\ModJenisSapi;
use Illuminate\Http\Request;
use App\Models\ModPengajuanSapi;
use App\Models\ModPembayaranSapi;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\ModDetailPengajuanSapi;

class BendaharaController extends Controller
{
    public function dashboard()
    {
        return view('backend.bendahara.index');
    }

    public function indexsapi()
    {
        $PSapi = ModPengajuanSapi::with('user')->get();
        return view('backend.bendahara.sapi.index', compact('PSapi'));
    }

    public function detailsapi($belisapi_id)
    {
        // Retrieve the main pengajuan data
        $pengajuan = ModPengajuanSapi::where('belisapi_id', $belisapi_id)->firstOrFail();

        // Retrieve the payments related to the pengajuan through detail
        $detail = ModDetailPengajuanSapi::where('detail_pengajuan', $belisapi_id)->first();
        $pembayaran = $detail->pembayaranSapi()->first();

        // Retrieve other related data
        $sapiJenis = ModJenisSapi::all();
        $currentUser = ModPembeli::all();

        return view('backend.bendahara.sapi.detail', compact('pengajuan', 'sapiJenis', 'currentUser', 'pembayaran'));
    }


    public function storesapi(Request $request, $detail_id)
    {

        // Cek apakah detail_id ada di detail_detail_id_sapi
        if (!ModDetailPengajuanSapi::where('detail_id', $detail_id)->exists()) {
            return redirect()->route('detail.bendahara.psapi', $detail_id)->with('error', 'Pengajuan ID tidak ditemukan.');
        }

        // Set default value if dbeli_sudah is not provided
        $request->merge(['dbeli_sudah' => $request->input('dbeli_sudah', 'Saya Belum Membayar')]);

        $request->validate([
            'dbeli_invoice' => 'required|file|mimes:png,jpg,jpeg,pdf|max:2048',
            'dbeli_bukti' => 'nullable|file|mimes:png,jpg,jpeg,pdf|max:2048',
            'dbeli_sudah' => 'required|string|max:255',
            'dbeli_status' => 'required|string|max:255',
            'dbeli_keterangan' => 'nullable|string|max:255',
        ]);


        // Upload file
        $file = $request->file('dbeli_invoice');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);

        $buktiPath = $request->file('dbeli_bukti') ? $request->file('dbeli_bukti')->store('bukti_pembayaran') : null;

        $lastKode = ModPembayaranSapi::orderBy('dbeli_id', 'desc')->first();
        $newKode = $lastKode ? 'BS' . str_pad(((int) substr($lastKode->dbeli_id, 2)) + 1, 3, '0', STR_PAD_LEFT) : 'BS001';
        ModPembayaranSapi::create([
            'dbeli_id' => $newKode,
            'dbeli_beli' => $detail_id,
            'dbeli_invoice' => $filename,
            'dbeli_bukti' => $buktiPath,
            'dbeli_sudah' => $request->dbeli_sudah,
            'dbeli_status' => $request->dbeli_status,
            'dbeli_keterangan' => $request->dbeli_keterangan,
        ]);

        return redirect()->route('index.bendahara.psapi', $detail_id)->with('success', 'Pembayaran berhasil disimpan.');
    }

    public function showDetailForm($detail_id)
    {
        $detail = ModDetailPengajuanSapi::findOrFail($detail_id);
        $pembayaran = ModPembayaranSapi::where('dbeli_beli', $detail_id)->first();

        return view('detai', compact('detail', 'pembayaran'));
    }
}
