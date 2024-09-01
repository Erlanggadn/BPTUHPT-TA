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
            'kandang_tipe' => 'required|string|max:50|unique:master_kandang_jenis,kandang_tipe',
            'kandang_keterangan' => 'required|string|max:50',
        ]);

        $lastKode = ModJenisKandang::orderBy('kandang_id', 'desc')->first();
        $newKode = $lastKode ? 'KD' . str_pad(((int) substr($lastKode->kandang_id, 2)) + 1, 3, '0', STR_PAD_LEFT) : 'KD001';

        ModJenisKandang::create([
            'kandang_id' => $newKode,
            'kandang_tipe' => $request->kandang_tipe,
            'kandang_keterangan' => $request->kandang_keterangan,
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
            'kandang_tipe' => 'required|string|max:50|unique:master_kandang_jenis,kandang_tipe,' . $kandang_id . ',kandang_id',
            'kandang_keterangan' => 'required|string|max:50',
        ]);

        $jenisKandang = ModJenisKandang::findOrFail($kandang_id);
        $jenisKandang->update([
            'kandang_tipe' => $request->kandang_tipe,
            'kandang_keterangan' => $request->kandang_keterangan,
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
