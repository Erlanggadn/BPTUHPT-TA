<?php

namespace App\Http\Controllers;

use App\Models\ModRumput;
use Illuminate\Http\Request;
use App\Models\ModJenisLahan;
use App\Models\ModKegiatanLahan;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class KegiatanLahanController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        $lahan = $request->query('lahan');

        $kegiatanLahan = ModKegiatanLahan::when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
            return $query->whereBetween('created_at', [$startDate, $endDate]);
        })->when($lahan, function ($query) use ($lahan) {
            return $query->where('tanam_detail_lahan', $lahan);
        })->get();

        $jenisLahan = ModJenisLahan::all();

        return view('backend.wastukan.kegiatan.index', compact('kegiatanLahan', 'jenisLahan'));
    }
    public function show()
    {
        $jenisRumput = ModRumput::where('rumput_status', 'Bibit')->get();
        $jenisLahan = ModJenisLahan::all();
        $user = Auth::user();
        return view('backend.wastukan.kegiatan.create', compact('jenisRumput', 'jenisLahan', 'user'));
    }
    public function store(Request $request)
    {
        $today = date('Y-m-d');
        $validator = Validator::make($request->all(), [
            'rumput_id' => 'required|string|max:30',
            'lahan_id' => 'required|string|max:30',
            'tanam_tanggal' => 'required|date|after_or_equal:' . $today,
            'tanam_jam_mulai' => 'required|date_format:H:i',
            'tanam_jam_selesai' => 'required|date_format:H:i|after:tanam_jam_mulai',
            'tanam_kegiatan' => 'required|string|max:255',
            'tanam_status' => 'required|string|max:30',
            'tanam_foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validasi konflik jadwal
        $conflict = ModKegiatanLahan::where('lahan_id', $request->lahan_id)
            ->where('tanam_tanggal', $request->tanam_tanggal)
            ->where(function ($query) use ($request) {
                $query->whereBetween('tanam_jam_mulai', [$request->tanam_jam_mulai, $request->tanam_jam_selesai])
                    ->orWhereBetween('tanam_jam_selesai', [$request->tanam_jam_mulai, $request->tanam_jam_selesai])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('tanam_jam_mulai', '<=', $request->tanam_jam_mulai)
                            ->where('tanam_jam_selesai', '>=', $request->tanam_jam_selesai);
                    });
            })
            ->exists();

        if ($conflict) {
            return redirect()->back()->with('error', 'Kegiatan dengan waktu yang sama sudah ada di lahan ini pada tanggal yang dipilih.')->withInput();
        }

        $file = $request->file('tanam_foto');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);

        $lastKode = ModKegiatanLahan::orderBy('tanam_id', 'desc')->first();
        $newKode = $lastKode ? 'KL' . str_pad(((int) substr($lastKode->tanam_id, 2)) + 1, 3, '0', STR_PAD_LEFT) : 'KL001';

        $user = Auth::user();
        $pegawai = $user->pegawai;

        ModKegiatanLahan::create([
            'tanam_id' => $newKode,
            'pegawai_id' => $pegawai ? $pegawai->pegawai_id : null,
            'rumput_id' => $request->rumput_id,
            'lahan_id' => $request->lahan_id,
            'tanam_tanggal' => $request->tanam_tanggal,
            'tanam_jam_mulai' => $request->tanam_jam_mulai,
            'tanam_jam_selesai' => $request->tanam_jam_selesai,
            'tanam_kegiatan' => $request->tanam_kegiatan,
            'tanam_status' => $request->tanam_status,
            'tanam_foto' => $filename,
        ]);

        return redirect()->route('index.tanam')->with('success', 'Kegiatan lahan berhasil ditambahkan.');
    }
    public function detail($id)
    {
        $kegiatan = ModKegiatanLahan::findOrFail($id);
        $jenisRumput = ModRumput::where('rumput_status', 'Bibit')->get();
        $jenisLahan = ModJenisLahan::all();

        return view('backend.wastukan.kegiatan.detail', compact('kegiatan', 'jenisRumput', 'jenisLahan'));
    }
    // dd($request->all());
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tanam_kegiatan' => 'required|string|max:255',
            'tanam_status' => 'required|string|max:255',
            'tanam_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kegiatan = ModKegiatanLahan::findOrFail($id);

        if ($request->hasFile('tanam_foto')) {
            $file = $request->file('tanam_foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $kegiatan->tanam_foto = $filename;
        }

        $kegiatan->update([
            'tanam_kegiatan' => $request->tanam_kegiatan,
            'tanam_status' => $request->tanam_status,
        ]);

        return redirect()->route('index.tanam')->with('success', 'Kegiatan lahan berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $kegiatanKandang = ModKegiatanLahan::findOrFail($id);
        $kegiatanKandang->delete();

        return redirect()->route('index.tanam')->with('success', 'Data berhasil dihapus');
    }
    public function export(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $kegiatanLahan = ModKegiatanLahan::when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
            return $query->whereBetween('created_at', [$startDate, $endDate]);
        })->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Lahan');
        $sheet->setCellValue('C1', 'Rumput');
        $sheet->setCellValue('D1', 'Tanggal');
        $sheet->setCellValue('E1', 'Status');

        // Isi data
        $row = 2;
        foreach ($kegiatanLahan as $kegiatan) {
            $sheet->setCellValue('A' . $row, $kegiatan->tanam_id);
            $sheet->setCellValue('B' . $row, $kegiatan->lahan->lahan_nama);
            $sheet->setCellValue('C' . $row, $kegiatan->rumput->rumput_id . ' [' . $kegiatan->rumput->jenisRumput->rum_nama . ' - ' . $kegiatan->rumput->rumput_berat_awal . ' KG]');
            $sheet->setCellValue('D' . $row, \Carbon\Carbon::parse($kegiatan->tanam_tanggal)->translatedFormat('d F Y') . ' [' . $kegiatan->tanam_jam_mulai . ' - ' . $kegiatan->tanam_jam_selesai . ']');
            $sheet->setCellValue('E' . $row, $kegiatan->tanam_status);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data_Kegiatan_Lahan_' . date('Ymd_His') . '.xlsx';
        $filePath = storage_path('app/public/exports/' . $fileName);

        Storage::makeDirectory('public/exports');
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
