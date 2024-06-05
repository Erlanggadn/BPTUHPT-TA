<?php

namespace App\Http\Controllers;

use App\Models\Sapi;
use Illuminate\Http\Request;

class SapiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $sapi = Sapi::all();
        return view('backend.keswan.index', ["sapi" => $sapi]); // Menampilkan view dengan data sapi
    }

    public function detailsapi($id)
    {
        $sapi = Sapi::where('id', $id)->get(); // Mengambil data berdasarkan id
        return view('backend.keswan.detail', ["sapi" => $sapi]);
    }

    public function printsapi($id)
    {
        $sapi = Sapi::where('id', $id)->get(); // Mengambil data berdasarkan id
        return view('backend.keswan.print', ["sapi" => $sapi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.keswan.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function store(Request $request)
    {
        // Validasi inputan di sini jika perlu

        // Ambil bulan dan tahun dari tanggal lahir
        $bulanTahun = date('mY', strtotime($request->tanggal_lahir));

        // Ubah jenis menjadi huruf kapital pertama
        $jenis = strtoupper(substr($request->jenis, 0, 1));

        // Format urutan lahir menjadi dua digit dengan leading zero jika perlu
        $urutan_lahir = str_pad($request->urutan_lahir, 2, '0', STR_PAD_LEFT);

        // Setel nilai default 'tidak ada' jika 'riwayat_penyakit' tidak diisi
        $riwayat_penyakit = $request->filled('riwayat_penyakit') ? $request->riwayat_penyakit : 'tidak ada';

        // Gabungkan semua komponen untuk membuat ID
        $id = $jenis . $urutan_lahir . $bulanTahun;

        // Simpan data sapi baru ke database
        $sapi = new Sapi;
        $sapi->id = $id; // Setel ID yang telah digenerate
        $sapi->jenis = $request->jenis;
        $sapi->urutan_lahir = $request->urutan_lahir;
        $sapi->tanggal_lahir = $request->tanggal_lahir;
        $sapi->no_induk = $request->no_induk;
        $sapi->riwayat_penyakit = $riwayat_penyakit;
        $sapi->save();

        return redirect()->route('keswan');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sapi  $sapi
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sapi  $sapi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sapi = Sapi::findOrFail($id);
        return view('backend.keswan.edit', compact('sapi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sapi  $sapi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi inputan di sini jika perlu

        // Temukan sapi berdasarkan ID
        $sapi = Sapi::findOrFail($id);

        // Update data sapi
        $sapi->no_induk = $request->no_induk;
        $sapi->riwayat_penyakit = $request->filled('riwayat_penyakit') ? $request->riwayat_penyakit : 'tidak ada';
        $sapi->save();

        return redirect()->route('detailsapi', $sapi->id)->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sapi  $sapi
     * @return \Illuminate\Http\Response
     */
    public function deletesapi($id)
    {
        $sapi = Sapi::findOrFail($id);
        $sapi->delete();

        return redirect()->route('keswan')->with('success', 'Akun berhasil dihapus');
    }
}
