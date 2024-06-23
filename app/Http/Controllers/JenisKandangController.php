<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModJenisKandang;
use Illuminate\Routing\Controller;

class JenisKandangController extends Controller
{
    public function index()
    {
        $JenisKandang = ModJenisKandang::all();
        return view('backend.wasbitnak.jenis_kandang.index', compact('JenisKandang'));
    }

    public function show()
    {
        return view('backend.wasbitnak.jenis_kandang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kandang_nama' => 'required|string|max:50',
            'kandang_tipe' => 'required|string|max:50',
            'kandang_keterangan' => 'required|string|max:50',
            'kandang_aktif' => 'required|in:Aktif,NonAktif',
        ]);

        $lastKode = ModJenisKandang::orderBy('kandang_id', 'desc')->first();
        $newKode = $lastKode ? 'KD' . str_pad(((int) substr($lastKode->kandang_kode, 2)) + 1, 3, '0', STR_PAD_LEFT) : 'KD001';

        ModJenisKandang::create([
            'kandang_kode' => $newKode,
            'kandang_nama' => $request->kandang_nama,
            'kandang_tipe' => $request->kandang_tipe,
            'kandang_keterangan' => $request->kandang_keterangan,
            'kandang_aktif' => $request->kandang_aktif,
            'created_id' => auth()->user()->id, // Assuming user authentication is implemented
            'created_nama' => auth()->user()->name,
            'updated_id' => auth()->user()->id,
            'updated_nama' => auth()->user()->name,
        ]);

        return redirect()->route('index.jenis.kandang')->with('success', 'Jenis Kandang berhasil ditambahkan');
    }

    public function detail($id)
    {
        $jenisKandang = ModJenisKandang::findOrFail($id);
        return view('backend.wasbitnak.jenis_kandang.detail', compact('jenisKandang'));
    }

    public function edit($kandang_id)
    {
        $jenisKandang = ModJenisKandang::findOrFail($kandang_id);
        return view('backend.wasbitnak.jenis_kandang.edit', compact('jenisKandang'));
    }

    public function update(Request $request, $kandang_id)
    {
        $request->validate([
            'kandang_nama' => 'required|string|max:50',
            'kandang_tipe' => 'required|string|max:50',
            'kandang_keterangan' => 'required|string|max:50',
            'kandang_aktif' => 'required|in:Aktif,NonAktif',
        ]);

        $jenisKandang = ModJenisKandang::findOrFail($kandang_id);
        $jenisKandang->update([
            'kandang_nama' => $request->kandang_nama,
            'kandang_tipe' => $request->kandang_tipe,
            'kandang_keterangan' => $request->kandang_keterangan,
            'kandang_aktif' => $request->kandang_aktif,
            'updated_id' => auth()->user()->id,
            'updated_nama' => auth()->user()->name,
        ]);

        return redirect()->route('index.jenis.kandang')->with('success', 'Jenis Kandang berhasil diubah');
    }

    public function destroy($id)
    {
        $jenisLahan = ModJenisKandang::findOrFail($id);
        $jenisLahan->delete();

        return redirect()->route('index.jenis.kandang')->with('success', 'Data berhasil dihapus');
    }
}
