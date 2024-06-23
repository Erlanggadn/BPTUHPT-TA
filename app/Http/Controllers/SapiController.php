<?php

namespace App\Http\Controllers;

use App\Models\Sapi;
use App\Models\ModSapi;
use App\Models\ModJenisSapi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SapiController extends Controller
{
    public function index()
    {
        $Sapi = ModSapi::with('jenisSapi')->get();
        $jenisList = ModJenisSapi::all(); // Mengambil daftar jenis sapi untuk dropdown filter
        return view('backend.keswan.sapi.index', compact('Sapi', 'jenisList'));
    }

    public function show()
    {
        $jenisSapi = ModJenisSapi::where('sjenis_aktif', 'Aktif')->get();
        return view('backend.keswan.sapi.create', compact('jenisSapi'));
    }

    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'sapi_jenis' => 'required',
            'sapi_urutan_lahir' => 'required|integer',
            'sapi_tanggal_lahir' => 'required|date',
            'sapi_no_induk' => 'required|string|max:255',
            'sapi_keterangan' => 'required|string|max:255',
        ]);

        // Generate sapi_id
        $jenisSapi = ModJenisSapi::find($request->sapi_jenis);
        if (!$jenisSapi) {
            return redirect()->back()->with('error', 'Jenis sapi tidak ditemukan');
        }
        $bulanTahun = date('mY', strtotime($request->sapi_tanggal_lahir));
        $jenis = strtoupper(substr($jenisSapi->sjenis_nama, 0, 1));
        $urutan_lahir = str_pad($request->sapi_urutan_lahir, 2, '0', STR_PAD_LEFT);
        $sapi_id = $jenis . $urutan_lahir . $bulanTahun;

        // Validasi unique sapi_id
        if (ModSapi::where('sapi_id', $sapi_id)->exists()) {
            return redirect()->back()->withErrors(['sapi_id' => 'ID sapi sudah digunakan.']);
        }

        $sapi = new ModSapi;
        $sapi->sapi_id = $sapi_id;
        $sapi->sapi_jenis = $request->sapi_jenis;
        $sapi->sapi_urutan_lahir = $request->sapi_urutan_lahir;
        $sapi->sapi_tanggal_lahir = $request->sapi_tanggal_lahir;
        $sapi->sapi_no_induk = $request->sapi_no_induk;
        $sapi->sapi_keterangan = $request->sapi_keterangan;
        $sapi->created_id = auth()->user()->id; // Atau sesuaikan dengan user ID yang login
        $sapi->created_nama = auth()->user()->name; // Atau sesuaikan dengan user name yang login
        $sapi->updated_id = auth()->user()->id; // Atau sesuaikan dengan user ID yang login
        $sapi->updated_nama = auth()->user()->name; // Atau sesuaikan dengan user name yang login
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
        ]);

        $sapi = ModSapi::findOrFail($id);

        $sapi->sapi_no_induk = $request->sapi_no_induk;
        $sapi->sapi_keterangan = $request->sapi_keterangan;
        $sapi->updated_id = auth()->user()->id;
        $sapi->updated_nama = auth()->user()->name;
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
        $Sapi = ModSapi::with('jenisSapi')
            ->when($jenisSapi, function ($query, $jenisSapi) {
                return $query->whereHas('jenisSapi', function ($query) use ($jenisSapi) {
                    $query->where('sjenis_id', $jenisSapi);
                });
            })
            ->get();

        $jenisList = ModJenisSapi::all(); // Mengambil daftar jenis sapi untuk dropdown filter
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

        $row = 2;
        foreach ($sapi as $item) {
            $sheet->setCellValue('A' . $row, $item->sapi_id);
            $sheet->setCellValue('B' . $row, $item->jenisSapi->sjenis_nama);
            $sheet->setCellValue('C' . $row, $item->sapi_tanggal_lahir);
            $sheet->setCellValue('D' . $row, $item->sapi_no_induk);
            $row++;
        }


        $writer = new Xlsx($spreadsheet);
        $fileName = 'data_sapi.xlsx';
        $filePath = public_path($fileName);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
