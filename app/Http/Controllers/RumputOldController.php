<?php

namespace App\Http\Controllers;

use App\Models\rumput;
use Illuminate\Http\Request;

class RumputOldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response    
     */
    public function index()
    {
        $rumput = rumput::all();
        return view('backend.wastukan.jenis.index_jenis', ["rumput" => $rumput]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambahjenis()
    {
        $rumput = rumput::all();
        return view('backend.wastukan.jenis.tambah_jenis', ["rumput" => $rumput]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postjenis(Request $request)
    {
        $request->validate([
            'jenis_rumput' => 'required|string|max:255',
            'kode_rumput' => 'required|string|max:255',
            'deskripsi_rumput' => 'nullable|string'
        ]);

        $latest = Rumput::latest('id')->first();
        if ($latest) {
            $number = (int) substr($latest->id, 1) + 1;
            $id = 'R' . str_pad($number, 3, '0', STR_PAD_LEFT);
        } else {
            $id = 'R001';
        }

        Rumput::create([
            'id' => $id,
            'jenis_rumput' => $request->jenis_rumput,
            'kode_rumput' => $request->kode_rumput,
            'deskripsi_rumput' => $request->deskripsi_rumput ?? 'tidak ada'
        ]);

        return redirect()->route('indexrumput')->with('success', 'Jenis rumput berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\rumput  $rumput
     * @return \Illuminate\Http\Response
     */
    public function detailjenis($id)
    {
        $rumput = rumput::where('id', $id)->get(); // Mengambil data berdasarkan id
        return view('backend.wastukan.jenis.detail_jenis', ["rumput" => $rumput]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\rumput  $rumput
     * @return \Illuminate\Http\Response
     */
    public function editjenis($id)
    {
        $rumput = rumput::findOrFail($id);
        return view('backend.wastukan.jenis.edit_jenis', compact('rumput'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\rumput  $rumput
     * @return \Illuminate\Http\Response
     */
    public function updatejenis(Request $request, $id)
    {
        $rumput = rumput::findOrFail($id);

        // Update data rumput
        $rumput->jenis_rumput = $request->jenis_rumput;
        $rumput->kode_rumput = $request->kode_rumput;
        $rumput->deskripsi_rumput = $request->filled('deskripsi_rumput') ? $request->deskripsi_rumput : 'tidak ada';
        $rumput->save();

        return redirect()->route('detailjenis', $rumput->id)->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\rumput  $rumput
     * @return \Illuminate\Http\Response
     */
    public function deletejenis($id)
    {
        $rumput = rumput::findOrFail($id);
        $rumput->delete();

        return redirect()->route('indexrumput')->with('success', 'Data berhasil dihapus');
    }
}
