<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function indexadmin()
    {
        $akunuser = User::whereNotIn('role', ['admin', 'pembeli'])->get();
        return view('backend.admin.index', ['akunuser' => $akunuser ]);
    }
    public function pembeli()
    {
        return view ('backend.pembeli.index');
    }

    public function admin()
    {
        return view ('backend.admin.index');
    }

    public function wasbitnak()
    {
        return view ();
    }


    
}
