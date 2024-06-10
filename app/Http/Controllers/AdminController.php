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
        return view('backend.admin.dashboard.index');
    }

    // public function generatePDF()
    // {
    //     $data = ['title' => 'Welcome to Laravel PDF'];
    //     $pdf = PDF::loadView('pdf_view', $data);
    //     return $pdf->download('invoice.pdf');
    // }
}
