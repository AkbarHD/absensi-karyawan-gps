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
            <td>{{ $item->jam_masuk }}</td>
            {{-- <td><img src="{{ asset('storage/' . $item->foto_masuk) }}" alt="Foto Masuk" width="50"></td> --}}
            <td>{{ $item->jam_keluar }}</td>
            {{-- <td><img src="{{ asset('storage/' . $item->foto_keluar) }}" alt="Foto Keluar" width="50"></td> --}}
        </tr>
    @endforeach
@endif
