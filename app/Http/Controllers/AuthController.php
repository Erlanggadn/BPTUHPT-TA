<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function daftar()
    {
        return view('backend/auth/daftar');
    }

    public function daftarsave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'nohp' => 'required',
            'alamat' => 'required',
            'password' => 'required',
        ])->validate();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password),
            'role' => 'pembeli'
        ]);

        return redirect()->route('login');
    }

    public function login()
    {
        return view('backend/auth/login');
    }

    function loginAction(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'EMAIL WAJIB DIISI',
                'password.required' => 'PASSWORD HARUS DIISI'
            ]
        );

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            $role = Auth::user()->role;
            $route = '';

            switch ($role) {
                case 'admin':
                    $route = 'admin';
                    break;
                case 'wasbitnak':
                    $route = 'wasbitnak';
                    break;
                case 'keswan':
                    $route = 'keswan';
                    break;
                case 'wastukan':
                    $route = 'wastukan';
                    break;
                case 'ppid':
                    $route = 'ppid';
                    break;
                case 'kepala':
                    $route = 'kepala';
                    break;
                case 'bendahara':
                    $route = 'bendahara';
                    break;
                case 'pembeli':
                    $route = 'pembeli';
                    break;
                default:
                    $route = '/';
            }

            return redirect($route)->with('success', 'Berhasil login!');
        } else {
            return redirect()->back()->withErrors('Email dan Password yang dimasukkan tidak sesuai')->withInput()->with('error', 'Gagal login, silakan cek kembali email dan password Anda.');
        }
    }


    public function pegawaidaftar()
    {
        return view('backend/admin/daftar');
    }

    public function pegawaidaftarsave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'nohp' => 'required',
            'alamat' => 'required',
            'password' => 'required',
            'role' => 'required|in:wasbitnak,wastukan,admin,keswan,bendahara,kepala,ppid'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Email yang didaftarkan sudah ada atau tidak valid.');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nohp' => $request->nohp,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('akunadmin')->with('success', 'Akun berhasil didaftarkan.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/'); // Redirect ke halaman login setelah logout
    }

    public function unauthorized()
    {
        return view('backend.auth.unauthorized');
    }
}
