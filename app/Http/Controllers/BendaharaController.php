<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ModPembeli;
use App\Models\ModHargaSapi;
use App\Models\ModJenisSapi;
use Illuminate\Http\Request;
use App\Models\ModJenisRumput;
use App\Models\ModPengajuanSapi;
use App\Models\ModPembayaranSapi;
use App\Models\ModPengajuanRumput;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\ModPembayaranRumput;
use App\Models\ModDetailPengajuanSapi;
use App\Models\ModDetailPengajuanRumput;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class BendaharaController extends Controller
{
    //INDEX BENDAHARA
    public function dashboard()
    {
        return view('backend.bendahara.index');
    }

    //BAYAR SAPI
    public function indexsapi(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');

        // Query data sapi yang statusnya 'Disetujui'
        $query = ModPengajuanSapi::with(['user', 'pembayaranSapi' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->where('belisapi_status', 'Disetujui');

        // Periksa apakah parameter tanggal ada
        if ($tanggalMulai && $tanggalSelesai) {
            $tanggalMulai = Carbon::parse($tanggalMulai)->startOfDay();
            $tanggalSelesai = Carbon::parse($tanggalSelesai)->endOfDay();

            // Tambahkan kondisi filter tanggal ke query
            $query->whereBetween('belisapi_tanggal', [$tanggalMulai, $tanggalSelesai]);
        }

        // Ambil data dengan filter yang diterapkan
        $PSapi = $query->get();

        // Menghitung jumlah pembayaran yang belum diterima
        $jumlahBelumDiterima = $PSapi->sum(function ($item) {
            return $item->pembayaranSapi->where('dbeli_status', 'Belum diterima')->count();
        });

        // Kirim data ke view
        return view('backend.bendahara.sapi.index', compact('PSapi', 'jumlahBelumDiterima'));
    }


    public function detailsapi($belisapi_id)
    {
        $pengajuan = ModPengajuanSapi::where('belisapi_id', $belisapi_id)->firstOrFail();
        $detail = ModDetailPengajuanSapi::where('belisapi_id', $belisapi_id)->first();
        $sapiJenis = ModJenisSapi::all();
        $currentUser = ModPembeli::all();
        $pembayaran = ModPembayaranSapi::where('belisapi_id', $belisapi_id)->first(); // Pastikan variabel pembayaran diambil
        $hargaData = ModHargaSapi::all();

        return view('backend.bendahara.sapi.detail', compact('pengajuan', 'sapiJenis', 'currentUser', 'pembayaran', 'hargaData'));
    }
    public function storebayarsapi(Request $request, $belisapi_id)
    {
        // dd($request->all());
        $request->validate([
            'dbeli_invoice' => 'required|file|mimes:jpg,png,jpeg,pdf',
            'dbeli_status' => 'required|string',
            'dbeli_keterangan' => 'nullable|string',
        ]);

        // Simpan file invoice
        $file = $request->file('dbeli_invoice');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);


        // Buat kode baru untuk dbeli_id
        $lastKode = ModPembayaranSapi::orderBy('dbeli_id', 'desc')->first();
        $newKode = $lastKode ? 'BS' . str_pad(((int) substr($lastKode->dbeli_id, 2)) + 1, 3, '0', STR_PAD_LEFT) : 'BS001';

        // Simpan data pembayaran sapi
        ModPembayaranSapi::create([
            'dbeli_id' => $newKode,
            'belisapi_id' => $belisapi_id,
            'dbeli_invoice' => $filename,
            'dbeli_status' => $request->dbeli_status,
            'dbeli_keterangan' => $request->dbeli_keterangan,
            'dbeli_bukti' => null,
            'dbeli_sudah' => 'Saya Belum membayar',
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('index.bendahara.psapi')->with('success', 'Pembayaran berhasil disimpan.');
    }
    public function updatebayarsapi(Request $request, $dbeli_id)
    {
        $request->validate([
            'dbeli_status' => 'required|string',
            'dbeli_keterangan' => 'nullable|string',
        ]);

        // Cari data pembayaran berdasarkan dbeli_id
        $pembayaran = ModPembayaranSapi::findOrFail($dbeli_id);

        // Update data pembayaran
        $pembayaran->update([
            'dbeli_status' => $request->dbeli_status,
            'dbeli_keterangan' => $request->dbeli_keterangan,
        ]);

        return redirect()->route('index.bendahara.psapi')->with('success', 'Pembayaran berhasil diperbarui.');
    }
    public function deletebayarsapi($dbeli_id)
    {
        $pembayaran = ModPembayaranSapi::findOrFail($dbeli_id);
        $pembayaran->delete();
        return redirect()->route('index.bendahara.psapi')->with('success', 'Pembayaran berhasil dihapus.');
    }

    //BAYAR RUMPUT
    public function indexrumput()
    {
        // Ambil data pengajuan rumput dengan relasi
        $PRumput = ModPengajuanRumput::with(['pembeli', 'pembayaranRumput' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->where('belirum_status', 'Disetujui')->get();

        // Menghitung jumlah pembayaran yang belum diterima
        $jumlahBelumDiterima = $PRumput->sum(function ($item) {
            return $item->pembayaranRumput->where('bayarrum_status', 'Belum diterima')->count();
        });

        // Kirim data ke view
        return view('backend.bendahara.rumput.index', compact('PRumput', 'jumlahBelumDiterima'));
    }

    public function detailrumput($belirum_id)
    {
        $pengajuan = ModPengajuanRumput::where('belirum_id', $belirum_id)->firstOrFail();
        $detail = ModDetailPengajuanRumput::where('belirum_id', $belirum_id)->first();
        $rumputJenis = ModJenisRumput::all();
        $currentUser = ModPembeli::all();
        $pembayaran = ModPembayaranRumput::where('belirum_id', $belirum_id)->first(); // Pastikan variabel pembayaran diambil

        return view('backend.bendahara.rumput.detail', compact('pengajuan', 'rumputJenis', 'currentUser', 'pembayaran'));
    }
    public function storebayarrumput(Request $request, $belirum_id)
    {
        $request->validate([
            'bayarrum_invoice' => 'required|file|mimes:jpg,png,jpeg,pdf',
            'bayarrum_status' => 'required|string',
            'bayarrum_keterangan' => 'nullable|string',
        ]);

        // Simpan file invoice
        $file = $request->file('bayarrum_invoice');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);


        // Buat kode baru untuk dbeli_id
        $lastKode = ModPembayaranRumput::orderBy('bayarrum_id', 'desc')->first();
        $newKode = $lastKode ? 'BR' . str_pad(((int) substr($lastKode->bayarrum_id, 2)) + 1, 3, '0', STR_PAD_LEFT) : 'BR001';

        // Simpan data pembayaran sapi
        ModPembayaranRumput::create([
            'bayarrum_id' => $newKode,
            'belirum_id' => $belirum_id,
            'bayarrum_invoice' => $filename,
            'bayarrum_status' => $request->bayarrum_status,
            'bayarrum_keterangan' => $request->bayarrum_keterangan,
            'bayarrum_bukti' => null,
            'bayarrum_sudah' => 'Saya Belum membayar',
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('index.bendahara.prumput')->with('success', 'Pembayaran berhasil disimpan.');
    }
    public function updatebayarrumput(Request $request, $bayarrum_id)
    {
        $request->validate([
            'bayarrum_status' => 'required|string',
            'bayarrum_keterangan' => 'nullable|string',
        ]);

        // Cari data pembayaran berdasarkan bayarrum_id
        $pembayaran = ModPembayaranRumput::findOrFail($bayarrum_id);

        // Update data pembayaran
        $pembayaran->update([
            'bayarrum_status' => $request->bayarrum_status,
            'bayarrum_keterangan' => $request->bayarrum_keterangan,
        ]);

        return redirect()->route('index.bendahara.prumput')->with('success', 'Pembayaran berhasil diperbarui.');
    }
    public function deletebayarrumput($bayarrum_id)
    {
        $pembayaran = ModPembayaranRumput::findOrFail($bayarrum_id);
        $pembayaran->forceDelete();
        return redirect()->route('index.bendahara.prumput')->with('success', 'Pembayaran berhasil dihapus.');
    }

    //FILTER DAN EXPORT PEMBELIAN SAPI
    public function filtersapi(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');

        // Pastikan tanggal yang diberikan valid
        if ($tanggalMulai && $tanggalSelesai) {
            return redirect()->route('index.bendahara.psapi', [
                'tanggal_mulai' => $tanggalMulai,
                'tanggal_selesai' => $tanggalSelesai
            ]);
        } else {
            // Handle jika tidak ada tanggal yang dipilih
            return redirect()->back()->with('error', 'Pilih rentang tanggal terlebih dahulu.');
        }
    }

    public function exportsapi(Request $request)
    {
        // Ambil parameter tanggal dari request
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');

        // Query data sapi yang hanya berstatus 'Disetujui'
        $query = ModPengajuanSapi::with('user')
            ->where('belisapi_status', 'Disetujui'); // Tambahkan filter status 'Disetujui'

        // Filter berdasarkan tanggal, jika ada input tanggal
        if ($tanggalMulai && $tanggalSelesai) {
            $tanggalMulai = Carbon::parse($tanggalMulai)->startOfDay();
            $tanggalSelesai = Carbon::parse($tanggalSelesai)->endOfDay();

            $query->whereBetween('belisapi_tanggal', [$tanggalMulai, $tanggalSelesai]);
        }

        // Dapatkan hasil query
        $PSapi = $query->get();

        // Buat spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header kolom
        $sheet->setCellValue('A1', 'ID Pengajuan');
        $sheet->setCellValue('B1', 'Nama Pengirim');
        $sheet->setCellValue('C1', 'Asal Instansi');
        $sheet->setCellValue('D1', 'Tanggal Masuk');
        $sheet->setCellValue('E1', 'Disposisi');
        $sheet->setCellValue('F1', 'Status');

        // Isi data ke sheet
        $row = 2;
        foreach ($PSapi as $item) {
            $sheet->setCellValue('A' . $row, $item->belisapi_id);
            $sheet->setCellValue('B' . $row, $item->user->pembeli_nama);
            $sheet->setCellValue('C' . $row, $item->user->pembeli_instansi);
            $sheet->setCellValue('D' . $row, Carbon::parse($item->belisapi_tanggal)->translatedFormat('j F Y'));
            $sheet->setCellValue('E' . $row, $item->belisapi_keterangan);
            $sheet->setCellValue('F' . $row, $item->belisapi_status);
            $row++;
        }

        // Set nama file
        $filename = 'pengajuan_sapi_' . date('Ymd_His') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        // Kirim file ke browser untuk di-download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
        exit;
    }

    //FILTER DAN EXPORT PEMBELIAN RUMPUT
    public function filterrumput(Request $request)
    {
        // Ambil parameter tanggal dari request
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');

        // Query data pengajuan rumput dengan status 'Disetujui'
        $query = ModPengajuanRumput::with(['pembeli', 'pembayaranRumput' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->where('belirum_status', 'Disetujui');

        // Jika ada filter tanggal
        if ($tanggalMulai && $tanggalSelesai) {
            $tanggalMulai = Carbon::parse($tanggalMulai)->startOfDay();
            $tanggalSelesai = Carbon::parse($tanggalSelesai)->endOfDay();

            // Filter berdasarkan rentang tanggal belirum_tanggal
            $query->whereBetween('belirum_tanggal', [$tanggalMulai, $tanggalSelesai]);
        }

        // Ambil data yang sudah difilter
        $PRumput = $query->get();

        // Return data yang sudah difilter ke view
        return view('backend.bendahara.rumput.index', compact('PRumput'));
    }

    public function exportrumput(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');

        // Query data pengajuan rumput dengan status 'Disetujui'
        $query = ModPengajuanRumput::with('pembeli')->where('belirum_status', 'Disetujui');

        // Jika ada filter tanggal
        if ($tanggalMulai && $tanggalSelesai) {
            $tanggalMulai = Carbon::parse($tanggalMulai)->startOfDay();
            $tanggalSelesai = Carbon::parse($tanggalSelesai)->endOfDay();

            // Filter berdasarkan rentang tanggal belirum_tanggal
            $query->whereBetween('belirum_tanggal', [$tanggalMulai, $tanggalSelesai]);
        }

        $PRumput = $query->get();

        // Buat spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header kolom
        $sheet->setCellValue('A1', 'ID Pengajuan');
        $sheet->setCellValue('B1', 'Nama Pembeli');
        $sheet->setCellValue('C1', 'Alamat');
        $sheet->setCellValue('D1', 'Tanggal Pengajuan');
        $sheet->setCellValue('E1', 'Alasan Pengajuan');
        $sheet->setCellValue('F1', 'Status');
        $sheet->setCellValue('G1', 'Keterangan');

        // Isi data ke sheet
        $row = 2;
        foreach ($PRumput as $item) {
            $sheet->setCellValue('A' . $row, $item->belirum_id);
            $sheet->setCellValue('B' . $row, $item->pembeli->pembeli_nama);
            $sheet->setCellValue('C' . $row, $item->belirum_alamat);
            $sheet->setCellValue('D' . $row, Carbon::parse($item->belirum_tanggal)->translatedFormat('j F Y'));
            $sheet->setCellValue('E' . $row, $item->belirum_alasan);
            $sheet->setCellValue('F' . $row, $item->belirum_status);
            $sheet->setCellValue('G' . $row, $item->belirum_keterangan);
            $row++;
        }

        // Set nama file
        $filename = 'pengajuan_rumput_' . date('Ymd_His') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        // Kirim file ke browser
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
        exit;
    }
}
