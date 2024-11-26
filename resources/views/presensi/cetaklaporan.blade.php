<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>A4</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
        @page {
            size: A4
        }

        h3 {
            font-family: Arial, Helvetica, sans-serif
        }

        #title {
            font-weight: bold;
            font-size: 18px;
            font-family: Arial, Helvetica, sans-serif
        }

        .tabledatakaryawan {
            margin-top: 50px;

        }

        .tabledatakaryawan td {
            padding: 5px;
        }

        .tablepresensi {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
        }

        .tablepresensi tr th {
            border: 1px solid #131212;
            padding: 8px;
            background-color: #dbdbdb;
        }

        .tablepresensi tr td {
            border: 1px solid #131212;
            padding: 8px;
            font-size: 12px;
        }

        .foto {
            width: 40px;
            height: 30px;
        }
    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4">

    <!-- Each sheet element should have the class "sheet" -->
    <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
    <section class="sheet padding-10mm">

        <!-- Write HTML just like a web page -->
        <table style="width: 100%;">
            <tr>
                <td style="width: 11%">
                    <img src="{{ asset('assets/img/logo-perusahaan.jpg') }}" width="70" height="70">
                </td>
                <td>
                    <span id="title">
                        Laporan Presensi karyawan <br>
                        PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }} <br>
                        PT.AKBAR HOSSAM
                    </span>
                    <br>
                    <span>Jl. Griya Serpong Asri Lapan Komplek Pergudangan Raya Bogor</span>
                </td>
            </tr>
        </table>

        <table class="tabledatakaryawan">
            <tr>
                @if (empty($item->foto))
                    <td rowspan="6">
                        <img style="width: 120px; height: 150px;" src="{{ asset('no-foto.jpg') }}"
                            alt="{{ $karyawan->nama_lengkap }}">
                    </td>
                @else
                    <td rowspan="6">
                        <img style="width: 70px;" src="{{ Storage::url('uploads/karyawan/' . $karyawan->foto) }}"
                            alt="{{ $karyawan->nama_lengkap }}">
                    </td>
                @endif
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>{{ $karyawan->nik }}</td>
            </tr>
            <tr>
                <td>Nama Karyawan</td>
                <td>:</td>
                <td>{{ $karyawan->nama_lengkap }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>{{ $karyawan->jabatan }}</td>
            </tr>
            <tr>
                <td>Nama Departemnt</td>
                <td>:</td>
                <td>{{ $karyawan->nama_dept }}</td>
            </tr>
            <tr>
                <td>No Handhone</td>
                <td>:</td>
                <td>{{ $karyawan->no_hp }}</td>
            </tr>
        </table>

        <table class="tablepresensi">
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>NIK</th>
                <th>Jam Masuk</th>
                <th>Foto</th>
                <th>Jam Pulang</th>
                <th>Foto</th>
                <th>Keterangan</th>
            </tr>
            @forelse ($presensi as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ date('d-m-Y', strtotime($item->tgl_presensi)) }}</td>
                    <td>{{ $item->nik }}</td>
                    <td>{{ $item->jam_in }}</td>
                    <td>
                        <img src="{{ Storage::url('uploads/absensi/' . $item->foto_in) }}" alt=""
                            class="foto">
                    </td>
                    <td>{{ $item->jam_out == null ? 'belum absen' : $item->jam_out }}</td>
                    <td>
                        @if ($item->foto_out == null)
                            <p></p>
                        @else
                            <img src="{{ Storage::url('uploads/absensi/' . $item->foto_out) }}" alt=""
                                class="foto">
                        @endif
                    </td>
                    <td>
                        @if ($item->jam_in > '07.00')
                            <p>Terlambat</p>
                        @else
                            <p>Tepat waktu</p>
                        @endif
                    </td>
                </tr>
            @empty
            @endforelse

        </table>

    </section>

</body>

</html>
