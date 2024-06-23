<?php

namespace App\Http\Controllers;

use App\Models\ModRumput;
use Illuminate\Http\Request;
use App\Models\ModJenisRumput;
use Illuminate\Routing\Controller;

class RumputController extends Controller
{
    public function index()
    {
        $Rumput = ModRumput::with('jenisRumput')->get();
        $jenisList = ModJenisRumput::all(); // Mengambil daftar jenis sapi untuk dropdown filter
        return view('backend.wastukan.rumput.index', compact('Rumput', 'jenisList'));
    }

    public function show()
    {
        $jenisRumput = ModJenisRumput::where('rum_aktif', 'Aktif')->get();
        return view('backend.wastukan.rumput.create', compact('jenisRumput'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rumput_jenis' => 'required',
            'rumput_berat' => 'required|integer|max:5',
            'rumput_masuk' => 'required|date',
            'rumput_keterangan' => 'required|string|max:50',
            'rumput_aktif' => 'required|in:Aktif,NonAktif',
        ]);

        $lastKode = ModRumput::orderBy('rumput_kode', 'desc')->first();
        $newKode = $lastKode ? 'R' .  str_pad(((int) substr($lastKode->rumput_kode, 2)) + 1, 3, '0', STR_PAD_LEFT) : 'R001';

        ModRumput::create([
            'rumput_kode' => $newKode,
            'rumput_jenis' => $request->rumput_jenis,
            'rumput_berat' => $request->rumput_berat,
            'rumput_masuk' => $request->rumput_masuk,
            'rumput_keterangan' => $request->rumput_keterangan,
            'rumput_aktif' => $request->rumput_aktif,

            'created_id' => auth()->user()->id,
            'created_nama' => auth()->user()->name,
            'updated_id' => auth()->user()->id,
            'updated_nama' => auth()->user()->name,
        ]);

        return redirect()->route('index.rumput')->with('success', 'rumput berhasil ditambahkan');
    }

    public function detail($id)
    {
        $rumput = ModRumput::with('jenisRumput')->findOrFail($id);
        return view('backend.wastukan.rumput.detail', compact('rumput'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // 'rumput_jenis' => 'required',
            'rumput_berat' => 'required|integer|max:5',
            'rumput_masuk' => 'required|date',
            'rumput_keterangan' => 'required|string|max:50',
            'rumput_aktif' => 'required|in:Aktif,NonAktif',
        ]);

        $rumput = ModRumput::findOrFail($id);

        $rumput->rumput_berat = $request->rumput_berat;
        $rumput->rumput_masuk = $request->rumput_masuk;
        $rumput->rumput_keterangan = $request->rumput_keterangan;
        $rumput->rumput_aktif = $request->rumput_aktif;
        $rumput->updated_id = auth()->user()->id;
        $rumput->updated_nama = auth()->user()->name;
        $rumput->save();

        return redirect()->route('detail.rumput', $id)->with('success', 'Data sapi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $rumput = ModRumput::findOrFail($id);
        $rumput->delete();
        return redirect()->route('index.rumput')->with('success', 'Data rumput berhasil dihapus');
    }
}
