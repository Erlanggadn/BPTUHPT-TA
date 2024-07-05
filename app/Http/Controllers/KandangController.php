<?php

namespace App\Http\Controllers;

use App\Models\ModKandang;
use Illuminate\Http\Request;
use App\Models\ModJenisKandang;
use Illuminate\Routing\Controller;

class KandangController extends Controller
{
    public function index()
    {
        $Kandang = ModKandang::with('jenisKandang')->get();
        $jenisList = ModJenisKandang::all();
        return view('backend.wasbitnak.kandang.index', compact('Kandang', 'jenisList'));
    }

    public function show()
    {
        $jenisKandang = ModJenisKandang::all();
        return view('backend.wasbitnak.kandang.create', compact('jenisKandang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kand_jenis' => 'required|string|max:50',
            'kand_nama' => 'required|string|max:50',
            'kand_keterangan' => 'required|string|max:50',
            'kand_aktif' => 'required|in:Aktif,NonAktif',
        ]);

        $lastKode = ModKandang::orderBy('kand_id', 'desc')->first();
        $newKode = $lastKode ? 'K' . str_pad(((int) substr($lastKode->kand_id, 2)) + 1, 3, '0', STR_PAD_LEFT) : 'K001';

        ModKandang::create([
            'kand_id' => $newKode,
            'kand_jenis' => $request->kand_jenis,
            'kand_nama' => $request->kand_nama,
            'kand_keterangan' => $request->kand_keterangan,
            'kand_aktif' => $request->kand_aktif,
        ]);

        return redirect()->route('index.kandang')->with('success', 'Kandang berhasil ditambahkan');
    }
    public function detail($id)
    {
        $Kandang = ModKandang::with('jenisKandang')->findOrFail($id);
        $jenisList = ModJenisKandang::all();
        return view('backend.wasbitnak.kandang.detail', compact('Kandang', 'jenisList'));
    }

    public function update(Request $request, $kand_id)
    {
        $request->validate([
            'kand_nama' => 'required|string|max:50',

            'kand_keterangan' => 'required|string|max:50',
            'kand_aktif' => 'required|in:Aktif,NonAktif',
        ]);

        $Kandang = ModKandang::findOrFail($kand_id);
        $Kandang->update([
            'kand_nama' => $request->kand_nama,
            'kan_keterangan' => $request->kand_keterangan,
            'kand_aktif' => $request->kand_aktif,
        ]);

        return redirect()->route('index.kandang')->with('success', 'Kandang berhasil diubah');
    }

    public function destroy($id)
    {
        $Kandang = ModKandang::findOrFail($id);
        $Kandang->delete();
        return redirect()->route('index.kandang')->with('success', 'Data kandang berhasil dihapus');
    }

    public function filter(Request $request)
    {
        $query = ModKandang::with('jenisKandang');

        if ($request->filled('jenis_sapi')) {
            $query->where('kand_jenis', $request->jenis_sapi);
        }

        $Kandang = $query->get();
        $jenisList = ModJenisKandang::all(); // Mengambil daftar jenis kandang untuk dropdown filter

        return view('backend.wasbitnak.kandang.index', compact('Kandang', 'jenisList'));
    }
}
