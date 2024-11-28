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
            font-size: 10px;
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

        .tanda-tangan {
            margin-top: 100px !important;
        }
    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4 landscape">

    ?>

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
                    for($i = 1; $i <= 31; $i++){
                        $tgl = "tgl_" . $i;
                     ?>
                    <td>{{ $d->$tgl }}</td>
                    <?php
                    }
                    ?>
                </tr>
            @empty
            @endforelse

        </table>

        <table style="width: 100%;" class="tanda-tangan">
            <tr>
                <td style="text-align: center; transform: translateX();">Tangerang, 27-11-2024</td>
                <td style="text-align: center; transform: translateX();">Tangerang, 27-11-2024</td>
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
