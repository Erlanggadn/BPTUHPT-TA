<?php

namespace App\Http\Controllers;

use App\Models\Sapi;
use App\Models\KegiatanSapi;
use Illuminate\Http\Request;

class KegiatanSapiController extends Controller
{
    public function getsapi($id_kegiatan)
    {
        // Ambil sapi yang belum ada di kegiatan apapun
        $sapiIdsInKegiatan = KegiatanSapi::pluck('kode_sapi')->toArray();
        $sapis = Sapi::whereNotIn('id', $sapiIdsInKegiatan)->get();

        return view('backend.wasbitnak.kegiatan.tambah-sapi', compact('sapis', 'id_kegiatan'));
    }

    public function tambahSapi(Request $request, $id_kegiatan)
    {
        // dd($request->all()); // Debugging line
        $request->validate([
            'kode_sapi' => 'required|array',
            'kode_sapi.*' => 'required|exists:sapi,id',
        ]);

        foreach ($request->kode_sapi as $kodeSapi) {
            KegiatanSapi::create([
                'id_kegiatan' => $id_kegiatan,
                'kode_sapi' => $kodeSapi,
            ]);
        }

        return redirect()->route('detailkegiatan', $id_kegiatan)->with('success', 'Sapi berhasil ditambahkan ke kegiatan.');
    }
}
