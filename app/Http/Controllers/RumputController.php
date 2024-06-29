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
        $jenisList = ModJenisRumput::all(); // Mengambil daftar jenis rumput untuk dropdown filter
        return view('backend.wastukan.rumput.index', compact('Rumput', 'jenisList'));
    }

    public function show()
    {
        $jenisRumput = ModJenisRumput::all();
        return view('backend.wastukan.rumput.create', compact('jenisRumput'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rumput_jenis' => 'required',
            'rumput_berat_awal' => 'required|integer|max:1000',
            // 'rumput_berat_hasil' => 'nullable|integer|max:1000', // Mengizinkan null karena default 0 di database
            'rumput_masuk' => 'required|date',
            'rumput_keterangan' => 'required|string|max:50',
            'rumput_status' => 'required|string|max:50',
        ]);

        $lastKode = ModRumput::orderBy('rumput_id', 'desc')->first();
        $newKode = $lastKode ? 'R' . str_pad(((int) substr($lastKode->rumput_id, 1)) + 1, 3, '0', STR_PAD_LEFT) : 'R001';

        ModRumput::create([
            'rumput_id' => $newKode,
            'rumput_jenis' => $request->rumput_jenis,
            'rumput_berat_awal' => $request->rumput_berat_awal,
            'rumput_berat_hasil' => $request->rumput_berat_hasil ?? 0, // Jika tidak diinput, defaultnya 0
            'rumput_masuk' => $request->rumput_masuk,
            'rumput_keterangan' => $request->rumput_keterangan,
            'rumput_status' => $request->rumput_status,
            'created_id' => auth()->user()->id,
            'created_nama' => auth()->user()->name,
            'updated_id' => auth()->user()->id,
            'updated_nama' => auth()->user()->name,
        ]);

        return redirect()->route('index.rumput')->with('success', 'Rumput berhasil ditambahkan');
    }

    public function detail($id)
    {
        $rumput = ModRumput::with('jenisRumput')->findOrFail($id);
        return view('backend.wastukan.rumput.detail', compact('rumput'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rumput_berat_awal' => 'required|integer|max:1000',
            'rumput_berat_hasil' => 'nullable|integer|max:1000',
            'rumput_masuk' => 'required|date',
            'rumput_keterangan' => 'required|string|max:50',
            'rumput_status' => 'required|string|max:50',
        ]);
        $rumput = ModRumput::findOrFail($id);

        $rumput->rumput_berat_awal = $request->rumput_berat_awal;
        $rumput->rumput_berat_hasil = $request->rumput_berat_hasil;
        $rumput->rumput_masuk = $request->rumput_masuk;
        $rumput->rumput_keterangan = $request->rumput_keterangan;
        $rumput->rumput_status = $request->rumput_status;

        $rumput->updated_id = auth()->user()->id;
        $rumput->updated_nama = auth()->user()->name;
        $rumput->save();

        return redirect()->route('detail.rumput', $id)->with('success', 'Data rumput berhasil diperbarui');
    }

    public function destroy($id)
    {
        $rumput = ModRumput::findOrFail($id);
        $rumput->delete();
        return redirect()->route('index.rumput')->with('success', 'Data rumput berhasil dihapus');
    }
}
