<?php

namespace App\Http\Controllers;

use Dotenv\Util\Str;
use App\Models\ModSapi;
use App\Models\ModKandang;
use Illuminate\Http\Request;
use App\Models\ModKegiatanKandang;
use Illuminate\Routing\Controller;
use App\Models\ModDetailKandangSapi;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class KegiatanKandangController extends Controller
{
    public function index()
    {
        $Kegiatan = ModKegiatanKandang::all();
        return view('backend.wasbitnak.kegiatan_kandang.index', compact('Kegiatan'));
    }

    public function show()
    {
        $jenisKandang = ModKandang::all();
        $sapis = ModSapi::all();
        $user = Auth::user();

        return view('backend.wasbitnak.kegiatan_kandang.create', compact('sapis', 'jenisKandang', 'user'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kegiatan_jenis_kandang' => 'required|string',
            'kegiatan_tanggal' => 'required|date',
            'kegiatan_jam_mulai' => 'required',
            'kegiatan_jam_selesai' => 'required',
            'kegiatan_keterangan' => 'required|string',
            'kegiatan_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kegiatan_status' => 'required|string',
            'kode_sapi' => 'required|array',
            'kode_sapi.*' => 'required|string|exists:master_sapi,sapi_id',
        ]);

        $conflict = ModKegiatanKandang::where('kegiatan_jenis_kandang', $request->kegiatan_jenis_kandang)
            ->where('kegiatan_tanggal', $request->kegiatan_tanggal)
            ->where(function ($query) use ($request) {
                $query->whereBetween('kegiatan_jam_mulai', [$request->kegiatan_jam_mulai, $request->kegiatan_jam_selesai])
                    ->orWhereBetween('kegiatan_jam_selesai', [$request->kegiatan_jam_mulai, $request->kegiatan_jam_selesai])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('kegiatan_jam_mulai', '<', $request->kegiatan_jam_mulai)
                            ->where('kegiatan_jam_selesai', '>', $request->kegiatan_jam_selesai);
                    });
            })
            ->exists();

        if ($conflict) {
            return redirect()->back()->withErrors(['error' => 'Jadwal kegiatan yang sama dengan kegiatan lain di kandang yang sama pada hari dan jam tersebut.'])->withInput();
        }

        $lastKode = ModKegiatanKandang::orderBy('kegiatan_id', 'desc')->first();
        $newKode = $lastKode ? 'A' . str_pad(((int) substr($lastKode->kegiatan_id, 2)) + 1, 3, '0', STR_PAD_LEFT) : 'A001';

        $user = Auth::user();
        $pegawai = $user->pegawai;

        $kegiatan = ModKegiatanKandang::create([
            'kegiatan_id' => $newKode,
            'kegiatan_jenis_kandang' => $request->kegiatan_jenis_kandang,
            'kegiatan_tanggal' => $request->kegiatan_tanggal,
            'kegiatan_orang' => $pegawai ? $pegawai->pegawai_id : null,
            'kegiatan_jam_mulai' => $request->kegiatan_jam_mulai,
            'kegiatan_jam_selesai' => $request->kegiatan_jam_selesai,
            'kegiatan_keterangan' => $request->kegiatan_keterangan,
            'kegiatan_status' => $request->kegiatan_status,
            'kegiatan_foto' => $request->file('kegiatan_foto') ? $request->file('kegiatan_foto')->store('kegiatan_fotos', 'public') : null,
        ]);

        foreach ($validated['kode_sapi'] as $sapi_id) {
            $lastId = ModDetailKandangSapi::orderBy('detail_id', 'desc')->first();
            $newId = $lastId ? 'DT' . str_pad(((int) substr($lastId->detail_id, 2)) + 1, 3, '0', STR_PAD_LEFT) : 'DT001';
            ModDetailKandangSapi::create([
                'detail_id' => $newId,
                'detail_kandang' => $kegiatan->kegiatan_id,
                'detail_sapi' => $sapi_id,
            ]);
        }

        return redirect()->route('index.kegiatan.kandang')->with('success', 'Kegiatan berhasil ditambahkan!');
    }
    public function detail($kegiatan_id)
    {
        $kegiatan = ModKegiatanKandang::findOrFail($kegiatan_id);
        $jenisKandang = ModKandang::all();
        $sapis = ModSapi::all();
        $selectedSapi = ModDetailKandangSapi::where('detail_kandang', $kegiatan_id)->pluck('detail_sapi')->toArray();

        return view('backend.wasbitnak.kegiatan_kandang.detail', compact('kegiatan', 'jenisKandang', 'sapis', 'selectedSapi'));
    }

    public function update(Request $request, $kegiatan_id)
    {
        $kegiatan = ModKegiatanKandang::findOrFail($kegiatan_id);

        $validated = $request->validate([
            'kegiatan_jenis_kandang' => 'required|string',
            'kegiatan_tanggal' => 'required|date',
            'kegiatan_jam_mulai' => 'required',
            'kegiatan_jam_selesai' => 'required',
            'kegiatan_keterangan' => 'required|string',
            'kegiatan_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kegiatan_status' => 'required|string',
            'kode_sapi' => 'required|array',
            'kode_sapi.*' => 'required|string|exists:master_sapi,sapi_id',
        ]);

        $conflict = ModKegiatanKandang::where('kegiatan_jenis_kandang', $request->kegiatan_jenis_kandang)
            ->where('kegiatan_tanggal', $request->kegiatan_tanggal)
            ->where('kegiatan_id', '!=', $kegiatan_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('kegiatan_jam_mulai', [$request->kegiatan_jam_mulai, $request->kegiatan_jam_selesai])
                    ->orWhereBetween('kegiatan_jam_selesai', [$request->kegiatan_jam_mulai, $request->kegiatan_jam_selesai])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('kegiatan_jam_mulai', '<', $request->kegiatan_jam_mulai)
                            ->where('kegiatan_jam_selesai', '>', $request->kegiatan_jam_selesai);
                    });
            })
            ->exists();

        if ($conflict) {
            return redirect()->back()->withErrors(['error' => 'Jadwal kegiatan konflik dengan kegiatan lain di kandang yang sama pada hari dan jam tersebut.'])->withInput();
        }

        $kegiatan->update([
            'kegiatan_jenis_kandang' => $request->kegiatan_jenis_kandang,
            'kegiatan_tanggal' => $request->kegiatan_tanggal,
            'kegiatan_jam_mulai' => $request->kegiatan_jam_mulai,
            'kegiatan_jam_selesai' => $request->kegiatan_jam_selesai,
            'kegiatan_keterangan' => $request->kegiatan_keterangan,
            'kegiatan_status' => $request->kegiatan_status,
            'kegiatan_foto' => $request->hasFile('kegiatan_foto') ? $request->file('kegiatan_foto')->store('kegiatan_fotos', 'public') : $kegiatan->kegiatan_foto,
        ]);

        ModDetailKandangSapi::where('detail_kandang', $kegiatan->kegiatan_id)->delete();

        foreach ($validated['kode_sapi'] as $sapi_id) {
            $lastId = ModDetailKandangSapi::orderBy('detail_id', 'desc')->first();
            $newId = $lastId ? 'DT' . str_pad(((int) substr($lastId->detail_id, 2)) + 1, 3, '0', STR_PAD_LEFT) : 'DT001';
            ModDetailKandangSapi::create([
                'detail_id' => $newId,
                'detail_kandang' => $kegiatan->kegiatan_id,
                'detail_sapi' => $sapi_id,
            ]);
        }

        return redirect()->route('index.kegiatan.kandang')->with('success', 'Kegiatan berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $kegiatanKandang = ModKegiatanKandang::findOrFail($id);
        $kegiatanKandang->delete();

        return redirect()->route('index.kegiatan.kandang')->with('success', 'Data berhasil dihapus');
    }
    public function export(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $kegiatan = ModKegiatanKandang::with('kandang.jenisKandang')
            ->when($startDate, function ($query, $startDate) {
                return $query->whereDate('kegiatan_tanggal', '>=', $startDate);
            })
            ->when($endDate, function ($query, $endDate) {
                return $query->whereDate('kegiatan_tanggal', '<=', $endDate);
            })
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID/Kode Kegiatan');
        $sheet->setCellValue('B1', 'Pegawai');
        $sheet->setCellValue('C1', 'Kode Kandang');
        $sheet->setCellValue('D1', 'Tanggal Kegiatan');
        $sheet->setCellValue('E1', 'Jam Mulai');
        $sheet->setCellValue('F1', 'Jam Selesai');
        $sheet->setCellValue('G1', 'Keterangan');
        $sheet->setCellValue('H1', 'Status');

        $row = 2;
        foreach ($kegiatan as $item) {
            $sheet->setCellValue('A' . $row, $item->kegiatan_id);
            $sheet->setCellValue('B' . $row, $item->pegawai->pegawai_nama);
            $sheet->setCellValue('C' . $row, $item->kegiatan_jenis_kandang . ' - [ ' . $item->kandang->jenisKandang->kandang_tipe . ' - ' . $item->kandang->kand_nama . ' ]');
            $sheet->setCellValue('D' . $row, $item->kegiatan_tanggal);
            $sheet->setCellValue('E' . $row, $item->kegiatan_jam_mulai);
            $sheet->setCellValue('F' . $row, $item->kegiatan_jam_selesai);
            $sheet->setCellValue('G' . $row, $item->kegiatan_keterangan);
            $sheet->setCellValue('H' . $row, $item->kegiatan_status);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'data_kegiatan_kandang.xlsx';
        $filePath = public_path($fileName);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function filter(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $kegiatan = ModKegiatanKandang::with('kandang.jenisKandang')
            ->when($startDate, function ($query, $startDate) {
                return $query->whereDate('kegiatan_tanggal', '>=', $startDate);
            })
            ->when($endDate, function ($query, $endDate) {
                return $query->whereDate('kegiatan_tanggal', '<=', $endDate);
            })
            ->get();

        return view('backend.wasbitnak.kegiatan_kandang.index', compact('kegiatan'));
    }
}
