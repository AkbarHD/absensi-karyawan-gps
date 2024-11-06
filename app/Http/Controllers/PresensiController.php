<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{
    public function create()
    {
        // CEK user sudah absen atau belum
        $hariini = date('Y-m-d');
        $nik = Auth::guard('karyawan')->user()->nik;
        $cek = DB::table('presensi')->where('tgl_presensi', $hariini)->where('nik', $nik)->count();
        return view('presensi.create', compact('cek'));
    }

    public function store(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_presensi = date('Y-m-d');
        $jam_in = date('H:i:s');
        // validasi radius
        $latitudekantor = -6.353523;
        $longitudekantor = 106.63184;
        // ambil dari ajax
        $lokasi = $request->lokasi;
        // dd($lokasi);
        $lokasiuser = explode(",", $lokasi);
        $latitudeuser = $lokasiuser[0];
        $longitudeuser = $lokasiuser[1];
        $jarak = $this->distance($latitudekantor, $longitudekantor, $latitudeuser, $longitudeuser);
        $radius = round($jarak['meters']);
        // dd($radius);
        // dd($lokasi);
        // fungsi agar foto tidak ke replace
        $cek = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->count();
        if ($cek > 0) {
            $ket = 'in';
        } else {
            $ket = 'out';
        }
        $image = $request->image;
        // posisi folder
        $folderPath = "public/uploads/absensi/";
        // nama file gambar foto absensi
        $formatName = $nik . "-" . $tgl_presensi . '-' . $ket;
        // di explode
        $image_parts = explode(";base64,", $image);
        // di decode
        $image_base64 = base64_decode($image_parts[1]);
        // file asli foto absensi
        $fileName = $formatName . ".png";
        // letak folder dan nama file
        $file = $folderPath . $fileName;
        // cek user sudah absen atau belum
        if ($radius > 50) {
            echo "error|Maaf anda berada diluar radius, Jarak anda " . $radius . " meter dari kantor|radius";
        } else {
            if ($cek > 0) {
                // simpan to database
                $data = [
                    'jam_out' => $jam_in,
                    'lokasi_out' => $lokasi,
                    'foto_out' => $fileName
                ];
                $update = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nik', $nik)->update($data);
                if ($update) {
                    echo "success|Terimakasih, Hati Hati Di jalan|out";
                    Storage::put($file, $image_base64);
                } else {
                    echo "error|Maaf Gagal absen, Silahkan hubungi tim IT|out";
                }
            } else {
                // simpan to database
                $data = [
                    'nik' => $nik,
                    'tgl_presensi' => $tgl_presensi,
                    'jam_in' => $jam_in,
                    'lokasi_in' => $lokasi,
                    'foto_in' => $fileName
                ];
                $simpan = DB::table('presensi')->insert($data);
                if ($simpan) {
                    echo "success|Terimakasih, Selamat bekerja|in";
                    Storage::put($file, $image_base64);
                } else {
                    echo "error|Maaf Gagal absen, Silahkan hubungi tim IT|in";
                }
            }

        }

    }

    //Menghitung Jarak antara titik koordinat
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }
}