<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KonfigurasiController extends Controller
{
    public function lokasikantor()
    {
        $lok_kantor = DB::table('konfigurasi_lokasi')->where('id', 1)->first();
        return view('konfigurasi.lokasikantor', compact('lok_kantor'));
    }

    public function updatelokasikantor(Request $request)
    {
        $lokasi_kantor = $request->lokasi_kantor;
        $radius = $request->radius;
        $data = [
            'lokasi_kantor' => $lokasi_kantor,
            'radius' => $radius,
        ];
        $simpan = DB::table('konfigurasi_lokasi')->where('id', 1)->update($data);
        if ($simpan) {
            return redirect()->route('lokasikantor')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->route('lokasikantor')->with('error', 'Data gagal disimpan');
        }
    }

    public function jamkerja()
    {
        return view('konfigurasi.jamkerja');
    }
}
