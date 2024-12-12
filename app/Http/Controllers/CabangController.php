<?php

namespace App\Http\Controllers;

use \Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CabangController extends Controller
{
    public function index()
    {
        $cabang = DB::table('cabang')->orderBy('kode_cabang')->get();
        return view('cabang.index', compact('cabang'));
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'kode_cabang' => $request->kode_cabang,
                'nama_cabang' => $request->nama_cabang,
                'lokasi_cabang' => $request->lokasi_cabang,
                'radius_cabang' => $request->radius
            ];
            // dd($data);
            DB::table('cabang')->insert($data);
            return redirect()->back()->with('success', 'Data Cabang berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data gagal disimpan');
        }
    }

    public function edit(Request $request)
    {
        $kode_cabang = $request->kode_cabang;
        $cabang = DB::table('cabang')->where('kode_cabang', $kode_cabang)->first();
        return view('cabang.edit', compact('cabang'));
    }

    public function update($kode_cabang, Request $request)
    {
        try {
            $data = [
                'kode_cabang' => $request->kode_cabang,
                'nama_cabang' => $request->nama_cabang,
                'lokasi_cabang' => $request->lokasi_cabang,
                'radius_cabang' => $request->radius
            ];
            DB::table('cabang')->where('kode_cabang', $kode_cabang)->update($data);
            return redirect()->back()->with('success', 'Data cabang berhasil ditambahkan');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data cabang gagal ditambahkan');
        }
    }

    public function delete($kode_cabang)
    {
        try {

            DB::table('cabang')->where('kode_cabang', $kode_cabang)->delete();
            return redirect()->back()->with('success', 'Data cabang berhasil dihapus');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data cabang gagal ditambahkan');
        }
    }

}
