<?php

namespace App\Http\Controllers;

use App\Models\Sapi;
use App\Models\JenisKandang;
use App\Models\KegiatanSapi;
use Illuminate\Http\Request;
use App\Models\KegiatanKandang;
use App\Http\Controllers\Controller;

class KegiatanKandangController extends Controller
{
    public function index()
    {
        $KegiatanKandangs = KegiatanKandang::all();
        return view('backend.wasbitnak.kegiatan.index', compact('KegiatanKandangs'));
    }

    public function create()
    {
        $jenisKandangs = JenisKandang::all();

        $assignedKandangIds = KegiatanKandang::pluck('kode_kandang')->toArray();
        $jenisKandangs = JenisKandang::whereNotIn('id_kandang', $assignedKandangIds)->get();

        $assignedSapiIds = KegiatanSapi::pluck('kode_sapi')->toArray();
        $sapis = Sapi::whereNotIn('id', $assignedSapiIds)->get();

        return view('backend.wasbitnak.kegiatan.tambah', compact('jenisKandangs', 'sapis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_kandang' => 'required|exists:jenis_kandang,id_kandang',
            'kegiatan' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'kode_sapi' => 'required|array',
            'kode_sapi.*' => 'required|exists:sapi,id',
        ], [
            'kode_kandang.required' => 'Harus diisi ya...',
            'kode_kandang.exists' => 'Data Ini sudah ada'
        ]);

        $kegiatanKandang = KegiatanKandang::create([
            'kode_kandang' => $validated['kode_kandang'],
            'kegiatan' => $validated['kegiatan'],
            'status' => $validated['status'],
        ]);

        foreach ($validated['kode_sapi'] as $kodeSapi) {
            KegiatanSapi::create([
                'id_kegiatan' => $kegiatanKandang->id_kegiatan,
                'kode_sapi' => $kodeSapi,
            ]);
        }

        return redirect()->route('indexkegiatankandang')->with('success', 'Kegiatan kandang berhasil ditambahkan.');
    }

    public function detail($id_kegiatan)
    {
        $kegiatanKandang = KegiatanKandang::with('kegiatanSapi.sapi')->findOrFail($id_kegiatan);
        $jenisKandangs = JenisKandang::all();
        return view('backend.wasbitnak.kegiatan.detail', compact('jenisKandangs', 'kegiatanKandang'));
    }

    public function edit($id_kegiatan)
    {
        $kegiatanKandang = KegiatanKandang::findOrFail($id_kegiatan);
        return view('backend.wasbitnak.kegiatan.edit', compact('kegiatanKandang'));
    }

    public function update(Request $request, $id_kegiatan)
    {
        $request->validate([
            'kegiatan' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        $kegiatanKandang = KegiatanKandang::findOrFail($id_kegiatan);
        $kegiatanKandang->update([
            'kegiatan' => $request->kegiatan,
            'status' => $request->status,
        ]);

        return redirect()->route('detailkegiatan', $id_kegiatan)->with('success', 'Deskripsi dan status kegiatan kandang berhasil diperbarui.');
    }

    public function delete($id)
    {
        $kegiatanKandang = KegiatanKandang::findOrFail($id);
        $kegiatanKandang->delete();

        return redirect()->route('indexkegiatankandang')->with('success', 'Data berhasil dihapus');
    }

    //DATABASE KEGIATAN SAPI
    public function hapusSapi($id_kegiatan, $id_sapi)
    {
        $kegiatanSapi = KegiatanSapi::where('id_kegiatan', $id_kegiatan)
            ->where('kode_sapi', $id_sapi)
            ->firstOrFail();
        $kegiatanSapi->delete();

        return redirect()->route('detailkegiatan', $id_kegiatan)->with('success', 'Sapi berhasil dihapus dari kegiatan.');
    }

    public function tambahSapi(Request $request, $id_kegiatan)
    {
        $validated = $request->validate([
            'kode_sapi' => 'required|array',
            'kode_sapi.*' => 'required|exists:sapi,id',
        ]);

        foreach ($validated['kode_sapi'] as $kodeSapi) {
            KegiatanSapi::create([
                'id_kegiatan' => $id_kegiatan,
                'kode_sapi' => $kodeSapi,
            ]);
        }

        return redirect()->route('detailkegiatan', $id_kegiatan)->with('success', 'Sapi berhasil ditambahkan ke kegiatan.');
    }
}
