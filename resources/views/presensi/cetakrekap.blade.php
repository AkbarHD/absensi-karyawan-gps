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
            padding: 5px;
            background-color: #dbdbdb;
            font-size: 8px;
            text-align: center;
            margin: 0;
        }

        .tablepresensi tr td {
            border: 1px solid #131212;
            padding: 5px;
            font-size: 8px;
            text-align: center;
            margin: 0;
        }

        .foto {
            width: 40px;
            height: 30px;
        }

        .tanda-tangan {
            margin-top: 100px !important;
        }
    </style>
</head>

<body class="A4 landscape">

    <section class="sheet padding-10mm">

        <!-- Write HTML just like a web page -->
        <table style="width: 100%;">
            <tr>
                <td style="width: 11%">
                    <img src="{{ asset('assets/img/logo-perusahaan.jpg') }}" width="70" height="70">
                </td>
                <td>
                    <span id="title">
                        Rekap Presensi karyawan <br>
                        PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }} <br>
                        PT.AKBAR HOSSAM
                    </span>
                    <br>
                    <span>Jl. Griya Serpong Asri Lapan Komplek Pergudangan Raya Bogor</span>
                </td>
            </tr>
        </table>

        <table class="tablepresensi">
            <tr>
                <th rowspan="2">NIK</th>
                <th rowspan="2">Nama Karyawan</th>
                <th colspan="31">Tanggal</th>
                <th rowspan="2">TH</th>
                <th rowspan="2">TT</th>
            </tr>
            <tr>
                <?php
                for ($i = 1; $i <= 31; $i++){
                ?>
                <th>{{ $i }}</th>
                <?php
                }
                ?>
            </tr>
            @forelse ($rekap as $d)
                <tr>
                    <td>{{ $d->nik }}</td>
                    <td>{{ $d->nama_lengkap }}</td>
                    <?php
                        $totalhadir = 0;
                        $totalterlambat = 0;
                    for($i = 1; $i <= 31; $i++){
                        $tgl = "tgl_" . $i;
                        // karena semua data tidak semuanya terisi maka kit atasi
                        if(empty($d->$tgl)){
                            $hadir = ['', ''];
                            $totalhadir += 0;
                        }else{
                            $hadir = explode("-", $d->$tgl);
                            $totalhadir += 1;
                            if($hadir[0] > '07:00:00'){
                                $totalterlambat += 1;
                            }
                        }
                     ?>
                    {{-- <td>{{ $hadir[0] }} - {{ $hadir[1] }}</td> --}}
                    <td>
                        <span
                            style="font-size: 8px; color:{{ $hadir[0] > '07:00:00' ? 'red' : '' }}">{{ $hadir[0] }}</span>
                        <span style="font-size: 8px;">{{ $hadir[1] }}</span>
                    </td>
                    <?php
                    }
                    ?>
                    <td>{{ $totalhadir }}</td>
                    <td>{{ $totalterlambat }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="33" style="text-align: center;">Tidak ada data tersedia</td>
                </tr>
            @endforelse

        </table>

        <table style="width: 100%;" class="tanda-tangan">
            <tr>
                <td style="text-align: center; transform: translateX();">Tangerang, {{ date('d-m-Y') }}</td>
                <td style="text-align: center; transform: translateX();">Tangerang, {{ date('d-m-Y') }}</td>
            </tr>
            <tr>
                <td style="text-align: center; vertical-align: bottom; height: 100px;">
                    <u>Anjely Febby</u> <br>
                    <i><b>Marketplace Specialist</b></i>
                </td>
                <td style="text-align: center; vertical-align: bottom;">
                    <u>Akbar Hossam Delmiro</u> <br>
                    <i><b>Head Of IT</b></i>
                </td>
            </tr>
        </table>

    </section>

</body>

</html>
