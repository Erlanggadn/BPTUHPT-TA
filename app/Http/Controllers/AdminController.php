<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends Controller
{
    public function indexadmin()
    {
        $akunuser = User::with('pegawai')
            ->whereNotIn('role', ['admin', 'pembeli'])
            ->get();
        $jumlahPegawai = $akunuser->count();
        return view('backend.admin.index', ['akunuser' => $akunuser, 'jumlahPegawai' => $jumlahPegawai]);
    }

    public function dashboard()
    {
        $jumlahPegawai = User::whereNotIn('role', ['admin', 'pembeli'])->count();
        $jumlahPembeli = User::whereNotIn('role', ['admin', 'ppid', 'wastukan', 'wasbitnak', 'kepala', 'keswan', 'bendahara'])->count();
        return view('backend.admin.dashboard.index', ['jumlahPegawai' => $jumlahPegawai, 'jumlahPembeli' => $jumlahPembeli]);
    }

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

    public function pegawaiWastukan()
    {
        $jumlahWastukan = User::whereNotIn('role', ['admin', 'ppid', 'wasbitnak', 'keswan', 'kepala', 'pembeli', 'bendahara'])->get();
        $jumlahPwastukan = User::whereNotIn('role', ['admin', 'ppid', 'wasbitnak', 'keswan', 'kepala', 'pembeli', 'bendahara'])->count();
        return view('backend.wastukan.pegawai.index', ['jumlahWastukan' => $jumlahWastukan, 'jumlahPWastukan' => $jumlahPwastukan]);;
    }

    public function detailPWastukan($id)
    {
        $akunuser = User::where('id', $id)->get();
        return view('backend.wastukan.pegawai.detail', ["akunuser" => $akunuser]);
    }
}
