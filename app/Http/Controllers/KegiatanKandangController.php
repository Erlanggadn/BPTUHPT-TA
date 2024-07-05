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
        $user = User::all();
        $sapis = ModSapi::all();
        return view('backend.wasbitnak.kegiatan_kandang.create', compact('sapis', 'jenisKandang'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'kegiatan_jenis_kandang' => 'required|string',
            'kegiatan_tanggal' => 'required|date',
            'kegiatan_jam_mulai' => 'required',
            'kegiatan_orang' => 'required|string',
            'kegiatan_jam_selesai' => 'required',
            'kegiatan_keterangan' => 'nullable|string',
            'kegiatan_keterangan' => 'required|string',
            'kegiatan_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kode_sapi' => 'required|array',
            'kode_sapi.*' => 'required|string|exists:master_sapi,sapi_id',
        ]);

        $lastKode = ModKegiatanKandang::orderBy('kegiatan_id', 'desc')->first();
        $newKode = $lastKode ? 'A' . str_pad(((int) substr($lastKode->kegiatan_id, 2)) + 1, 3, '0', STR_PAD_LEFT) : 'A001';

        $kegiatan = ModKegiatanKandang::create([
            'kegiatan_id' => $newKode,
            'kegiatan_jenis_kandang' => $request->kegiatan_jenis_kandang,
            'kegiatan_tanggal' => $request->kegiatan_tanggal,
            'kegiatan_orang' => auth()->user()->name,
            'kegiatan_jam_mulai' => $request->kegiatan_jam_mulai,
            'kegiatan_jam_selesai' => $request->kegiatan_jam_selesai,
            'kegiatan_keterangan' => $request->kegiatan_keterangan,
            'kegiatan_status' => $request->kegiatan_status,
            'kegiatan_foto' => $request->file('kegiatan_foto')->store('kegiatan_fotos', 'public'),
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
            'kegiatan_keterangan' => 'nullable|string',
            'kegiatan_keterangan' => 'required|string',
            'kegiatan_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kegiatan_status' => 'required|string',
            'kode_sapi' => 'required|array',
            'kode_sapi.*' => 'required|string|exists:master_sapi,sapi_id',
        ]);

        $kegiatan->update([
            'kegiatan_jenis_kandang' => $request->kegiatan_jenis_kandang,
            'kegiatan_tanggal' => $request->kegiatan_tanggal,
            'kegiatan_jam_mulai' => $request->kegiatan_jam_mulai,
            'kegiatan_jam_selesai' => $request->kegiatan_jam_selesai,
            'kegiatan_keterangan' => $request->kegiatan_keterangan,
            'kegiatan_status' => $request->kegiatan_status,
            'kegiatan_foto' => $request->hasFile('kegiatan_foto') ? $request->file('kegiatan_foto')->store('kegiatan_fotos', 'public') : $kegiatan->kegiatan_foto,
            'updated_id' => auth()->id(),
            'updated_nama' => auth()->user()->name,
        ]);

        ModDetailKandangSapi::where('detail_kandang', $kegiatan->kegiatan_id)->delete();

        foreach ($validated['kode_sapi'] as $sapi_id) {
            $lastId = ModDetailKandangSapi::orderBy('detail_id', 'desc')->first();
            $newId = $lastId ? 'DT' . str_pad(((int) substr($lastId->detail_id, 2)) + 1, 3, '0', STR_PAD_LEFT) : 'DT001';
            ModDetailKandangSapi::create([
                'detail_id' => $newId,
                'detail_kandang' => $kegiatan->kegiatan_id,
                'detail_sapi' => $sapi_id,
                'created_id' => auth()->id(),
                'created_nama' => auth()->user()->name,
                'updated_id' => auth()->id(),
                'updated_nama' => auth()->user()->name,
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
        $sheet->setCellValue('B1', 'Kode Kandang');
        $sheet->setCellValue('C1', 'Tanggal Kegiatan');
        $sheet->setCellValue('D1', 'Keterangan');
        $sheet->setCellValue('E1', 'Status');

        $row = 2;
        foreach ($kegiatan as $item) {
            $sheet->setCellValue('A' . $row, $item->kegiatan_id);
            $sheet->setCellValue('B' . $row, $item->kegiatan_jenis_kandang . ' - [ ' . $item->kandang->jenisKandang->kandang_tipe . ' - ' . $item->kandang->kand_nama . ' ]');
            $sheet->setCellValue('C' . $row, $item->kegiatan_tanggal);
            $sheet->setCellValue('D' . $row, $item->kegiatan_keterangan);
            $sheet->setCellValue('E' . $row, $item->kegiatan_status);
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
