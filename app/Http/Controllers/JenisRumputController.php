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

        ]);

        $lastKode = ModJenisRumput::orderBy('rum_id', 'desc')->first();
        $newKode = $lastKode ? 'JR' . str_pad(((int) substr($lastKode->rum_id, 2)) + 1, 3, '0', STR_PAD_LEFT) : 'JR001';

        ModJenisRumput::create([
            'rum_id' => $newKode,
            'rum_nama' => $request->rum_nama,
            'rum_keterangan' => $request->rum_keterangan,
        ]);

        return redirect()->route('index.jenis.rumput')->with('success', 'Jenis rumput berhasil ditambahkan.');
    }
    public function detail($id)
    {
        $jenisRumput = ModJenisRumput::findOrFail($id);
        return view('backend.wastukan.jenis_rumput.detail', compact('jenisRumput'));
    }
    public function update(Request $request, $rum_id)
    {

        $request->validate([
            'rum_nama' => 'required|string|max:50',
            'rum_keterangan' => 'required|string|max:50',
        ]);

        $jenisRumput = ModJenisRumput::findOrFail($rum_id);
        $jenisRumput->update([
            'rum_nama' => $request->rum_nama,
            'rum_keterangan' => $request->rum_keterangan,
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
