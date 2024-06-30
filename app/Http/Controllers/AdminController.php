<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function indexadmin()
    {
        $akunuser = User::whereNotIn('role', ['admin', 'pembeli'])->get();
        $jumlahPegawai = User::whereNotIn('role', ['admin', 'pembeli'])->count();
        return view('backend.admin.index', ['akunuser' => $akunuser, 'jumlahPegawai' => $jumlahPegawai]);;
    }

    public function dashboard()
    {
        $jumlahPegawai = User::whereNotIn('role', ['admin', 'pembeli'])->count();
        $jumlahPembeli = User::whereNotIn('role', ['admin', 'ppid', 'wastukan', 'wasbitnak', 'kepala', 'keswan', 'bendahara'])->count();
        return view('backend.admin.dashboard.index', ['jumlahPegawai'=> $jumlahPegawai, 'jumlahPembeli' => $jumlahPembeli] );
    }

    public function pegawaiKeswan()
    {
        $jumlahKeswan = User::whereNotIn('role', ['admin', 'ppid', 'wastukan', 'wasbitnak', 'kepala', 'pembeli', 'bendahara'])->get();
        $jumlahPkeswan = User::whereNotIn('role', ['admin', 'ppid', 'wastukan', 'wasbitnak', 'kepala', 'pembeli', 'bendahara'])->count();
        return view('backend.keswan.list-pegawai.index', ['jumlahKeswan' => $jumlahKeswan, 'jumlahPKeswan' => $jumlahPkeswan]);;
    }

    public function detailPKeswan($id)
    {
        $akunuser = User::where('id', $id)->get(); 
        return view('backend.keswan.list-pegawai.detail', ["akunuser" => $akunuser]);
    }

    public function pegawaiWasbitnak()
    {
        $jumlahWasbitnak = User::whereNotIn('role', ['admin', 'ppid', 'wastukan', 'keswan', 'kepala', 'pembeli', 'bendahara'])->get();
        $jumlahPwasbitnak = User::whereNotIn('role', ['admin', 'ppid', 'wastukan', 'keswan', 'kepala', 'pembeli', 'bendahara'])->count();
        return view('backend.wasbitnak.pegawai.index', ['jumlahWasbitnak' => $jumlahWasbitnak, 'jumlahPWasbitnak' => $jumlahPwasbitnak]);;
    }

    public function detailPWasbitnak($id)
    {
        $akunuser = User::where('id', $id)->get(); 
        return view('backend.wasbitnak.pegawai.detail', ["akunuser" => $akunuser]);
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
