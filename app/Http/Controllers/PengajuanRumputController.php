<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ModHargaRumput;
use App\Models\ModJenisRumput;
use App\Models\ModPengajuanRumput;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\ModPembayaranRumput;
use Illuminate\Support\Facades\Auth;
use App\Models\ModDetailPengajuanRumput;

class PengajuanRumputController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $pembeli = Auth::user()->pembeli;
        $PRumput = ModPengajuanRumput::with('pembeli')
            ->where('pembeli_id', $pembeli->pembeli_id)
            ->get();

        return view('backend.pembeli.pengajuan_rumput.index', compact('PRumput'));
    }
    public function show()
    {
        $users = User::all();
        $rumputJenis = ModJenisRumput::all();
        $currentUser = auth()->user();
        $hargaRumput = ModHargaRumput::all();

        // Check if the buyer already has an ongoing request
        $existingPengajuan = ModPengajuanRumput::where('pembeli_id', $currentUser->pembeli ? $currentUser->pembeli->pembeli_id : $currentUser->id)
            ->where('belirum_status', 'Sedang Diproses')
            ->exists();

        return view('backend.pembeli.pengajuan_rumput.tambah', compact('users', 'rumputJenis', 'currentUser', 'hargaRumput', 'existingPengajuan'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $today = date('Y-m-d');
        $validated = $request->validate([
            'pembeli_id' => 'required|string',
            'belirum_nohp' => 'required|string',
            'belirum_alamat' => 'required|string',
            'belirum_surat' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'belirum_tanggal' => 'required|date|after_or_equal:' . $today,
            'belirum_alasan' => 'required|string',

            'rum_id' => 'required|array',
            'rum_id.*' => 'required|string|exists:master_rumput_jenis,rum_id',
            'drumput_kategori' => 'required|array',
            'drumput_kategori.*' => 'required|string',
            'drumput_berat' => 'required|array',
            'drumput_berat.*' => 'required|integer',
            'drumput_satuan' => 'required|array',
            'drumput_satuan.*' => 'required|string',
        ]);

        // Periksa apakah ada pengajuan yang belum diverifikasi oleh pengguna ini
        $existingPengajuan = ModPengajuanRumput::where('pembeli_id', $request->pembeli_id)
            ->where('belirum_status', 'Belum Verifikasi')
            ->exists();

        if ($existingPengajuan) {
            return redirect()->back()->with('error', 'Anda sudah memiliki pengajuan yang belum diverifikasi oleh PPID. Harap tunggu keputusan sebelum mengajukan kembali.')->withInput();
        }

        DB::beginTransaction();

        try {
            $lastKode = ModPengajuanRumput::orderBy('belirum_id', 'desc')->first();
            $newKode = $lastKode ? 'PR' . str_pad(((int) substr($lastKode->belirum_id, 2)) + 1, 3, '0', STR_PAD_LEFT) : 'PR001';

            // Upload file
            $file = $request->file('belirum_surat');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);

            // Create ModPengajuanRumput
            $pengajuan = ModPengajuanRumput::create([
                'belirum_id' => $newKode,
                'pembeli_id' => $request->pembeli_id,
                'belirum_nohp' => $request->belirum_nohp,
                'belirum_alamat' => $request->belirum_alamat,
                'belirum_surat' => $filename,
                'belirum_tanggal' => $request->belirum_tanggal,
                'belirum_alasan' => $request->belirum_alasan,
                'belirum_status' => 'Sedang Diproses',
                'belirum_keterangan' => 'Belum Ada',
            ]);

            foreach ($validated['rum_id'] as $key => $jenis) {
                $lastCode = ModDetailPengajuanRumput::orderBy('drumput_id', 'desc')->first();
                $newCode = $lastCode ? 'DPR' . str_pad(((int) substr($lastCode->drumput_id, 3)) + 1, 3, '0', STR_PAD_LEFT) : 'DPR001';

                ModDetailPengajuanRumput::create([
                    'drumput_id' => $newCode,
                    'belirum_id' => $newKode,
                    'rum_id' => $jenis,
                    'drumput_kategori' => $validated['drumput_kategori'][$key],
                    'drumput_berat' => $validated['drumput_berat'][$key],
                    'drumput_satuan' => $validated['drumput_satuan'][$key],
                ]);
            }

            DB::commit();

            return redirect()->route('index.pengajuan.rumput')->with('success', 'Pengajuan berhasil diajukan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function detail($id)
    {
        $pengajuan = ModPengajuanRumput::with('detailPengajuanRumput')->findOrFail($id);
        $rumputJenis = ModJenisRumput::all();
        $currentUser = auth()->user();
        $pembayaran = ModPembayaranRumput::where('belirum_id', $id)->first();

        return view('backend.pembeli.pengajuan_rumput.detail', compact('pengajuan', 'rumputJenis', 'currentUser', 'pembayaran'));
    }
    public function updatebayarrumput(Request $request, $bayarrum_id)
    {
        $request->validate([
            'bayarrum_sudah' => 'required|string',
            'bayarrum_bukti' => 'required|file|mimes:png,jpg,jpeg,pdf',
        ]);

        $pembayaran = ModPembayaranRumput::findOrFail($bayarrum_id);
        $file = $request->file('bayarrum_bukti');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);


        // Update data pembayaran
        $pembayaran->update([
            'bayarrum_sudah' => $request->bayarrum_sudah,
            'bayarrum_bukti' => $filename,
        ]);

        return redirect()->route('index.pengajuan.rumput')->with('success', 'Terima Kasih telah melakukan pembayaran, silahkan mendatangi kantor BPTU HPT Padang Mengatas untuk melakukan pengambilan Pakan Ternak');
    }

    public function cetaksurat()
    {
        return view('backend.pembeli.surat.rumput');
    }

    public function print($id)
    {
        $pengajuan = ModPengajuanRumput::with('detailPengajuanRumput')->findOrFail($id);
        $rumputJenis = ModJenisRumput::all();
        $currentUser = auth()->user();
        $pembayaran = ModPembayaranRumput::where('belirum_id', $id)->first();

        return view('backend.pembeli.pengajuan_rumput.print', compact('pengajuan', 'rumputJenis', 'currentUser', 'pembayaran'));
    }
}
