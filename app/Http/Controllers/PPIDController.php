<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ModSapi;
use App\Models\ModRumput;
use App\Models\ModJenisSapi;
use Illuminate\Http\Request;
use App\Models\ModJenisRumput;
use Illuminate\Support\Carbon;
use App\Models\ModPengajuanSapi;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\ModDetailPengajuanSapi;
use App\Models\ModPembeli;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PPIDController extends Controller
{
    //DAFTAR PEMBELI
    public function daftarpembeli()
    {
        $akunuser = User::with('pembeli')
            ->whereNotIn('role', ['admin', 'ppid', 'wastukan', 'wasbitnak', 'kepala', 'keswan', 'bendahara'])
            ->get();
        $jumlahPembeli = $akunuser->count();
        return view('backend.ppid.daftar_pembeli.index', ['akunuser' => $akunuser, 'jumlahPembeli' => $jumlahPembeli]);
    }
    public function detailPembeli($id)
    {
        $akunuser = User::with('pembeli')->where('id', $id)->first();
        return view('backend.ppid.daftar_pembeli.detail', ["akunuser" => $akunuser, "pembeli" => $akunuser->pembeli]);
    }
    public function updatePembeli(Request $request, $id)
    {
        $akunuser = User::with('pembeli')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'pembeli_instansi' => 'required|string',
            'pembeli_nama' => 'required|string',
            'pembeli_alamat' => 'required|string',
            'pembeli_nohp' => 'required',
            'pembeli_lahir' => 'required|date',
        ]);
        // dd($request->all());

        if ($akunuser->pembeli) {
            $akunuser->pembeli->update($request->only('pembeli_instansi', 'pembeli_nama', 'pembeli_alamat', 'pembeli_nohp', 'pembeli_lahir'));
        }

        return redirect()->route('detail.ppid.pembeli', $akunuser->id)->with('berhasil.edit', 'Akun berhasil diperbarui');
    }
    public function deletepembeli($id)
    {
        $akunuser = User::findOrFail($id);
        $akunuser->delete();

        return redirect()->route('index.daftar.pembeli')->with('berhasil.hapus', 'Akun berhasil dihapus');
    }

    //SAPI SIAP JUAL
    public function indexsapijual()
    {
        $Sapi = ModSapi::with('jenisSapi')
            ->whereIn('sapi_status', ['Siap Jual', 'terjual'])
            ->get();

        $jenisList = ModJenisSapi::all();
        return view('backend.ppid.sapi_jual.index', compact('Sapi', 'jenisList'));
    }
    public function detailsapijual($id)
    {
        $sapi = ModSapi::with('jenisSapi')->findOrFail($id);
        return view('backend.ppid.sapi_jual.detail', compact('sapi'));
    }
    public function updatesapijual(Request $request, $id)
    {
        $request->validate([
            'sapi_keterangan' => 'required|string|max:255',
            'sapi_status' => 'required|string|max:255', // Tambahkan validasi status
        ]);

        $sapi = ModSapi::findOrFail($id);
        $sapi->sapi_keterangan = $request->sapi_keterangan;
        $sapi->sapi_status = $request->sapi_status;
        $sapi->sapi_umur = Carbon::parse($sapi->sapi_tanggal_lahir)->diffInMonths(Carbon::now());
        $sapi->updated_id = auth()->user()->id;
        $sapi->updated_nama = auth()->user()->name;
        $sapi->save();

        return redirect()->route('detail.ppid.sapi', $id)->with('success', 'Data sapi berhasil diperbarui');
    }
    public function deletesapijual($id)
    {
        $sapi = ModSapi::findOrFail($id);
        $sapi->delete();
        return redirect()->route('index.sapi')->with('success', 'Data sapi berhasil dihapus');
    }
    public function exportsapijual(Request $request)
    {
        $jenisSapi = $request->input('jenis_sapi');


        $sapi = ModSapi::with('jenisSapi')
            ->when($jenisSapi, function ($query, $jenisSapi) {
                return $query->whereHas('jenisSapi', function ($query) use ($jenisSapi) {
                    $query->where('sjenis_id', $jenisSapi);
                });
            })
            ->get();


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();


        $sheet->setCellValue('A1', 'ID/Kode Sapi');
        $sheet->setCellValue('B1', 'Jenis Sapi');
        $sheet->setCellValue('C1', 'Tanggal Lahir');
        $sheet->setCellValue('D1', 'No Induk');
        $sheet->setCellValue('E1', 'Umur');
        $sheet->setCellValue('F1', 'Jenis Kelamin');

        $row = 2;
        foreach ($sapi as $item) {
            $sheet->setCellValue('A' . $row, $item->sapi_id);
            $sheet->setCellValue('B' . $row, $item->jenisSapi->sjenis_nama);
            $sheet->setCellValue('C' . $row, $item->sapi_tanggal_lahir);
            $sheet->setCellValue('D' . $row, $item->sapi_no_induk);
            $sheet->setCellValue('E' . $row, (string)$item->sapi_umur);
            $sheet->setCellValue('F' . $row, $item->sapi_kelamin);
            $row++;
        }


        $writer = new Xlsx($spreadsheet);
        $fileName = 'data_sapi.xlsx';
        $filePath = public_path($fileName);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
    public function filtersapijual(Request $request)
    {
        $jenisSapi = $request->input('jenis_sapi');
        $bulanLahir = $request->input('bulan_lahir');
        $tahunLahir = $request->input('tahun_lahir'); // Ambil input tahun lahir

        $Sapi = ModSapi::with('jenisSapi')
            ->when($jenisSapi, function ($query, $jenisSapi) {
                return $query->whereHas('jenisSapi', function ($query) use ($jenisSapi) {
                    $query->where('sjenis_id', $jenisSapi);
                });
            })
            ->when($bulanLahir, function ($query, $bulanLahir) {
                return $query->whereMonth('sapi_tanggal_lahir', $bulanLahir);
            })
            ->when($tahunLahir, function ($query, $tahunLahir) { // Tambahkan kondisi untuk tahun lahir
                return $query->whereYear('sapi_tanggal_lahir', $tahunLahir);
            })
            ->get();

        $jenisList = ModJenisSapi::all();
        return view('backend.ppid.sapi_jual.index', compact('Sapi', 'jenisList'));
    }

    //RUMPUT SIAP JUAL
    public function indexrumputjual()
    {
        $Rumput = ModRumput::with('jenisRumput')
            ->where('rumput_status', 'siap jual')
            ->get();
        $jenisList = ModJenisRumput::all();
        return view('backend.ppid.rumput_jual.index', compact('Rumput', 'jenisList'));
    }
    public function detailrumputjual($id)
    {
        $rumput = ModRumput::with('jenisRumput')->findOrFail($id);
        return view('backend.ppid.rumput_jual.detail', compact('rumput'));
    }
    public function updaterumputjual(Request $request, $id)
    {
        $request->validate([
            'rumput_berat_hasil' => 'nullable|integer|max:1000',
            'rumput_keterangan' => 'required|string|max:50',
            'rumput_status' => 'required|string|max:50',
        ]);
        $rumput = ModRumput::findOrFail($id);

        $rumput->rumput_berat_hasil = $request->rumput_berat_hasil;
        $rumput->rumput_keterangan = $request->rumput_keterangan;
        $rumput->rumput_status = $request->rumput_status;

        $rumput->updated_id = auth()->user()->id;
        $rumput->updated_nama = auth()->user()->name;
        $rumput->save();

        return redirect()->route('detail.ppid.rumput', $id)->with('success', 'Data rumput berhasil diperbarui');
    }
    public function deleterumputjual($id)
    {
        $rumput = ModRumput::findOrFail($id);
        $rumput->delete();
        return redirect()->route('index.ppid.rumput')->with('success', 'Data rumput berhasil dihapus');
    }

    //PENGAJUAN SAPI
    public function indexpengajuansapi()
    {
        $PSapi = ModPengajuanSapi::with('user')->get();
        return view('backend.ppid.pengajuan-sapi.index', compact('PSapi'));
    }

    public function detailpengajuansapi($id)
    {
        $pengajuan = ModPengajuanSapi::with('details')->findOrFail($id);
        $sapiJenis = ModJenisSapi::all();
        $currentUser = ModPembeli::all();

        return view('backend.ppid.pengajuan-sapi.detail', compact('pengajuan', 'sapiJenis', 'currentUser'));
    }
    public function updatepengajuansapi(Request $request, $id)
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

    public function deletepengajuansapi($id)
    {
        DB::beginTransaction();

        try {
            // Hapus detail pengajuan terlebih dahulu
            ModDetailPengajuanSapi::where('detail_pengajuan', $id)->delete();

            // Hapus pengajuan
            $pengajuan = ModPengajuanSapi::findOrFail($id);
            $pengajuan->delete();

            DB::commit();

            return redirect()->route('index.ppid.psapi')->with('success', 'Pengajuan berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
