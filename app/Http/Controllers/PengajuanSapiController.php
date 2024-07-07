<?php

namespace App\Http\Controllers;

use Dotenv\Util\Str;
use App\Models\ModJenisSapi;
use Illuminate\Http\Request;
use App\Models\ModPengajuanSapi;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\User;
use App\Models\ModDetailPengajuanSapi;
use Illuminate\Support\Facades\Validator;

class PengajuanSapiController extends Controller
{
    public function index()
    {
        return view('backend.pembeli.pengajuan_sapi.index');
    }
    public function show()
    {
        $users = User::all();
        $sapiJenis = ModJenisSapi::all();
        $currentUser = auth()->user();
        return view('backend.pembeli.pengajuan_sapi.tambah', compact('users', 'sapiJenis', 'currentUser'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $today = date('Y-m-d');
        $validated = $request->validate([
            'belisapi_orang' => 'required|string',
            'belisapi_nohp' => 'required|string',
            'belisapi_alamat' => 'required|string',
            'belisapi_surat' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'belisapi_tanggal' => 'required|date|after_or_equal:' . $today,
            'belisapi_alasan' => 'required|string',

            'detail_jenis' => 'required|array',
            'detail_jenis.*' => 'required|string|exists:master_sapi_jenis,sjenis_id',
            'detail_kategori' => 'required|array',
            'detail_kategori.*' => 'required|string',
            'detail_jumlah' => 'required|array',
            'detail_jumlah.*' => 'required|integer',
            'detail_kelamin' => 'required|array',
            'detail_kelamin.*' => 'required|string',
        ]);
        // dd($request->all());

        DB::beginTransaction();

        try {
            $lastKode = ModPengajuanSapi::orderBy('belisapi_id', 'desc')->first();
            $newKode = $lastKode ? 'PS' . str_pad(((int) substr($lastKode->belisapi_id, 2)) + 1, 3, '0', STR_PAD_LEFT) : 'PS001';

            // Upload file
            $file = $request->file('belisapi_surat');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);

            // Create ModPengajuanSapi
            $pengajuan = ModPengajuanSapi::create([
                'belisapi_id' => $newKode,
                'belisapi_orang' => $request->belisapi_orang,
                'belisapi_nohp' => $request->belisapi_nohp,
                'belisapi_alamat' => $request->belisapi_alamat,
                'belisapi_surat' => $filename,
                'belisapi_tanggal' => $request->belisapi_tanggal,
                'belisapi_alasan' => $request->belisapi_alasan,
                'belisapi_status' => 'Pending',
                'belisapi_keterangan' => 'belum ada',
            ]);

            foreach ($validated['detail_jenis'] as $key => $jenis) {
                $lastCode = ModDetailPengajuanSapi::orderBy('detail_id', 'desc')->first();
                $newCode = $lastCode ? 'DPS' . str_pad(((int) substr($lastCode->detail_id, 3)) + 1, 3, '0', STR_PAD_LEFT) : 'DPS001';

                ModDetailPengajuanSapi::create([
                    'detail_id' => $newCode,
                    'detail_pengajuan' => $newKode,
                    'detail_jenis' => $jenis,
                    'detail_kategori' => $validated['detail_kategori'][$key],
                    'detail_jumlah' => $validated['detail_jumlah'][$key],
                    'detail_kelamin' => $validated['detail_kelamin'][$key],
                ]);
            }

            DB::commit();

            return redirect()->route('home')->with('success', 'Pengajuan berhasil diajukan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
