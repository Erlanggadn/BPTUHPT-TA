<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Sapi;
use App\Models\SapiJual;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SapiJualController extends Controller
{
    public function index()
    {
        $sapiJuals = SapiJual::all();
        return view('backend.wasbitnak.sapi-jual.index', compact('sapiJuals'));
    }

    public function create()
    {
        $sapis = Sapi::whereNotIn('id', SapiJual::pluck('kode_sapi'))->get();
        return view('backend.wasbitnak.sapi-jual.tambah', compact('sapis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_sapi' => 'required|exists:sapi,id',
            'jenis_sapi' => 'required|string',
            'status' => 'required|in:Siap Jual,Belum Siap',
            'tgl_siap' => 'required|date',
        ]);

        SapiJual::create([
            'kode_sapi' => $request->kode_sapi,
            'jenis_sapi' => $request->jenis_sapi,
            'status' => $request->status,
            'tgl_siap' => $request->tgl_siap,
        ]);

        return redirect()->route('sapi-jual.index')->with('success', 'Data Sapi Siap Jual berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $sapiJual = SapiJual::find($id);
        $sapis = Sapi::whereNotIn('id', SapiJual::pluck('kode_sapi'))->orWhere('id', $sapiJual->kode_sapi)->get();
        return view('backend.wasbitnak.sapi-jual.edit', compact('sapiJual', 'sapis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_sapi' => 'required|exists:sapi,id',
            'jenis_sapi' => 'required|string',
            'status' => 'required|in:Siap Jual,Belum Siap',
            'tgl_siap' => 'required|date',
        ]);

        $sapiJual = SapiJual::find($id);

        $sapiJual->update([
            'kode_sapi' => $request->kode_sapi,
            'jenis_sapi' => $request->jenis_sapi,
            'status' => $request->status,
            'tgl_siap' => $request->tgl_siap,
        ]);

        return redirect()->route('sapi-jual.index')->with('success', 'Data Sapi Siap Jual berhasil diupdate.');
    }

    public function destroy($id)
    {
        $sapiJual = SapiJual::find($id);
        if ($sapiJual->foto_sapi != 'noimage.jpg') {
            Storage::delete('public/fotosapi/' . $sapiJual->foto_sapi);
        }
        $sapiJual->delete();
        return redirect()->route('sapi-jual.index')->with('success', 'Sapi Siap Jual berhasil dihapus');
    }
}
