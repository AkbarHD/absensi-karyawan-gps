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

                <td>
                    <a href="javascript:;" class="btn btn-primary tampilkanpeta" id="{{ $item->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-map-2">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5" />
                            <path d="M9 4v13" />
                            <path d="M15 7v5.5" />
                            <path
                                d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" />
                            <path d="M19 18v.01" />
                        </svg>
                    </a>
                </td>
            </tr>
        @endforeach
    @endif

    <script>
        $(document).ready(function() {
            $('.tampilkanpeta').on('click', function() {
                var id = $(this).attr('id');
                $.ajax({
                    type: 'POST',
                    url: '/tampilkanpeta',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    cache: false,
                    success: function(respond) {
                        $('#loadmap').html(respond);
                    }
                });
                $('#modal-tampilkanpeta').modal('show');
            });
        });
    </script>
