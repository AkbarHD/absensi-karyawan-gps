<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $latitudekantor = -6.3908;
        $longitudekantor = 106.7243;
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
            $ket = 'out';
        } else {
            $ket = 'in';
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
        if ($radius > 60) {
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

    public function editprofile()
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
        return view('presensi.editprofile', compact('karyawan'));
    }

    public function updateprofile(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $nama_lengkap = $request->nama_lengkap;
        $no_hp = $request->no_hp;
        $password = $request->password; // Ambil input password dari request
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();

        // jika click tombol ganti foto
        if ($request->hasFile('foto')) {
            $foto = $nik . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $karyawan->foto;
        }

        // Periksa apakah password diisi
        if (!empty($password)) {
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'no_hp' => $no_hp,
                'password' => Hash::make($password), // Hash password hanya jika diisi
                'foto' => $foto
            ];
        } else {
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'no_hp' => $no_hp,
                'foto' => $foto
            ];
        }

        $update = DB::table('karyawan')->where('nik', $nik)->update($data);
        if ($update) {
            if ($request->hasFile('foto')) {
                $request->file('foto')->storeAs('public/uploads/karyawan/', $foto);
            }
            return redirect()->back()->with('success', 'Data berhasil diupdate');
        } else {
            return redirect()->back()->with('error', 'Data gagal diupdate');
        }
    }

    public function histori()
    {
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "Sepetember", "Oktober", "November", "Desember"];
        return view('presensi.histori', compact('namabulan'));
    }

    public function gethistori(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        // apa yang di hasilkan di sini akan di tangkap oleh respond success
        // echo $bulan . ' ' . $tahun;
        $nik = Auth::guard('karyawan')->user()->nik;
        $histori = DB::table('presensi')->where('nik', $nik)
            ->whereMonth('tgl_presensi', $bulan)->whereYear('tgl_presensi', $tahun)
            ->orderBy('tgl_presensi', 'asc')
            ->get();

        // muncul di network bukan di console.log dan di console.log(respond)
        // dd($histori);
        return view('presensi.gethistori', compact('histori'));
    }

    public function izin()
    {
        return view('presensi.izin');
    }

    public function buatizin()
    {
        return view('presensi.buatizin');
    }

    public function storeizin(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $data = [
            'nik' => $nik,
            'tgl_izin' => $request->tgl_izin,
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ];
        $simpan = DB::table('pengajuan_izin')->insert($data);
        if ($simpan) {
            return redirect()->route('presensi.izin')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->route('presensi.izin')->with('error', 'Data gagal disimpan');
        }
    }

}
