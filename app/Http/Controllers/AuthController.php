<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ModPegawai;
use App\Models\ModPembeli;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //INDEX
    public function home()
    {
        $akunuser = Auth::user();
        return view('index', ['akunuser' => $akunuser]);
    }

    //REGIS - PEMBELI
    public function daftar()
    {
        return view('backend/auth/daftar');
    }
    public function daftarsave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pembeli_nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'pembeli_nohp' => 'required',
            'pembeli_instansi' => 'required|string',
            'pembeli_lahir' => 'required|date',
            'pembeli_alamat' => 'required',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pembeli'
        ]);
        $lastKode = ModPembeli::orderBy('pembeli_id', 'desc')->first();
        $newKode = $lastKode ? 'PMB' . str_pad(((int) substr($lastKode->pembeli_id, 3)) + 1, 3, '0', STR_PAD_LEFT) : 'PMB001';

        ModPembeli::create([
            'pembeli_id' => $newKode,
            'pembeli_detail' => $user->id,
            'pembeli_instansi' => $request->pembeli_instansi,
            'pembeli_lahir' => $request->pembeli_lahir,
            'pembeli_nama' => $request->pembeli_nama,
            'pembeli_alamat' => $request->pembeli_alamat,
            'pembeli_nohp' => $request->pembeli_nohp,
        ]);

        Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        return redirect()->route('loginpembeli');
    }

    //LOGIN - PEGAWAI
    public function login()
    {
        return view('backend.auth.login.login-pegawai'); // Untuk semua role kecuali pembeli
    }
    public function loginAction(Request $request)
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
                    $route = 'akun-pegawai';
                    break;
                case 'wasbitnak':
                    $route = 'wasbitnak';
                    break;
                case 'keswan':
                    $route = 'keswan';
                    break;
                case 'wastukan':
                    $route = '/wastukan/jenis_rumput';
                    break;
                case 'ppid':
                    $route = '/daftar-pembeli';
                    break;
                case 'kepala':
                    $route = '/dasboard/kepala';
                    break;
                case 'bendahara':
                    $route = '/pengajuan-sapi-bendahara';
                    break;
            }

            if ($role == 'pembeli') {
                return redirect()->back()->withErrors('Akses tidak diizinkan')->with('error', 'Gagal login, Anda tidak memiliki akses.');
            }

            return redirect($route)->with('success', 'Berhasil login!');
        } else {
            return redirect()->back()->withErrors('Email dan Password yang dimasukkan tidak sesuai')->withInput()->with('error', 'Gagal login, silakan cek kembali email dan password Anda.');
        }
    }

    //LOGIN - PEMBELI
    public function loginPembeli()
    {
        return view('backend.auth.login.login-pembeli'); // Khusus pembeli
    }
    public function loginPembeliAction(Request $request)
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

            if ($role != 'pembeli') {
                Auth::logout();
                return redirect()->back()->withErrors('Akses tidak diizinkan')->with('error', 'Gagal login, Anda tidak memiliki akses.');
            }

            return redirect('/')->with('success', 'Berhasil login!');
        } else {
            return redirect()->back()->withErrors('Email dan Password yang dimasukkan tidak sesuai')->withInput()->with('error', 'Gagal login, silakan cek kembali email dan password Anda.');
        }
    }

    //REGIS - PEGAWAI
    public function pegawaidaftar()
    {
        return view('backend/admin/daftar');
    }
    public function pegawaidaftarsave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pegawai_nama' => 'required',
            'pegawai_nip' => 'required',
            'email' => 'required|email|unique:users,email',
            'pegawai_nohp' => 'required',
            'pegawai_alamat' => 'required',
            'password' => 'required',
            'role' => 'required|in:wasbitnak,wastukan,admin,keswan,bendahara,kepala,ppid'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Email yang didaftarkan sudah ada atau tidak valid.');
        }

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        $lastKode = ModPegawai::orderBy('pegawai_id', 'desc')->first();
        $newKode = $lastKode ? 'PGW' . str_pad(((int) substr($lastKode->pegawai_id, 3)) + 1, 3, '0', STR_PAD_LEFT) : 'PGW001';

        ModPegawai::create([
            'pegawai_id' => $newKode,
            'pegawai_detail' => $user->id,
            'pegawai_nip' => $request->pegawai_nip,
            'pegawai_nama' => $request->pegawai_nama,
            'pegawai_alamat' => $request->pegawai_alamat,
            'pegawai_nohp' => $request->pegawai_nohp,
        ]);

        return redirect()->route('akunadmin')->with('berhasil.pegawai', 'Akun berhasil didaftarkan.');
    }

    //LOGOUT
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    //403
    public function unauthorized()
    {
        return view('backend.auth.unauthorized');
    }
    
}
