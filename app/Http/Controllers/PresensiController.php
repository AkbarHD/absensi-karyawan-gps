<?php

namespace App\Http\Controllers;

use App\Models\PengajuanIzin;
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
        $lok_kantor = DB::table('konfigurasi_lokasi')->where('id', 1)->first();
        // dd($lokasi_kantor);
        return view('presensi.create', compact('cek', 'lok_kantor'));
    }

    public function store(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_presensi = date('Y-m-d');
        $jam_in = date('H:i:s');
        // validasi radius
        $lok_kantor = DB::table('konfigurasi_lokasi')->where('id', 1)->first();
        $lok = explode(",", $lok_kantor->lokasi_kantor);
        $latitudekantor = $lok[0];
        $longitudekantor = $lok[1];
        // ambil dari ajax
        $lokasi = $request->lokasi;
        // dd($lokasi);
        $lokasiuser = explode(",", $lokasi);
        $latitudeuser = $lokasiuser[0];
        $longitudeuser = $lokasiuser[1];
        //
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
        // dd($image_parts);
        // di decode
        $image_base64 = base64_decode($image_parts[1]);
        // file asli foto absensi
        $fileName = $formatName . ".png";
        // letak folder dan nama file
        $file = $folderPath . $fileName;
        // cek user sudah absen atau belum
        if ($radius > $lok_kantor->radius) {
            echo "error|Maaf anda berada diluar radius, Jarak anda " . $radius . " meter dari kantor|radius";
        } else {
            if ($cek > 0) {
                // cek user sudah absen pulang atau belum
                $presensi = DB::table('presensi')
                    ->where('tgl_presensi', $tgl_presensi)
                    ->where('nik', $nik)
                    ->first();

                if ($presensi->jam_out) {
                    // Jika jam_out sudah terisi, beri pesan error
                    echo "error|Anda sudah absen pulang, tidak dapat absen lagi hari ini|out";
                    return;
                }
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
            $foto = null;
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
                Storage::delete('public/uploads/karyawan/' . $karyawan->foto);
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
        $nik = Auth::guard('karyawan')->user()->nik;
        $dataizin = DB::table('pengajuan_izin')->where('nik', $nik)->get();
        return view('presensi.izin', compact('dataizin'));
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

    public function monitoring()
    {
        return view('presensi.monitoring');
    }

    public function getpresensi(Request $request)
    {
        $tanggal = $request->tanggal;
        // dd($tanggal);
        $presensi = DB::table('presensi')
            ->select('presensi.*', 'nama_dept', 'nama_lengkap')
            ->join('karyawan', 'presensi.nik', '=', 'karyawan.nik')
            ->join('departemen', 'karyawan.kode_dept', '=', 'departemen.kode_dept')
            ->where('tgl_presensi', $tanggal)
            ->get();

        return view('presensi.getpresensi', compact('presensi'));
    }

    public function tampilkanpeta(Request $request)
    {
        $id = $request->id;
        $presensi = DB::table('presensi')->where('id', $id)
            ->join('karyawan', 'presensi.nik', '=', 'karyawan.nik')
            ->first();
        return view('presensi.showmap', compact('presensi'));
    }

    public function laporan()
    {
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "Sepetember", "Oktober", "November", "Desember"];
        $karyawan = DB::table('karyawan')->orderBy('nama_lengkap')->get();
        return view('presensi.laporan', compact('namabulan', 'karyawan'));
    }

    public function cetaklaporan(Request $request)
    {
        $nik = $request->nik;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "Sepetember", "Oktober", "November", "Desember"];
        $karyawan = DB::table('karyawan')->where('nik', $nik)
            ->join('departemen', 'karyawan.kode_dept', '=', 'departemen.kode_dept')
            ->first();
        $presensi = DB::table('presensi')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->where('nik', $nik)
            ->orderBy('tgl_presensi')
            ->get();
        if ($request->has('exportexcel')) {
            // Set header untuk export Excel
            $time = date('d-M-Y H:i:s');
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=Rekap_Presensi_$time.xls");
            header("Pragma: no-cache");
            header("Expires: 0");
            return view('presensi.cetaklaporanexcel', compact('bulan', 'tahun', 'namabulan', 'karyawan', 'presensi'));
        }

        return view('presensi.cetaklaporan', compact('bulan', 'tahun', 'namabulan', 'karyawan', 'presensi'));
    }

    public function rekap()
    {
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "Sepetember", "Oktober", "November", "Desember"];
        return view('presensi.rekap', compact('namabulan'));
    }

    public function cetakrekap(Request $request)
    {

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "Sepetember", "Oktober", "November", "Desember"];
        $rekap = DB::table('presensi')
            ->selectRaw("
        presensi.nik,
        karyawan.nama_lengkap,
        MAX(IF(DAY(tgl_presensi) = 1, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_1,
        MAX(IF(DAY(tgl_presensi) = 2, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_2,
        MAX(IF(DAY(tgl_presensi) = 3, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_3,
        MAX(IF(DAY(tgl_presensi) = 4, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_4,
        MAX(IF(DAY(tgl_presensi) = 5, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_5,
        MAX(IF(DAY(tgl_presensi) = 6, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_6,
        MAX(IF(DAY(tgl_presensi) = 7, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_7,
        MAX(IF(DAY(tgl_presensi) = 8, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_8,
        MAX(IF(DAY(tgl_presensi) = 9, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_9,
        MAX(IF(DAY(tgl_presensi) = 10, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_10,
        MAX(IF(DAY(tgl_presensi) = 11, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_11,
        MAX(IF(DAY(tgl_presensi) = 12, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_12,
        MAX(IF(DAY(tgl_presensi) = 13, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_13,
        MAX(IF(DAY(tgl_presensi) = 14, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_14,
        MAX(IF(DAY(tgl_presensi) = 15, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_15,
        MAX(IF(DAY(tgl_presensi) = 16, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_16,
        MAX(IF(DAY(tgl_presensi) = 17, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_17,
        MAX(IF(DAY(tgl_presensi) = 18, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_18,
        MAX(IF(DAY(tgl_presensi) = 19, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_19,
        MAX(IF(DAY(tgl_presensi) = 20, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_20,
        MAX(IF(DAY(tgl_presensi) = 21, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_21,
        MAX(IF(DAY(tgl_presensi) = 22, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_22,
        MAX(IF(DAY(tgl_presensi) = 23, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_23,
        MAX(IF(DAY(tgl_presensi) = 24, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_24,
        MAX(IF(DAY(tgl_presensi) = 25, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_25,
        MAX(IF(DAY(tgl_presensi) = 26, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_26,
        MAX(IF(DAY(tgl_presensi) = 27, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_27,
        MAX(IF(DAY(tgl_presensi) = 28, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_28,
        MAX(IF(DAY(tgl_presensi) = 29, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_29,
        MAX(IF(DAY(tgl_presensi) = 30, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_30,
        MAX(IF(DAY(tgl_presensi) = 31, CONCAT(jam_in, '-', IFNULL(jam_out, '00:00:00')), '')) AS tgl_31")
            ->join('karyawan', 'presensi.nik', '=', 'karyawan.nik')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->groupBy('presensi.nik', 'karyawan.nama_lengkap')
            ->get();
        // dd($rekap);
        if ($request->has('exportexcel')) {
            // Set header untuk export Excel
            $time = date('d-M-Y H:i:s');
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=Rekap_Presensi_$time.xls");
            header("Pragma: no-cache");
            header("Expires: 0");

        }
        return view('presensi.cetakrekap', compact('bulan', 'tahun', 'rekap', 'namabulan'));
    }

    public function izinsakit(Request $request)
    {
        // $izinsakit = DB::table('pengajuan_izin')
        //     ->join('karyawan', 'pengajuan_izin.nik', '=', 'karyawan.nik')
        //     ->get();
        $query = PengajuanIzin::query();
        $query->select('id', 'tgl_izin', 'pengajuan_izin.nik', 'nama_lengkap', 'jabatan', 'status', 'status_approved');
        $query->join('karyawan', 'pengajuan_izin.nik', '=', 'karyawan.nik');
        if (!empty($request->dari) && !empty($request->sampai)) {
            $query->whereBetween('tgl_izin', [$request->dari, $request->sampai]);
        }

        if (!empty($request->nik)) {
            $query->where('pengajuan_izin.nik', $request->nik);
        }

        if (!empty($request->nama_lengkap)) {
            $query->where('nama_lengkap', 'like', '%' . $request->nama_lengkap . '%');
        }

        if ($request->status_approved !== null) {
            $query->where('status_approved', $request->status_approved);
        }
        $query->orderBy('tgl_izin', 'DESC');
        $izinsakit = $query->paginate(2);
        $izinsakit->appends($request->all());
        return view('presensi.izinsakit', compact('izinsakit'));
    }

    public function approveizinsakit(Request $request)
    {
        $status_approved = $request->status_approved;
        $id = $request->id_formizin;
        $update = DB::table('pengajuan_izin')->where('id', $id)->update([
            'status_approved' => $status_approved
        ]);
        if ($update) {
            return redirect()->back()->with('success', 'Data pengajuan berhasil di setujui');
        } else {
            return redirect()->back()->with('error', 'Data pengajuan gagal di setujui');
        }
    }

    public function batalkanizinsakit($id)
    {
        $update = DB::table('pengajuan_izin')->where('id', $id)->update([
            'status_approved' => 0
        ]);
        if ($update) {
            return redirect()->back()->with('success', 'Data berhasil di perbaruikan');
        } else {
            return redirect()->back()->with('error', 'Data gagal di perbaruikan');

        }
    }

    public function cekpengajuanizin(Request $request)
    {
        $tgl_izin = $request->tgl_izin;
        $nik = Auth::guard('karyawan')->user()->nik;
        $cekpengajuanizin = DB::table('pengajuan_izin')->where('tgl_izin', $tgl_izin)->where('nik', $nik)->count();
        return $cekpengajuanizin;
    }
}
