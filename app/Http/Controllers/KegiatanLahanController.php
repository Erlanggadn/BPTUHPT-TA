<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModKegiatanLahan;
use App\Models\ModRumput;
use App\Models\ModJenisLahan;
use Illuminate\Support\Facades\Validator;

class KegiatanLahanController extends Controller
{
    public function index()
    {
        $kegiatanLahan = ModKegiatanLahan::all();
        return view('backend.wastukan.kegiatan.index', compact('kegiatanLahan'));
    }

    public function show()
    {
        $jenisRumput = ModRumput::where('rumput_status', 'Bibit')->get();
        $jenisLahan = ModJenisLahan::all();
        return view('backend.wastukan.kegiatan.create', compact('jenisRumput', 'jenisLahan'));
    }

    public function store(Request $request)
    {
        $today = date('Y-m-d');
        $validator = Validator::make($request->all(), [
            'tanam_detail_rumput' => 'required|string|max:255',
            'tanam_detail_lahan' => 'required|string|max:255',
            'tanam_tanggal' => 'required|date|after_or_equal:' . $today,
            'tanam_jam_mulai' => 'required|date_format:H:i',
            'tanam_jam_selesai' => 'required|date_format:H:i|after:tanam_jam_mulai',
            'tanam_kegiatan' => 'required|string|max:255',
            'tanam_status' => 'required|string|max:255',
            'tanam_foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $existingKegiatan = ModKegiatanLahan::where('tanam_detail_lahan', $request->tanam_detail_lahan)
            ->where('tanam_tanggal', $request->tanam_tanggal)
            ->where(function ($query) use ($request) {
                $query->whereBetween('tanam_jam_mulai', [$request->tanam_jam_mulai, $request->tanam_jam_selesai])
                    ->orWhereBetween('tanam_jam_selesai', [$request->tanam_jam_mulai, $request->tanam_jam_selesai])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('tanam_jam_mulai', '<=', $request->tanam_jam_mulai)
                            ->where('tanam_jam_selesai', '>=', $request->tanam_jam_selesai);
                    });
            })
            ->first();

        if ($existingKegiatan) {
            return redirect()->back()->with('error', 'Kegiatan dengan waktu yang sama sudah ada di lahan ini pada tanggal yang dipilih.')->withInput();
        }

        $file = $request->file('tanam_foto');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);

        $lastKode = ModKegiatanLahan::orderBy('tanam_id', 'desc')->first();
        $newKode = $lastKode ? 'KL' . str_pad(((int) substr($lastKode->tanam_id, 2)) + 1, 3, '0', STR_PAD_LEFT) : 'KL001';

        ModKegiatanLahan::create([
            'tanam_id' => $newKode,
            'tanam_detail_rumput' => $request->tanam_detail_rumput,
            'tanam_detail_lahan' => $request->tanam_detail_lahan,
            'tanam_tanggal' => $request->tanam_tanggal,
            'tanam_jam_mulai' => $request->tanam_jam_mulai,
            'tanam_jam_selesai' => $request->tanam_jam_selesai,
            'tanam_kegiatan' => $request->tanam_kegiatan,
            'tanam_status' => $request->tanam_status,
            'tanam_foto' => $filename,
            'created_id' => auth()->user()->id,
            'created_nama' => auth()->user()->name,
            'updated_id' => auth()->user()->id,
            'updated_nama' => auth()->user()->name,
        ]);

        return redirect()->route('index.tanam')->with('success', 'Kegiatan lahan berhasil ditambahkan.');
    }

    public function detail($id)
    {
        $kegiatan = ModKegiatanLahan::findOrFail($id);
        $jenisRumput = ModRumput::where('rumput_status', 'Bibit')->get();
        $jenisLahan = ModJenisLahan::all();

        return view('backend.wastukan.kegiatan.detail', compact('kegiatan', 'jenisRumput', 'jenisLahan'));
    }

    public function update(Request $request, $id)
    {
        $today = date('Y-m-d');
        $validator = Validator::make($request->all(), [
            'tanam_kegiatan' => 'required|string|max:255',
            'tanam_status' => 'required|string|max:255',
            'tanam_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kegiatan = ModKegiatanLahan::findOrFail($id);

        if ($request->hasFile('tanam_foto')) {
            $file = $request->file('tanam_foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $kegiatan->tanam_foto = $filename;
        }

        $kegiatan->update([
            'tanam_kegiatan' => $request->tanam_kegiatan,
            'tanam_status' => $request->tanam_status,
            'updated_id' => auth()->user()->id,
            'updated_nama' => auth()->user()->name,
        ]);

        return redirect()->route('index.tanam')->with('success', 'Kegiatan lahan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kegiatanLahan = ModKegiatanLahan::findOrFail($id);
        $kegiatanLahan->delete();

        return redirect()->route('index.tanam')->with('success', 'Data berhasil dihapus');
    }
}
