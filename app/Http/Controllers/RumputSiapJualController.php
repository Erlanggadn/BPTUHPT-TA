<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RumputSiapJual;
use App\Models\Wastukan;

class RumputSiapJualController extends Controller
{

    public function index()
    {
        $rumputsi = RumputSiapJual::all();
        return view('backend.wastukan.jual.index', ["rumputsi"=>$rumputsi]);
    }

    public function create()
    {
        // Ambil semua id_wastukan yang sudah ada di tabel rumput_siap_jual
        $rumputSiapJual = RumputSiapJual::pluck('id_wastukan')->toArray();
        
        // Ambil semua wastukans yang id-nya tidak ada di dalam daftar rumputSiapJual
        $wastukans = Wastukan::whereNotIn('id', $rumputSiapJual)->get();
        
        return view('backend.wastukan.jual.tambah', compact('wastukans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_wastukan' => 'required|exists:wastukans,id',
            'tanggal' => 'required|date',
            'status' => 'required|in:Siap Jual,Siap Pakan',
        ]);

        $lastRumput = RumputSiapJual::orderBy('id', 'desc')->first();
        $lastId = $lastRumput ? intval(substr($lastRumput->id, 1)) : 0;
        $newId = 'J' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);

        $validated['id'] = $newId;

        RumputSiapJual::create($validated);

        return redirect()->route('indexrumputsiap')->with('success', 'Rumput siap jual berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $rumputsi = RumputSiapJual::findOrFail($id);
        return view('backend.wastukan.jual.edit', compact('rumputsi'));
    }

    public function update(Request $request,$id)
    {
        $validated = $request->validate([
            'status' => 'required|in:Siap Jual,Siap Pakan',
        ]);

        $rumputsi = RumputSiapJual::findOrFail($id);
        $rumputsi->update($validated);

        return redirect()->route('indexrumputsiap')->with('success', 'Status rumput siap jual berhasil diperbarui.');
    }
    

    public function delete($id)
    {
        $rumputsi = RumputSiapJual::findOrFail($id);
        $rumputsi->delete();

        return redirect()->route('indexrumputsiap')->with('success', 'Data berhasil dihapus');
    }

    

    

    
}
