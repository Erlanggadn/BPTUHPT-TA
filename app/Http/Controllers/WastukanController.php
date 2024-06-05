<?php

namespace App\Http\Controllers;

use App\Models\wastukan;
use App\Models\rumput;
use Illuminate\Http\Request;

class WastukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wastukan = wastukan::all();
        return view('backend.wastukan.index', ["wastukan"=>$wastukan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambahlogbook()
    {
        $rumputs = rumput::all();
        // dd($rumputs);
        // return view('backend.wastukan.kegiatan.tambah', compact('rumputs'));
        return view('backend.wastukan.kegiatan.tambah', ['rumputs' => $rumputs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storelogbook(Request $request)
    {
        $validated = $request->validate([
            'nomor_lahan' => 'required',
            'kode_pakan' => 'required|exists:rumputs,kode_rumput',
            'tanggal_tanam' => 'required|date',
            'tanggal_panen' => 'nullable|date',
            'kegiatan' => 'required',
            'berat' => 'required|numeric',
            'status' => 'required',
            'pesan' => 'nullable'
        ]);

        $tanggal_tanam = new \DateTime($request->tanggal_tanam);
        $id = $request->kode_pakan . $request->nomor_lahan . $tanggal_tanam->format('dm'); // 'dm' will give 'daymonth' e.g., 1405 for 14th May

        $validated['id'] = $id;

        if (empty($validated['pesan'])) {
            $validated['pesan'] = 'tidak ada';
        }

        wastukan::create($validated);
    
        return redirect()->route('wastukan')->with('success', 'Wastukan berhasil ditambahkan.');
    
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\wastukan  $wastukan
     * @return \Illuminate\Http\Response
     */
    public function detailwastukan($id)
    {
        $wastukan = wastukan::where('id',$id)->get(); // Mengambil data berdasarkan id
        return view('backend.wastukan.kegiatan.detail', ["wastukan"=>$wastukan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\wastukan  $wastukan
     * @return \Illuminate\Http\Response
     */
    public function editwastukan($id)
    {
        $wastukan = wastukan::findOrFail($id);
        $rumputs = rumput::all();
        return view('backend.wastukan.kegiatan.edit', compact('wastukan', 'rumputs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\wastukan  $wastukan
     * @return \Illuminate\Http\Response
     */
    public function updatewastukan(Request $request, $id)
    {
        $validated = $request->validate([
            'nomor_lahan' => 'required',
            'kode_pakan' => 'required|exists:rumputs,kode_rumput',
            'tanggal_tanam' => 'required|date',
            'tanggal_panen' => 'nullable|date',
            'kegiatan' => 'required',
            'berat' => 'required|numeric',
            'status' => 'required',
            'pesan' => 'nullable'
        ]);

        $wastukan = wastukan::findOrFail($id);

        // Set default value for 'pesan' if not provided
        if (empty($validated['pesan'])) {
            $validated['pesan'] = 'tidak ada';
        }

        $wastukan->update($validated);

        return redirect()->route('detailwastukan', ['id'=>$wastukan->id ])->with('success', 'Wastukan berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\wastukan  $wastukan
     * @return \Illuminate\Http\Response
     */
    public function deletewastukan($id)
    {
        $wastukan = wastukan::findOrFail($id);
        $wastukan->delete();

        return redirect()->route('wastukan')->with('success', 'Data berhasil dihapus');
    }
}
