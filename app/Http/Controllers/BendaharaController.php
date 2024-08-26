<?php

namespace App\Http\Controllers;

use App\Models\ModPembeli;
use App\Models\ModJenisSapi;
use Illuminate\Http\Request;
use App\Models\ModJenisRumput;
use App\Models\ModPengajuanSapi;
use App\Models\ModPembayaranSapi;
use App\Models\ModPengajuanRumput;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\ModPembayaranRumput;
use App\Models\ModDetailPengajuanSapi;
use App\Models\ModDetailPengajuanRumput;

class BendaharaController extends Controller
{
    //INDEX BENDAHARA
    public function dashboard()
    {
        return view('backend.bendahara.index');
    }

    //BAYAR SAPI
    public function indexsapi()
    {
        $PSapi = ModPengajuanSapi::with(['user', 'pembayaranSapi' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->where('belisapi_status', 'Disetujui')->get();
        return view('backend.bendahara.sapi.index', compact('PSapi'));
    }
    public function detailsapi($belisapi_id)
    {
        $pengajuan = ModPengajuanSapi::where('belisapi_id', $belisapi_id)->firstOrFail();
        $detail = ModDetailPengajuanSapi::where('detail_pengajuan', $belisapi_id)->first();
        $sapiJenis = ModJenisSapi::all();
        $currentUser = ModPembeli::all();
        $pembayaran = ModPembayaranSapi::where('dbeli_beli', $belisapi_id)->first(); // Pastikan variabel pembayaran diambil

        return view('backend.bendahara.sapi.detail', compact('pengajuan', 'sapiJenis', 'currentUser', 'pembayaran'));
    }
    public function storebayarsapi(Request $request, $belisapi_id)
    {
        $request->validate([
            'dbeli_invoice' => 'required|file|mimes:jpg,png,jpeg,pdf',
            'dbeli_status' => 'required|string',
            'dbeli_keterangan' => 'nullable|string',
        ]);

        // Simpan file invoice
        $file = $request->file('dbeli_invoice');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);


        // Buat kode baru untuk dbeli_id
        $lastKode = ModPembayaranSapi::orderBy('dbeli_id', 'desc')->first();
        $newKode = $lastKode ? 'BS' . str_pad(((int) substr($lastKode->dbeli_id, 2)) + 1, 3, '0', STR_PAD_LEFT) : 'BS001';

        // Simpan data pembayaran sapi
        ModPembayaranSapi::create([
            'dbeli_id' => $newKode,
            'dbeli_beli' => $belisapi_id,
            'dbeli_invoice' => $filename,
            'dbeli_status' => $request->dbeli_status,
            'dbeli_keterangan' => $request->dbeli_keterangan,
            'dbeli_bukti' => null,
            'dbeli_sudah' => 'Saya Belum membayar',
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('index.bendahara.psapi')->with('success', 'Pembayaran berhasil disimpan.');
    }
    public function updatebayarsapi(Request $request, $dbeli_id)
    {
        $request->validate([
            'dbeli_status' => 'required|string',
            'dbeli_keterangan' => 'nullable|string',
        ]);

        // Cari data pembayaran berdasarkan dbeli_id
        $pembayaran = ModPembayaranSapi::findOrFail($dbeli_id);

        // Update data pembayaran
        $pembayaran->update([
            'dbeli_status' => $request->dbeli_status,
            'dbeli_keterangan' => $request->dbeli_keterangan,
        ]);

        return redirect()->route('index.bendahara.psapi')->with('success', 'Pembayaran berhasil diperbarui.');
    }
    public function deletebayarsapi($dbeli_id)
    {
        $pembayaran = ModPembayaranSapi::findOrFail($dbeli_id);
        $pembayaran->delete();
        return redirect()->route('index.bendahara.psapi')->with('success', 'Pembayaran berhasil dihapus.');
    }

    //BAYAR RUMPUT
    public function indexrumput()
    {
        $PRumput = ModPengajuanRumput::with(['pembeli', 'pembayaranRumput' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->where('belirum_status', 'Disetujui')->get();
        return view('backend.bendahara.rumput.index', compact('PRumput'));
    }
    public function detailrumput($belirum_id)
    {
        $pengajuan = ModPengajuanRumput::where('belirum_id', $belirum_id)->firstOrFail();
        $detail = ModDetailPengajuanRumput::where('drumput_pengajuan', $belirum_id)->first();
        $rumputJenis = ModJenisRumput::all();
        $currentUser = ModPembeli::all();
        $pembayaran = ModPembayaranRumput::where('bayarrum_beli', $belirum_id)->first(); // Pastikan variabel pembayaran diambil

        return view('backend.bendahara.rumput.detail', compact('pengajuan', 'rumputJenis', 'currentUser', 'pembayaran'));
    }
    public function storebayarrumput(Request $request, $belirum_id)
    {
        $request->validate([
            'bayarrum_invoice' => 'required|file|mimes:jpg,png,jpeg,pdf',
            'bayarrum_status' => 'required|string',
            'bayarrum_keterangan' => 'nullable|string',
        ]);

        // Simpan file invoice
        $file = $request->file('bayarrum_invoice');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);


        // Buat kode baru untuk dbeli_id
        $lastKode = ModPembayaranRumput::orderBy('bayarrum_id', 'desc')->first();
        $newKode = $lastKode ? 'BR' . str_pad(((int) substr($lastKode->bayarrum_id, 2)) + 1, 3, '0', STR_PAD_LEFT) : 'BR001';

        // Simpan data pembayaran sapi
        ModPembayaranRumput::create([
            'bayarrum_id' => $newKode,
            'bayarrum_beli' => $belirum_id,
            'bayarrum_invoice' => $filename,
            'bayarrum_status' => $request->bayarrum_status,
            'bayarrum_keterangan' => $request->bayarrum_keterangan,
            'bayarrum_bukti' => null,
            'bayarrum_sudah' => 'Saya Belum membayar',
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('index.bendahara.prumput')->with('success', 'Pembayaran berhasil disimpan.');
    }
    public function updatebayarrumput(Request $request, $bayarrum_id)
    {
        $request->validate([
            'bayarrum_status' => 'required|string',
            'bayarrum_keterangan' => 'nullable|string',
        ]);

        // Cari data pembayaran berdasarkan bayarrum_id
        $pembayaran = ModPembayaranRumput::findOrFail($bayarrum_id);

        // Update data pembayaran
        $pembayaran->update([
            'bayarrum_status' => $request->bayarrum_status,
            'bayarrum_keterangan' => $request->bayarrum_keterangan,
        ]);

        return redirect()->route('index.bendahara.prumput')->with('success', 'Pembayaran berhasil diperbarui.');
    }
    public function deletebayarrumput($bayarrum_id)
    {
        $pembayaran = ModPembayaranRumput::findOrFail($bayarrum_id);
        $pembayaran->forceDelete();
        return redirect()->route('index.bendahara.prumput')->with('success', 'Pembayaran berhasil dihapus.');
    }
}
