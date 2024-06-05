<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisKandang;

class JenisKandangController extends Controller
{
    public function index()
    {
        $jenisKandang = JenisKandang::all();
        return view('backend.wasbitnak.jenis.index', compact('jenisKandang'));
    }

    public function create()
    {
        return view('backend.wasbitnak.jenis.tambah');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_kandang' => 'required|integer|unique:jenis_kandang',
            'jenis_kandang' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        $noKandang = $validated['no_kandang'];
        $idKandang = 'K' . str_pad($noKandang, 3, '0', STR_PAD_LEFT);

        JenisKandang::create([
            'id_kandang' => $idKandang,
            'no_kandang' => $noKandang,
            'jenis_kandang' => $validated['jenis_kandang'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('wasbitnak')->with('success', 'Jenis kandang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jenisKandang = JenisKandang::findOrFail($id);
        return view('backend.wasbitnak.jenis.edit', compact('jenisKandang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:255',
        ]);

        $jenisKandang = JenisKandang::findOrFail($id);
        $jenisKandang->update([
            'status' => $request->status,
        ]);

        return redirect()->route('wasbitnak')->with('success', 'Status jenis kandang berhasil diupdate.');
    }


    public function delete($id)
    {
        $jenisKandang = JenisKandang::findOrFail($id);
        $jenisKandang->delete();

        return redirect()->route('indexwasbitnak')->with('success', 'Data berhasil dihapus');
    }
}
