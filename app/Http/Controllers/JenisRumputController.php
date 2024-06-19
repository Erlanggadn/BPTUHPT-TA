<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModJenisRumput;
use Illuminate\Routing\Controller;

class JenisRumputController extends Controller
{
    public function index()
    {
        $JenisRumput = ModJenisRumput::all();
        return view('backend.wastukan.jenis_rumput.index', compact('JenisRumput'));
    }

    public function show()
    {
        return view('backend.wastukan.jenis_rumput.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'rum_nama' => 'required|string|max:50|unique:master_rumput_jenis,rum_nama',
            'rum_keterangan' => 'required|string|max:50',
            'rum_aktif' => 'required|in:Aktif,NonAktif',
        ]);

        $lastRumput = ModJenisRumput::orderBy('rum_id', 'desc')->first();
        $rum_kode = 'R' . str_pad($lastRumput ? $lastRumput->rum_id + 1 : 1, 3, '0', STR_PAD_LEFT);

        ModJenisRumput::create([
            'rum_kode' => $rum_kode,
            'rum_nama' => $request->rum_nama,
            'rum_keterangan' => $request->rum_keterangan,
            'rum_aktif' => $request->rum_aktif,
            'created_id' => auth()->user()->id,
            'created_nama' => auth()->user()->name,
            'updated_id' => auth()->user()->id,
            'updated_nama' => auth()->user()->name,
        ]);

        return redirect()->route('index.jenis.rumput')->with('success', 'Jenis rumput berhasil ditambahkan.');
    }

    public function detail($id)
    {
        $jenisRumput = ModJenisRumput::findOrFail($id);
        return view('backend.wastukan.jenis_rumput.detail', compact('jenisRumput'));
    }

    public function edit($rum_id)
    {
        $jenisRumput = ModJenisRumput::findOrFail($rum_id);
        return view('backend.wastukan.jenis_rumput.edit', compact('jenisRumput'));
    }

    public function update(Request $request, $rum_id)
    {
        $request->validate([
            'rum_nama' => 'required|string|max:50',
            'rum_keterangan' => 'required|string|max:50',
            'rum_aktif' => 'required|in:Aktif,NonAktif',
        ]);

        $jenisRumput = ModJenisRumput::findOrFail($rum_id);
        $jenisRumput->update([
            'rum_nama' => $request->rum_nama,
            'rum_keterangan' => $request->rum_keterangan,
            'rum_aktif' => $request->rum_aktif,
            'updated_id' => auth()->user()->id,
            'updated_nama' => auth()->user()->name,
        ]);

        return redirect()->route('index.jenis.rumput')->with('success', 'Jenis rumput berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jenisRumput = ModJenisRumput::findOrFail($id);
        $jenisRumput->delete();

        return redirect()->route('index.jenis.rumput')->with('success', 'Data berhasil dihapus');
    }
}
