<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Validation\ValidationException;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PembeliAuthController extends Controller
{
    public function daftar()
    {
        return view('backend.auth.pembeli.daftar');
    }

    public function register(Request $request)
    {
        try {
            // Validasi data yang diterima dari form
            $request->validate([
                'email' => 'required|email|unique:pembeli,email',
                'name' => 'required|string|max:255',
                'nohp' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'password' => 'required|string|min:5|max:20|confirmed',
            ], [
                'email.unique' => 'Email sudah terdaftar.',
                'password.min' => 'Minimal password 5 karakter.',
                'password.confirmed' => 'Password tidak sesuai dengan konfirmasi password.',
            ]);

            // // Periksa data yang dikirim dari form
            // dd($request->all());

            // Generate ID pembeli baru
            $lastPembeli = Pembeli::orderBy('id_pembeli', 'desc')->first();
            $nextId = $lastPembeli ? intval(substr($lastPembeli->id_pembeli, 1)) + 1 : 1;
            $id = 'P' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

            // Simpan data pembeli baru ke dalam database
            Pembeli::create([
                'id_pembeli' => $id,
                'nama' => $request->name,
                'email' => $request->email,
                'no_hp' => $request->nohp,
                'alamat' => $request->alamat,
                'tanggal_lahir' => $request->tanggal_lahir,
                'password' => Hash::make($request->password),
                'role' => 'pembeli',
            ]);

            // Redirect ke halaman login dengan pesan sukses
            return redirect()->route('pembeli.login')->with('success', 'Pendaftaran berhasil. Silakan login.');
        } catch (ValidationException $e) {
            return redirect()->route('pembeli.register')
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->route('pembeli.register')->with('fail', 'Data Salah : ' . $e->getMessage());
        }
    }

    public function showLoginForm()
    {
        return view('backend.auth.pembeli.login');
    }

    public function login(Request $request)
    {
         // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Mengambil kredensial dari request
        $credentials = $request->only('email', 'password');

        // Percobaan login
        if (Auth::attempt($credentials)) {
            // Regenerasi session untuk keamanan
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        // Jika login gagal, kirim pesan kesalahan kembali ke form login
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->except('password'));
    }
    
}
