<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BendaharaController extends Controller
{
    public function dashboard()
    {
        return view ('backend.bendahara.index');
    }
}
