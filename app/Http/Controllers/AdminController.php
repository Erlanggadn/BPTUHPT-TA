<?php

namespace App\Http\Controllers;

use App\Models\ModPegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AdminController extends Controller
{
    //ADMIN
    public function indexadmin(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $akunuser = User::with('pegawai')
            ->whereNotIn('role', ['admin', 'pembeli'])
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->get();

        $jumlahPegawai = $akunuser->count();
        $pegawai = ModPegawai::all();

        return view('backend.admin.index', [
            'akunuser' => $akunuser,
            'jumlahPegawai' => $jumlahPegawai,
            'pegawai' => $pegawai,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
    }
    public function export(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $akunuser = User::with('pegawai')
            ->whereNotIn('role', ['admin', 'pembeli'])
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'NIP');
        $sheet->setCellValue('e1', 'No Hp');
        $sheet->setCellValue('F1', 'Jabatan');
        $sheet->setCellValue('G1', 'Tgl Buat');
        $row = 2;
        foreach ($akunuser as $item) {
            $sheet->setCellValue('A' . $row, $item->pegawai->pegawai_id);
            $sheet->setCellValue('B' . $row, $item->pegawai->pegawai_nama);
            $sheet->setCellValue('C' . $row, $item->email);
            $sheet->setCellValue('D' . $row, (string)$item->pegawai->pegawai_nip);
            $sheet->setCellValue('E' . $row, (string)$item->pegawai->pegawai_nohp);
            $sheet->setCellValue('F' . $row, $item->role);
            $sheet->setCellValue('G' . $row, $item->created_at->translatedFormat('d F Y'));
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'data_pegawai.xlsx';
        $filePath = public_path($fileName);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
    public function dashboard()
    {
        $jumlahPegawai = User::whereNotIn('role', ['admin', 'pembeli'])->count();
        $jumlahPembeli = User::whereNotIn('role', ['admin', 'ppid', 'wastukan', 'wasbitnak', 'kepala', 'keswan', 'bendahara'])->count();
        return view('backend.admin.dashboard.index', ['jumlahPegawai' => $jumlahPegawai, 'jumlahPembeli' => $jumlahPembeli]);
    }

    //lIST PEGAWAI - KESWAN
    public function pegawaiKeswan()
    {
        $akunuser = User::with('pegawai')
            ->whereNotIn('role', ['admin', 'ppid', 'wastukan', 'wasbitnak', 'kepala', 'pembeli', 'bendahara'])
            ->get();
        $jumlahPKeswan = $akunuser->count();
        return view('backend.keswan.list-pegawai.index', ['akunuser' => $akunuser, 'jumlahPKeswan' => $jumlahPKeswan]);
    }
    public function detailPKeswan($id)
    {
        $akunuser = User::with('pegawai')->where('id', $id)->first();
        return view('backend.keswan.list-pegawai.detail', ["akunuser" => $akunuser, "pegawai" => $akunuser->pegawai]);
    }

    //LIST PEGAWAI - WASBITNAK
    public function pegawaiWasbitnak()
    {
        $akunuser = User::with('pegawai')
            ->whereNotIn('role', ['admin', 'ppid', 'wastukan', 'keswan', 'kepala', 'pembeli', 'bendahara'])
            ->get();
        $jumlahPWasbitnak = $akunuser->count();
        return view('backend.wasbitnak.pegawai.index', ['akunuser' => $akunuser, 'jumlahPWasbitnak' => $jumlahPWasbitnak]);
    }
    public function detailPWasbitnak($id)
    {
        $akunuser = User::with('pegawai')->where('id', $id)->first();
        return view('backend.wasbitnak.pegawai.detail', ["akunuser" => $akunuser, "pegawai" => $akunuser->pegawai]);
    }

    //LIST PEGAWAI - WASTUKAN
    public function pegawaiWastukan()
    {
        $akunuser = User::with('pegawai')
            ->whereNotIn('role', ['admin', 'ppid', 'wasbitnak', 'keswan', 'kepala', 'pembeli', 'bendahara'])
            ->get();
        $jumlahPWastukan = $akunuser->count();
        return view('backend.wastukan.pegawai.index', ['akunuser' => $akunuser, 'jumlahPWastukan' => $jumlahPWastukan]);
    }
    public function detailPWastukan($id)
    {
        $akunuser = User::with('pegawai')->where('id', $id)->first();
        return view('backend.wastukan.pegawai.detail', ["akunuser" => $akunuser, "pegawai" => $akunuser->pegawai]);
    }
}
