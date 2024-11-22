    <?php
    function selisih($jam_masuk, $jam_keluar)
    {
        [$h, $m, $s] = explode(':', $jam_masuk);
        $dtAwal = mktime($h, $m, $s, '1', '1', '1');
        [$h, $m, $s] = explode(':', $jam_keluar);
        $dtAkhir = mktime($h, $m, $s, '1', '1', '1');
        $dtSelisih = $dtAkhir - $dtAwal;
        $totalmenit = $dtSelisih / 60;
        $jam = explode('.', $totalmenit / 60);
        $sisamenit = $totalmenit / 60 - $jam[0];
        $sisamenit2 = $sisamenit * 60;
        $jml_jam = $jam[0];
        return $jml_jam . ':' . round($sisamenit2);
    }
    ?>
    @if ($presensi->isEmpty())
        <tr>
            <td colspan="8" class="text-center">Data presensi tidak ditemukan untuk tanggal tersebut.</td>
        </tr>
    @else
        @foreach ($presensi as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nik }}</td>
                <td>{{ $item->nama_lengkap }}</td>
                <td>{{ $item->nama_dept }}</td>
                <td>{{ $item->jam_in }}</td>
                <td><img src="{{ asset('storage/uploads/absensi/' . $item->foto_in) }}" alt="Foto Masuk" width="50">
                </td>
                <td>
                    @if ($item->jam_out)
                        {{ $item->jam_out }}
                    @else
                        <span class="badge bg-danger text-white">Belum Absen</span>
                    @endif
                </td>
                <td>
                    @if ($item->foto_out)
                        <img src="{{ asset('storage/uploads/absensi/' . $item->foto_out) }}" alt="Foto Keluar"
                            width="50">
                    @else
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-stopwatch">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 13a7 7 0 1 0 14 0a7 7 0 0 0 -14 0z" />
                                <path d="M14.5 10.5l-2.5 2.5" />
                                <path d="M17 8l1 -1" />
                                <path d="M14 3h-4" />
                            </svg>
                        </span>
                    @endif
                </td>
                <td>
                    @if ($item->jam_in > '07.00')
                        @php
                            $terlambat = selisih('07:00:00', $item->jam_in);
                        @endphp
                        <span class="badge bg-danger text-white">Terlambat {{ $terlambat }}</span>
                    @else
                        <span class="badge bg-success text-white">Tepat waktu</span>
                    @endif
                </td>

            </tr>
        @endforeach
    @endif
