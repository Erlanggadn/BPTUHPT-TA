<?php

namespace App\Http\Controllers;

use App\Models\ModRumput;
use Illuminate\Http\Request;
use App\Models\ModJenisLahan;
use App\Models\ModKegiatanLahan;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user();
        return view('backend.wastukan.kegiatan.create', compact('jenisRumput', 'jenisLahan', 'user'));
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
    
        // Validasi konflik jadwal
        $conflict = ModKegiatanLahan::where('tanam_detail_lahan', $request->tanam_detail_lahan)
            ->where('tanam_tanggal', $request->tanam_tanggal)
            ->where(function ($query) use ($request) {
                $query->whereBetween('tanam_jam_mulai', [$request->tanam_jam_mulai, $request->tanam_jam_selesai])
                    ->orWhereBetween('tanam_jam_selesai', [$request->tanam_jam_mulai, $request->tanam_jam_selesai])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('tanam_jam_mulai', '<=', $request->tanam_jam_mulai)
                            ->where('tanam_jam_selesai', '>=', $request->tanam_jam_selesai);
                    });
            })
            ->exists();
    
        if ($conflict) {
            return redirect()->back()->with('error', 'Kegiatan dengan waktu yang sama sudah ada di lahan ini pada tanggal yang dipilih.')->withInput();
        }
    
        $file = $request->file('tanam_foto');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);
    
        $lastKode = ModKegiatanLahan::orderBy('tanam_id', 'desc')->first();
        $newKode = $lastKode ? 'KL' . str_pad(((int) substr($lastKode->tanam_id, 2)) + 1, 3, '0', STR_PAD_LEFT) : 'KL001';
    
        $user = Auth::user();
        $pegawai = $user->pegawai;
    
        ModKegiatanLahan::create([
            'tanam_id' => $newKode,
            'tanam_orang' => $pegawai ? $pegawai->pegawai_id : null,
            'tanam_detail_rumput' => $request->tanam_detail_rumput,
            'tanam_detail_lahan' => $request->tanam_detail_lahan,
            'tanam_tanggal' => $request->tanam_tanggal,
            'tanam_jam_mulai' => $request->tanam_jam_mulai,
            'tanam_jam_selesai' => $request->tanam_jam_selesai,
            'tanam_kegiatan' => $request->tanam_kegiatan,
            'tanam_status' => $request->tanam_status,
            'tanam_foto' => $filename,
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
        $validator = Validator::make($request->all(), [
            'tanam_detail_rumput' => 'required|string|max:255',
            'tanam_detail_lahan' => 'required|string|max:255',
            'tanam_tanggal' => 'required|date',
            'tanam_jam_mulai' => 'required|date_format:H:i',
            'tanam_jam_selesai' => 'required|date_format:H:i|after:tanam_jam_mulai',
            'tanam_kegiatan' => 'required|string|max:255',
            'tanam_status' => 'required|string|max:255',
            'tanam_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $kegiatan = ModKegiatanLahan::findOrFail($id);
    
        // Validasi konflik jadwal
        $conflict = ModKegiatanLahan::where('tanam_detail_lahan', $request->tanam_detail_lahan)
            ->where('tanam_tanggal', $request->tanam_tanggal)
            ->where('tanam_id', '!=', $id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('tanam_jam_mulai', [$request->tanam_jam_mulai, $request->tanam_jam_selesai])
                    ->orWhereBetween('tanam_jam_selesai', [$request->tanam_jam_mulai, $request->tanam_jam_selesai])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('tanam_jam_mulai', '<=', $request->tanam_jam_mulai)
                            ->where('tanam_jam_selesai', '>=', $request->tanam_jam_selesai);
                    });
            })
            ->exists();
    
        if ($conflict) {
            return redirect()->back()->with('error', 'Kegiatan dengan waktu yang sama sudah ada di lahan ini pada tanggal yang dipilih.')->withInput();
        }
    
        if ($request->hasFile('tanam_foto')) {
            $file = $request->file('tanam_foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $kegiatan->tanam_foto = $filename;
        }
    
        $kegiatan->update([
            'tanam_detail_rumput' => $request->tanam_detail_rumput,
            'tanam_detail_lahan' => $request->tanam_detail_lahan,
            'tanam_tanggal' => $request->tanam_tanggal,
            'tanam_jam_mulai' => $request->tanam_jam_mulai,
            'tanam_jam_selesai' => $request->tanam_jam_selesai,
            'tanam_kegiatan' => $request->tanam_kegiatan,
            'tanam_status' => $request->tanam_status,
        ]);
    
        return redirect()->route('index.tanam')->with('success', 'Kegiatan lahan berhasil diperbarui.');
    }
}
