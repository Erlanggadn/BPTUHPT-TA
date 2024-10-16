<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ModSapi;
use App\Models\ModRumput;
use App\Models\ModJenisSapi;
use Illuminate\Http\Request;
use App\Models\ModJenisRumput;
use Illuminate\Routing\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SapiController extends Controller
{

    public function indexrumput()
    {
        $Rumput = ModRumput::with('jenisRumput')
            ->where('rumput_status', 'Siap Pakan')
            ->get();
        $jenisList = ModJenisRumput::all(); 
        return view('backend.wasbitnak.rumput.index', compact('Rumput', 'jenisList'));
    }

    public function detailrumput($id)
    {
        $rumput = ModRumput::with('jenisRumput')->findOrFail($id);
        return view('backend.wasbitnak.rumput.detail', compact('rumput'));
    }

    public function index()
    {
        $Sapi = ModSapi::with('jenisSapi')->whereNotIn('sapi_status', ['Siap Jual', 'terjual'])->get();
        $jenisList = ModJenisSapi::all(); 
        return view('backend.keswan.sapi.index', compact('Sapi', 'jenisList'));
    }

    public function show()
    {
        $jenisSapi = ModJenisSapi::all();
        return view('backend.keswan.sapi.create', compact('jenisSapi'));
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'sjenis_id' => 'required',
            'sapi_urutan_lahir' => 'required|integer',
            'sapi_tanggal_lahir' => 'required|date',
            'sapi_no_induk' => 'required|string|max:30',
            'sapi_keterangan' => 'required|string|max:255',
            'sapi_kelamin' => 'required|string|max:30',
            'sapi_status' => 'required|string|max:30',
        ]);


        $jenisSapi = ModJenisSapi::find($request->sjenis_id);
        if (!$jenisSapi) {
            return redirect()->back()->with('error', 'Jenis sapi tidak ditemukan');
        }
        $bulanTahun = date('mY', strtotime($request->sapi_tanggal_lahir));
        $jenis = strtoupper(substr($jenisSapi->sjenis_nama, 0, 1));
        $urutan_lahir = str_pad($request->sapi_urutan_lahir, 2, '0', STR_PAD_LEFT);
        $sapi_id = $jenis . $urutan_lahir . $bulanTahun;

        if (ModSapi::where('sapi_id', $sapi_id)->exists()) {
            return redirect()->back()->withErrors(['sapi_id' => 'Kode Sapi sudah ada, Coba lagi']);
        }

        $sapi = new ModSapi;
        $sapi->sapi_id = $sapi_id;
        $sapi->sjenis_id = $request->sjenis_id;
        $sapi->sapi_urutan_lahir = $request->sapi_urutan_lahir;
        $sapi->sapi_tanggal_lahir = $request->sapi_tanggal_lahir;
        $sapi->sapi_no_induk = $request->sapi_no_induk;
        $sapi->sapi_keterangan = $request->sapi_keterangan;
        $sapi->sapi_kelamin = $request->sapi_kelamin;
        $sapi->sapi_status = $request->sapi_status; 
        $sapi->sapi_umur = Carbon::parse($request->sapi_tanggal_lahir)->diffInMonths(Carbon::now());
        $sapi->save();

        return redirect()->route('index.sapi')->with('success', 'Data sapi berhasil disimpan');
    }

    public function detail($id)
    {
        $sapi = ModSapi::with('jenisSapi')->findOrFail($id);
        return view('backend.keswan.sapi.detail', compact('sapi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sapi_no_induk' => 'required|string|max:255',
            'sapi_keterangan' => 'required|string|max:255',
            'sapi_status' => 'required|string|max:255',
        ]);

        $sapi = ModSapi::findOrFail($id);

        $sapi->sapi_no_induk = $request->sapi_no_induk;
        $sapi->sapi_keterangan = $request->sapi_keterangan;
        $sapi->sapi_status = $request->sapi_status;
        $sapi->sapi_umur = Carbon::parse($sapi->sapi_tanggal_lahir)->diffInMonths(Carbon::now());
        $sapi->save();

        return redirect()->route('detail.sapi', $id)->with('success', 'Data sapi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $sapi = ModSapi::findOrFail($id);
        $sapi->delete();
        return redirect()->route('index.sapi')->with('success', 'Data sapi berhasil dihapus');
    }

    public function filter(Request $request)
    {
        $jenisSapi = $request->input('jenis_sapi');
        $bulanLahir = $request->input('bulan_lahir');
        $tahunLahir = $request->input('tahun_lahir'); 

        $Sapi = ModSapi::with('jenisSapi')
            ->when($jenisSapi, function ($query, $jenisSapi) {
                return $query->whereHas('jenisSapi', function ($query) use ($jenisSapi) {
                    $query->where('sjenis_id', $jenisSapi);
                });
            })
            ->when($bulanLahir, function ($query, $bulanLahir) {
                return $query->whereMonth('sapi_tanggal_lahir', $bulanLahir);
            })
            ->when($tahunLahir, function ($query, $tahunLahir) {
                return $query->whereYear('sapi_tanggal_lahir', $tahunLahir);
            })
            ->get();

        $jenisList = ModJenisSapi::all();
        return view('backend.keswan.sapi.index', compact('Sapi', 'jenisList'));
    }

    public function export(Request $request)
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
}
