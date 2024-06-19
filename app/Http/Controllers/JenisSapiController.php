<?php

namespace App\Http\Controllers;

use App\Models\ModJenisSapi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class JenisSapiController extends Controller
{
    public function index()
    {
        $JenisSapi = ModJenisSapi::all();
        return view('backend.wasbitnak.jenis_sapi.index', compact('JenisSapi'));
    }

    public function show()
    {
        return view('backend.wasbitnak.jenis_sapi.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'sjenis_nama' => 'required|string|max:50|unique:master_sapi_jenis,sjenis_nama',
            'sjenis_keterangan' => 'required|string|max:50',
            'sjenis_aktif' => 'required|in:Aktif,NonAktif',
        ]);

        $lastKode = ModJenisSapi::orderBy('sjenis_id', 'desc')->first();
        $newKode = $lastKode ? 'JS' . str_pad(((int) substr($lastKode->sjenis_kode, 2)) + 1, 3, '0', STR_PAD_LEFT) : 'JS001';

        ModJenisSapi::create([
            'sjenis_kode' => $newKode,
            'sjenis_nama' => $request->sjenis_nama,
            'sjenis_keterangan' => $request->sjenis_keterangan,
            'sjenis_aktif' => $request->sjenis_aktif,
            'created_id' => auth()->user()->id, // Assuming user authentication is implemented
            'created_nama' => auth()->user()->name,
            'updated_id' => auth()->user()->id,
            'updated_nama' => auth()->user()->name,
        ]);

        return redirect()->route('index.jenis.sapi')->with('success', 'Jenis Sapi berhasil ditambahkan');
    }

    public function detail($id)
    {
        $jenisSapi = ModJenisSapi::findOrFail($id);
        return view('backend.wasbitnak.jenis_sapi.detail', compact('jenisSapi'));
    }

    public function edit($sjenis_id)
    {
        $jenisSapi = ModJenisSapi::findOrFail($sjenis_id);
        return view('backend.wasbitnak.jenis_sapi.edit', compact('jenisSapi'));
    }

    public function update(Request $request, $sjenis_id)
    {
        $request->validate([
            'sjenis_nama' => 'required|string|max:50',
            'sjenis_keterangan' => 'required|string|max:50',
            'sjenis_aktif' => 'required|in:Aktif,NonAktif',
        ]);

        $jenisSapi = ModJenisSapi::findOrFail($sjenis_id);
        $jenisSapi->update([
            'sjenis_nama' => $request->sjenis_nama,
            'sjenis_keterangan' => $request->sjenis_keterangan,
            'sjenis_aktif' => $request->sjenis_aktif,
            'updated_id' => auth()->user()->id,
            'updated_nama' => auth()->user()->name,
        ]);

        return redirect()->route('index.jenis.sapi')->with('success', 'Jenis Sapi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jenisSapi = ModJenisSapi::findOrFail($id);
        $jenisSapi->delete();

        return redirect()->route('index.jenis.sapi')->with('success', 'Data berhasil dihapus');
    }
}
