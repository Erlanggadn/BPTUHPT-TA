<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ModPembeli;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AkunController extends Controller
{
    //ADMIN - PEGAWAI
    public function detailakun($user_id)
    {
        $akunuser = User::with('pegawai')->where('user_id', $user_id)->first();
        return view('backend.admin.pegawai.detailakun', ["akunuser" => $akunuser, "pegawai" => $akunuser->pegawai]);
    }
    public function edit($id)
    {
        $akunuser = User::with('pegawai')->findOrFail($id);
        return view('backend.admin.pegawai.edit', compact('akunuser'));
    }
    public function update(Request $request, $id)
    {
        $akunuser = User::with('pegawai')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'pegawai_nip' => 'required|string',
            'pegawai_nama' => 'required|string',
            'pegawai_alamat' => 'required|string',
            'pegawai_nohp' => 'required',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|confirmed',
        ]);
        // dd($request->all());
        $validator->after(function ($validator) use ($request, $akunuser) {
            if ($request->filled('current_password') && !Hash::check($request->current_password, $akunuser->password)) {
                $validator->errors()->add('current_password', 'Password tidak sesuai');
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->except('password', 'new_password', 'current_password', 'new_password_confirmation');
        if ($request->filled('new_password')) {
            $data['password'] = Hash::make($request->new_password);
        }
        $akunuser->update($data);
        if ($akunuser->pegawai) {
            $akunuser->pegawai->update($request->only('pegawai_nip', 'pegawai_nama', 'pegawai_alamat', 'pegawai_nohp'));
        }

        return redirect()->route('detailakun', $akunuser->user_id)->with('berhasil.edit', 'Akun berhasil diperbarui');
    }

    //ADMIN - PEMBELI
    public function indexpembeli(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $akunuser = User::with('pembeli')
            ->whereNotIn('role', ['admin', 'ppid', 'wastukan', 'wasbitnak', 'kepala', 'keswan', 'bendahara'])
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->get();

        $jumlahPegawai = $akunuser->count();
        $pegawai = ModPembeli::all();

        return view('backend.admin.pembeli.pembeli', [
            'akunuser' => $akunuser,
            'jumlahPegawai' => $jumlahPegawai,
            'pegawai' => $pegawai,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
    }
    public function exportpembeli(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $akunuser = User::with('pembeli')
            ->whereNotIn('role', ['admin', 'ppid', 'wastukan', 'wasbitnak', 'kepala', 'keswan', 'bendahara'])
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Tanggal Lahir');
        $sheet->setCellValue('E1', 'No Hp');
        $sheet->setCellValue('F1', 'Instansi');
        $sheet->setCellValue('G1', 'Alamat');
        $sheet->setCellValue('H1', 'Tgl Buat');

        $row = 2;
        foreach ($akunuser as $item) {
            $sheet->setCellValue('A' . $row, $item->pembeli->pembeli_id);
            $sheet->setCellValue('B' . $row, $item->pembeli->pembeli_nama);
            $sheet->setCellValue('C' . $row, $item->email);
            $sheet->setCellValue('D' . $row, (string)$item->pembeli->pembeli_lahir);
            $sheet->setCellValue('E' . $row, (string)$item->pembeli->pembeli_nohp);
            $sheet->setCellValue('F' . $row, $item->pembeli->pembeli_instansi);
            $sheet->setCellValue('G' . $row, $item->pembeli->pembeli_alamat);
            $sheet->setCellValue('H' . $row, $item->created_at->translatedFormat('d F Y'));
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'data_pembeli.xlsx';
        $filePath = public_path($fileName);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
    public function detailakunpembeli($user_id)
    {
        $akunuser = User::with('pembeli')->where('user_id', $user_id)->first();
        return view('backend.admin.pembeli.detail', ["akunuser" => $akunuser, "pembeli" => $akunuser->pembeli]);
    }
    public function editpembeli($id)
    {
        $akunuser = User::with('pembeli')->findOrFail($id);
        return view('backend.admin.pembeli.edit', compact('akunuser'));
    }
    public function updatepembeli(Request $request, $id)
    {
        $akunuser = User::with('pembeli')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'pembeli_instansi' => 'required|string',
            'pembeli_nama' => 'required|string',
            'pembeli_alamat' => 'required|string',
            'pembeli_nohp' => 'required',
            'pembeli_lahir' => 'required|date',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|confirmed',
        ]);

        // dd($request->all());

        $validator->after(function ($validator) use ($request, $akunuser) {
            if ($request->filled('current_password') && !Hash::check($request->current_password, $akunuser->password)) {
                $validator->errors()->add('current_password', 'Password tidak sesuai');
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->except('password', 'new_password', 'current_password', 'new_password_confirmation');
        if ($request->filled('new_password')) {
            $data['password'] = Hash::make($request->new_password);
        }
        $akunuser->update($data);
        if ($akunuser->pembeli) {
            $akunuser->pembeli->update($request->only('pembeli_instansi', 'pembeli_nama', 'pembeli_alamat', 'pembeli_nohp', 'pembeli_lahir'));
        }

        return redirect()->route('detail.akun.pembeli', $akunuser->user_id)->with('berhasil.edit', 'Akun berhasil diperbarui');
    }

    //PROFIL ADMIN
    public function profil($user_id)
    {
        $akunuser = User::with('pegawai')->where('user_id', $user_id)->first();
        return view('backend.admin.detailadmin', ["akunuser" => $akunuser, "pegawai" => $akunuser->pegawai]);
    }
    public function editprofil($user_id)
    {
        $akunuser = User::with('pegawai')->findOrFail($user_id);
        return view('backend.admin.template.edit', compact('akunuser'));
    }
    public function updateprofil(Request $request, $id)
    {
        $akunuser = User::with('pegawai')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'pegawai_nip' => 'required|string',
            'pegawai_nama' => 'required|string',
            'pegawai_alamat' => 'required|string',
            'pegawai_nohp' => 'required',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|confirmed',
        ]);

        // dd($request->all());

        $validator->after(function ($validator) use ($request, $akunuser) {
            if ($request->filled('current_password') && !Hash::check($request->current_password, $akunuser->password)) {
                $validator->errors()->add('current_password', 'Password tidak sesuai');
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->except('password', 'new_password', 'current_password', 'new_password_confirmation');
        if ($request->filled('new_password')) {
            $data['password'] = Hash::make($request->new_password);
        }
        $akunuser->update($data);
        if ($akunuser->pegawai) {
            $akunuser->pegawai->update($request->only('pegawai_nip', 'pegawai_nama', 'pegawai_alamat', 'pegawai_nohp'));
        }

        return redirect()->route('detailakun', $akunuser->id)->with('berhasil.edit', 'Akun berhasil diperbarui');
    }

    //DELETE AKUN
    public function delete($user_id)
    {
        $akunuser = User::findOrFail($user_id);
        $akunuser->delete();

        return redirect()->back()->with('berhasil.hapus', 'Akun berhasil dihapus');
    }

    //PROFIL - KESWAN
    public function profilkeswan($user_id)
    {
        $akunuser = User::with('pegawai')->where('user_id', $user_id)->first();
        return view('backend.keswan.detailkeswan', ["akunuser" => $akunuser, "pegawai" => $akunuser->pegawai]);
    }
    public function editkeswan($id)
    {
        $akunuser = User::with('pegawai')->findOrFail($id);
        return view('backend.keswan.editkeswan', compact('akunuser'));
    }
    public function updatekeswan(Request $request, $id)
    {
        $akunuser = User::with('pegawai')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'pegawai_nip' => 'required|string',
            'pegawai_nama' => 'required|string',
            'pegawai_alamat' => 'required|string',
            'pegawai_nohp' => 'required',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|confirmed',
        ]);

        // dd($request->all());

        $validator->after(function ($validator) use ($request, $akunuser) {
            if ($request->filled('current_password') && !Hash::check($request->current_password, $akunuser->password)) {
                $validator->errors()->add('current_password', 'Password tidak sesuai');
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->except('password', 'new_password', 'current_password', 'new_password_confirmation');
        if ($request->filled('new_password')) {
            $data['password'] = Hash::make($request->new_password);
        }
        $akunuser->update($data);
        if ($akunuser->pegawai) {
            $akunuser->pegawai->update($request->only('pegawai_nip', 'pegawai_nama', 'pegawai_alamat', 'pegawai_nohp'));
        }

        return redirect()->route('profilkeswan', $akunuser->user_id)->with('berhasil.edit', 'Akun berhasil diperbarui');
    }


    //PROFIL - WASBITNAK
    public function profilwasbitnak($user_id)
    {
        $akunuser = User::with('pegawai')->where('user_id', $user_id)->first();
        return view('backend.wasbitnak.profil.detailprofil', ["akunuser" => $akunuser, "pegawai" => $akunuser->pegawai]);
    }
    public function editwasbitnak($id)
    {
        $akunuser = User::with('pegawai')->findOrFail($id);
        return view('backend.wasbitnak.profil.editprofil', compact('akunuser'));
    }
    public function updatewasbitnak(Request $request, $id)
    {
        $akunuser = User::with('pegawai')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'pegawai_nip' => 'required|string',
            'pegawai_nama' => 'required|string',
            'pegawai_alamat' => 'required|string',
            'pegawai_nohp' => 'required',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|confirmed',
        ]);

        // dd($request->all());

        $validator->after(function ($validator) use ($request, $akunuser) {
            if ($request->filled('current_password') && !Hash::check($request->current_password, $akunuser->password)) {
                $validator->errors()->add('current_password', 'Password tidak sesuai');
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->except('password', 'new_password', 'current_password', 'new_password_confirmation');
        if ($request->filled('new_password')) {
            $data['password'] = Hash::make($request->new_password);
        }
        $akunuser->update($data);
        if ($akunuser->pegawai) {
            $akunuser->pegawai->update($request->only('pegawai_nip', 'pegawai_nama', 'pegawai_alamat', 'pegawai_nohp'));
        }

        return redirect()->route('profilwasbitnak', $akunuser->user_id)->with('berhasil.edit', 'Akun berhasil diperbarui');
    }

    //PPID - PROFIL
    public function profilppid($id)
    {
        $akunuser = User::with('pembeli')->where('user_id', $id)->first();
        return view('backend.ppid.profil.detail', ["akunuser" => $akunuser, "pembeli" => $akunuser->pembeli]);
    }
    public function editppid($id)
    {
        $akunuser = User::with('pegawai')->findOrFail($id);
        return view('backend.ppid.profil.edit', compact('akunuser'));
    }
    public function updateppid(Request $request, $id)
    {
        $akunuser = User::with('pegawai')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'pegawai_nip' => 'required|string',
            'pegawai_nama' => 'required|string',
            'pegawai_alamat' => 'required|string',
            'pegawai_nohp' => 'required',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|confirmed',
        ]);

        // dd($request->all());

        $validator->after(function ($validator) use ($request, $akunuser) {
            if ($request->filled('current_password') && !Hash::check($request->current_password, $akunuser->password)) {
                $validator->errors()->add('current_password', 'Password tidak sesuai');
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->except('password', 'new_password', 'current_password', 'new_password_confirmation');
        if ($request->filled('new_password')) {
            $data['password'] = Hash::make($request->new_password);
        }
        $akunuser->update($data);
        if ($akunuser->pegawai) {
            $akunuser->pegawai->update($request->only('pegawai_nip', 'pegawai_nama', 'pegawai_alamat', 'pegawai_nohp'));
        }

        return redirect()->route('detail.profil.ppid', $akunuser->user_id)->with('berhasil.edit', 'Akun berhasil diperbarui');
    }

    //PEMBELI - PROFIL
    public function profilpembeliakun($id)
    {
        $akunuser = User::with('pembeli')->where('user_id', $id)->first();
        return view('backend.pembeli.profil.detail', ["akunuser" => $akunuser, "pembeli" => $akunuser->pembeli]);
    }
    public function updatepembeliakun(Request $request, $id)
    {
        $akunuser = User::with('pembeli')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'pembeli_instansi' => 'required|string',
            'pembeli_nama' => 'required|string',
            'pembeli_alamat' => 'required|string',
            'pembeli_nohp' => 'required|string',
            'pembeli_lahir' => 'required|date',
            'current_password' => 'required_if:change_password,on',
            'new_password' => 'nullable|min:5|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update email
        $akunuser->email = $request->email;
        $akunuser->save();

        // Update data pembeli
        if ($akunuser->pembeli) {
            $akunuser->pembeli->update($request->only('pembeli_instansi', 'pembeli_nama', 'pembeli_alamat', 'pembeli_nohp', 'pembeli_lahir'));
        }

        // Update password jika checkbox dicentang dan password valid
        if ($request->has('change_password') && $request->change_password == 'on') {
            if (!Hash::check($request->current_password, $akunuser->password)) {
                return redirect()->back()->withErrors(['current_password' => 'Password saat ini salah'])->withInput();
            }
            $akunuser->password = Hash::make($request->new_password);
            $akunuser->save();
        }

        return redirect()->route('detail.profil.pembeli', $akunuser->user_id)->with('success', 'Akun berhasil diperbarui');
    }

    //KEPALA BALAI - PROFIL
    public function profilkepala($user_id)
    {
        $akunuser = User::with('pegawai')->where('user_id', $user_id)->first();
        return view('backend.kepala.profil.detail', ["akunuser" => $akunuser, "pegawai" => $akunuser->pegawai]);
    }
    public function editkepala($id)
    {
        $akunuser = User::with('pegawai')->findOrFail($id);
        return view('backend.kepala.profil.edit', compact('akunuser'));
    }
    public function updatekepala(Request $request, $id)
    {
        $akunuser = User::with('pegawai')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'pegawai_nip' => 'required|string',
            'pegawai_nama' => 'required|string',
            'pegawai_alamat' => 'required|string',
            'pegawai_nohp' => 'required',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|confirmed',
        ]);

        // dd($request->all());

        $validator->after(function ($validator) use ($request, $akunuser) {
            if ($request->filled('current_password') && !Hash::check($request->current_password, $akunuser->password)) {
                $validator->errors()->add('current_password', 'Password tidak sesuai');
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->except('password', 'new_password', 'current_password', 'new_password_confirmation');
        if ($request->filled('new_password')) {
            $data['password'] = Hash::make($request->new_password);
        }
        $akunuser->update($data);
        if ($akunuser->pegawai) {
            $akunuser->pegawai->update($request->only('pegawai_nip', 'pegawai_nama', 'pegawai_alamat', 'pegawai_nohp'));
        }

        return redirect()->route('detail.profil.kepala', $akunuser->user_id)->with('berhasil.edit', 'Akun berhasil diperbarui');
    }

    //WASTUKAN - PROFIL
    public function profilwastukan($user_id)
    {
        $akunuser = User::with('pegawai')->where('user_id', $user_id)->first();
        return view('backend.wastukan.profil.detailprofil', ["akunuser" => $akunuser, "pegawai" => $akunuser->pegawai]);
    }
    public function editwastukan($id)
    {
        $akunuser = User::with('pegawai')->findOrFail($id);
        return view('backend.wastukan.profil.edit', compact('akunuser'));
    }
    public function updatewastukan(Request $request, $id)
    {
        $akunuser = User::with('pegawai')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'pegawai_nip' => 'required|string',
            'pegawai_nama' => 'required|string',
            'pegawai_alamat' => 'required|string',
            'pegawai_nohp' => 'required',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|confirmed',
        ]);

        // dd($request->all());

        $validator->after(function ($validator) use ($request, $akunuser) {
            if ($request->filled('current_password') && !Hash::check($request->current_password, $akunuser->password)) {
                $validator->errors()->add('current_password', 'Password tidak sesuai');
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->except('password', 'new_password', 'current_password', 'new_password_confirmation');
        if ($request->filled('new_password')) {
            $data['password'] = Hash::make($request->new_password);
        }
        $akunuser->update($data);
        if ($akunuser->pegawai) {
            $akunuser->pegawai->update($request->only('pegawai_nip', 'pegawai_nama', 'pegawai_alamat', 'pegawai_nohp'));
        }

        return redirect()->route('profilwastukan', $akunuser->user_id)->with('berhasil.edit', 'Akun berhasil diperbarui');
    }

    //WASTUKAN - PROFIL
    public function profilbendahara($user_id)
    {
        $akunuser = User::with('pegawai')->where('user_id', $user_id)->first();
        return view('backend.bendahara.profil.detail', ["akunuser" => $akunuser, "pegawai" => $akunuser->pegawai]);
    }
    public function editbendahara($id)
    {
        $akunuser = User::with('pegawai')->findOrFail($id);
        return view('backend.bendahara.profil.edit', compact('akunuser'));
    }
    public function updatebendahara(Request $request, $id)
    {
        $akunuser = User::with('pegawai')->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'pegawai_nip' => 'required|string',
            'pegawai_nama' => 'required|string',
            'pegawai_alamat' => 'required|string',
            'pegawai_nohp' => 'required',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|confirmed',
        ]);

        // dd($request->all());

        $validator->after(function ($validator) use ($request, $akunuser) {
            if ($request->filled('current_password') && !Hash::check($request->current_password, $akunuser->password)) {
                $validator->errors()->add('current_password', 'Password tidak sesuai');
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->except('password', 'new_password', 'current_password', 'new_password_confirmation');
        if ($request->filled('new_password')) {
            $data['password'] = Hash::make($request->new_password);
        }
        $akunuser->update($data);
        if ($akunuser->pegawai) {
            $akunuser->pegawai->update($request->only('pegawai_nip', 'pegawai_nama', 'pegawai_alamat', 'pegawai_nohp'));
        }

        return redirect()->route('profilbendahara', $akunuser->user_id)->with('berhasil.edit', 'Akun berhasil diperbarui');
    }
}
