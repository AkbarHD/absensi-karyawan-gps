<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        // $karyawan = DB::table('karyawan')->orderBy('nama_lengkap')
        //     ->join('departemen', 'karyawan.kode_dept', '=', 'departemen.kode_dept')
        //     ->paginate(1);
        $query = Karyawan::query();
        $query->select('karyawan.*', 'nama_dept');
        $query->join('departemen', 'karyawan.kode_dept', '=', 'departemen.kode_dept');
        $query->orderBy('nama_lengkap');
        if (!empty($request->nama_karyawan)) {
            $query->where('karyawan.nama_lengkap', 'like', '%' . $request->nama_karyawan . '%');
        }
        if (!empty($request->kode_dept)) {
            $query->where('karyawan.kode_dept', 'like', '%' . $request->kode_dept . '%');
        }
        $karyawan = $query->paginate(1);
        $department = DB::table('departemen')->get();
        return view('karyawan.index', compact('karyawan', 'department'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nik' => 'required|string|size:5',
                'nama_lengkap' => 'required|string|max:255',
                'jabatan' => 'required|string|max:100',
                'no_hp' => 'required|string|max:15',
                'kode_dept' => 'required',
                'foto' => 'nullable|file|mimes:jpg,png,jpeg|max:2048',
            ], [
                'nik.required' => 'NIK wajib diisi.',
                'nik.size' => 'NIK harus terdiri dari 5 karakter.',
                'nama_lengkap.required' => 'Nama Lengkap wajib diisi.',
                'jabatan.required' => 'Jabatan wajib diisi.',
                'no_hp.required' => 'Nomor Telepon wajib diisi.',
                'kode_dept.required' => 'Departemen wajib dipilih.',
                'foto.mimes' => 'Foto harus berupa file berformat jpg, jpeg, atau png.',
                'foto.max' => 'Ukuran foto maksimal 2MB.',
            ]);

            $nik = $request->nik;
            $nama_lengkap = $request->nama_lengkap;
            $jabatan = $request->jabatan;
            $no_hp = $request->no_hp;
            $kode_dept = $request->kode_dept;
            $password = Hash::make('password');

            $foto = null;
            if ($request->hasFile('foto')) {
                $foto = $nik . '.' . $request->file('foto')->getClientOriginalExtension();
            }

            $data = [
                'nik' => $nik,
                'nama_lengkap' => $nama_lengkap,
                'jabatan' => $jabatan,
                'no_hp' => $no_hp,
                'kode_dept' => $kode_dept,
                'password' => $password,
                'foto' => $foto,
            ];

            $simpan = DB::table('karyawan')->insert($data);
            if ($simpan && $request->hasFile('foto')) {
                $request->file('foto')->storeAs('public/uploads/karyawan', $foto);
            }

            return redirect()->back()->with('success', 'Data Karyawan berhasil disimpan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Tangkap error validation dan masukkan ke sesi
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data gagal disimpan: ' . $e->getMessage());
        }
    }

}
