<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModJenisLahan;
use Illuminate\Routing\Controller;

class JenisLahanController extends Controller
{
    public function index()
    {
        $JenisLahan = ModJenisLahan::all();
        return view('backend.wastukan.jenis_lahan.index', compact('JenisLahan'));
    }

    public function show()
    {
        return view('backend.wastukan.jenis_lahan.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'lahan_nama' => 'required|string|max:50|unique:master_lahan_jenis,lahan_nama',
            'lahan_keterangan' => 'required|string|max:50',
            'lahan_aktif' => 'required|in:Aktif,NonAktif',
        ]);

        $lastKode = ModJenisLahan::orderBy('lahan_id', 'desc')->first();
        $newKode = $lastKode ? 'LH' . str_pad(((int) substr($lastKode->lahan_kode, 2)) + 1, 3, '0', STR_PAD_LEFT) : 'LH001';

        ModJenisLahan::create([
            'lahan_kode' => $newKode,
            'lahan_nama' => $request->lahan_nama,
            'lahan_keterangan' => $request->lahan_keterangan,
            'lahan_aktif' => $request->lahan_aktif,
            'created_id' => auth()->user()->id, // Assuming user authentication is implemented
            'created_nama' => auth()->user()->name,
            'updated_id' => auth()->user()->id,
            'updated_nama' => auth()->user()->name,
        ]);

        return redirect()->route('index.jenis.lahan')->with('success', 'Jenis Lahan berhasil ditambahkan');
    }

    public function detail($id)
    {
        $jenisLahan = ModJenisLahan::findOrFail($id);
        return view('backend.wastukan.jenis_lahan.detail', compact('jenisLahan'));
    }

    public function edit($lahan_id)
    {
        $jenisLahan = ModJenisLahan::findOrFail($lahan_id);
        return view('backend.wastukan.jenis_lahan.edit', compact('jenisLahan'));
    }

    public function update(Request $request, $lahan_id)
    {
        $request->validate([
            'lahan_nama' => 'required|string|max:50',
            'lahan_keterangan' => 'required|string|max:50',
            'lahan_aktif' => 'required|in:Aktif,NonAktif',
        ]);

        $jenisLahan = ModJenisLahan::findOrFail($lahan_id);
        $jenisLahan->update([
            'lahan_nama' => $request->lahan_nama,
            'lahan_keterangan' => $request->lahan_keterangan,
            'lahan_aktif' => $request->lahan_aktif,
            'updated_id' => auth()->user()->id,
            'updated_nama' => auth()->user()->name,
        ]);

        return redirect()->route('index.jenis.lahan')->with('success', 'Jenis Lahan berhasil diubah');
    }

    public function destroy($id)
    {
        $jenisLahan = ModJenisLahan::findOrFail($id);
        $jenisLahan->delete();

        return redirect()->route('index.jenis.lahan')->with('success', 'Data berhasil dihapus');
    }
}
