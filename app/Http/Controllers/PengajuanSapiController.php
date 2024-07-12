<?php

namespace App\Http\Controllers;

use Dotenv\Util\Str;
use App\Models\ModJenisSapi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ModPengajuanSapi;
use App\Models\ModPembayaranSapi;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use App\Models\ModDetailPengajuanSapi;

class PengajuanSapiController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $pembeli = Auth::user()->pembeli;
        $PSapi = ModPengajuanSapi::with('user')
            ->where('belisapi_orang', $pembeli->pembeli_id)
            ->get();

        return view('backend.pembeli.pengajuan_sapi.index', compact('PSapi'));
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

        // Periksa apakah ada pengajuan yang belum diverifikasi oleh pengguna ini
        $existingPengajuan = ModPengajuanSapi::where('belisapi_orang', $request->belisapi_orang)
            ->where('belisapi_status', 'Belum Verifikasi')
            ->exists();

        if ($existingPengajuan) {
            return redirect()->back()->with('error', 'Anda sudah memiliki pengajuan yang belum diverifikasi oleh PPID. Harap tunggu keputusan sebelum mengajukan kembali.')->withInput();
        }

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
                'belisapi_status' => 'Sedang Diproses',
                'belisapi_keterangan' => 'Belum Ada',
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

            return redirect()->route('index.pengajuan.sapi')->with('success', 'Pengajuan berhasil diajukan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function detail($id)
    {
        $pengajuan = ModPengajuanSapi::with('details')->findOrFail($id);
        $sapiJenis = ModJenisSapi::all();
        $currentUser = auth()->user();
        $pembayaran = ModPembayaranSapi::where('dbeli_beli', $id)->first();

        return view('backend.pembeli.pengajuan_sapi.detail', compact('pengajuan', 'sapiJenis', 'currentUser', 'pembayaran'));
    }

    public function update(Request $request, $id)
    {
        $today = date('Y-m-d');
        $validated = $request->validate([
            'belisapi_orang' => 'required|string',
            'belisapi_nohp' => 'required|string',
            'belisapi_alamat' => 'required|string',
            'belisapi_surat' => 'file|mimes:jpeg,png,jpg,pdf|max:2048',
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

        DB::beginTransaction();

        try {
            $pengajuan = ModPengajuanSapi::findOrFail($id);

            // Update file jika ada file baru
            if ($request->hasFile('belisapi_surat')) {
                $file = $request->file('belisapi_surat');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $filename);
                $pengajuan->belisapi_surat = $filename;
            }

            // Update data pengajuan
            $pengajuan->belisapi_orang = $request->belisapi_orang;
            $pengajuan->belisapi_nohp = $request->belisapi_nohp;
            $pengajuan->belisapi_alamat = $request->belisapi_alamat;
            $pengajuan->belisapi_tanggal = $request->belisapi_tanggal;
            $pengajuan->belisapi_alasan = $request->belisapi_alasan;
            $pengajuan->save();

            // Hapus detail lama
            ModDetailPengajuanSapi::where('detail_pengajuan', $id)->delete();

            // Tambah detail baru
            foreach ($validated['detail_jenis'] as $key => $jenis) {
                $lastCode = ModDetailPengajuanSapi::orderBy('detail_id', 'desc')->first();
                $newCode = $lastCode ? 'DPS' . str_pad(((int) substr($lastCode->detail_id, 3)) + 1, 3, '0', STR_PAD_LEFT) : 'DPS001';

                ModDetailPengajuanSapi::create([
                    'detail_id' => $newCode,
                    'detail_pengajuan' => $id,
                    'detail_jenis' => $jenis,
                    'detail_kategori' => $validated['detail_kategori'][$key],
                    'detail_jumlah' => $validated['detail_jumlah'][$key],
                    'detail_kelamin' => $validated['detail_kelamin'][$key],
                ]);
            }

            DB::commit();

            return redirect()->route('index.pengajuan.sapi')->with('success', 'Pengajuan berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function delete()
    {
    }
    public function updatebayarsapi(Request $request, $dbeli_id)
    {
        $request->validate([
            'dbeli_sudah' => 'required|string',
            'dbeli_bukti' => 'required|file|mimes:png,jpg,jpeg,pdf',
        ]);

        $pembayaran = ModPembayaranSapi::findOrFail($dbeli_id);
        $file = $request->file('dbeli_bukti');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);


        // Update data pembayaran
        $pembayaran->update([
            'dbeli_sudah' => $request->dbeli_sudah,
            'dbeli_bukti' => $filename,
        ]);

        return redirect()->route('index.pengajuan.sapi')->with('success', 'Terima Kasih telah melakukan pembayaran, silahkan mendatangi kantor BPTU HPT Padang Mengatas untuk melakukan pengambilan Ternak');
    }
}
