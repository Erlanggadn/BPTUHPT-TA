<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use App\Models\SapiJual;
use Illuminate\Http\Request;
use App\Models\RumputSiapJual;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;

class PPIDController extends Controller
{
    public function index(){
        return view('backend.ppid.index');
    }
    public function indexsapi(){
        $sapiJuals = SapiJual::all();
        return view('backend.ppid.siapjual.sapi', compact('sapiJuals'));
    }
    public function indexrumput(){
        $rumputsi = RumputSiapJual::all();
        return view('backend.ppid.siapjual.rumput', ["rumputsi"=>$rumputsi]);
    }

    public function indexpembeli(){
        $akunuser = Pembeli::all();
        return view('backend.ppid.pembeli.akun', ['akunuser' => $akunuser ]);
    }

    
}
