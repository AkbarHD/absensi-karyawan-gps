@extends('layout.admin.tabler')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->

                    <h2 class="page-title">
                        Data Izin / Sakit
                    </h2>
                </div>

            </div>
        </div>
    </div>

    {{-- page body --}}
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('presensi.izin.sakit') }}" method="GET" autocomplete="off">
                        <div class="row">
                            <div class="col-6">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-calendar">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                            <path d="M16 3v4" />
                                            <path d="M8 3v4" />
                                            <path d="M4 11h16" />
                                            <path d="M11 15h1" />
                                            <path d="M12 15v3" />
                                        </svg>
                                    </span>
                                    <input type="text" name="dari" value="{{ Request('dari') }}" class="form-control"
                                        id="dari" placeholder="Dari">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-calendar">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                            <path d="M16 3v4" />
                                            <path d="M8 3v4" />
                                            <path d="M4 11h16" />
                                            <path d="M11 15h1" />
                                            <path d="M12 15v3" />
                                        </svg>
                                    </span>
                                    <input type="text" name="sampai" value="{{ Request('sampai') }}"
                                        class="form-control" id="sampai" placeholder="Sampai">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-calendar">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                            <path d="M16 3v4" />
                                            <path d="M8 3v4" />
                                            <path d="M4 11h16" />
                                            <path d="M11 15h1" />
                                            <path d="M12 15v3" />
                                        </svg>
                                    </span>
                                    <input type="text" name="nik" value="{{ Request('nik') }}" class="form-control"
                                        id="nik" placeholder="NIK">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-calendar">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                            <path d="M16 3v4" />
                                            <path d="M8 3v4" />
                                            <path d="M4 11h16" />
                                            <path d="M11 15h1" />
                                            <path d="M12 15v3" />
                                        </svg>
                                    </span>
                                    <input type="text" name="nama_lengkap" value="{{ Request('nama_lengkap') }}"
                                        class="form-control" id="nama_lengkap" placeholder="Nama Karyawan">
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="from-group">
                                    <select name="status_approved" class="form-select" id="status_approved">
                                        <option value="" selected disabled>Pilih Status</option>
                                        <option value="3" {{ Request('status_approved') == 3 ? 'selected' : '' }}>
                                            Waiting</option>
                                        <option value="1" {{ Request('status_approved') == 1 ? 'selected' : '' }}>
                                            Disetujui</option>
                                        <option value="2" {{ Request('status_approved') == 2 ? 'selected' : '' }}>
                                            Ditolak</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-3 d-flex align-items-center">
                                <!-- Tombol Cari Data -->
                                <button class="btn btn-primary me-2" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                        <path stroke="none" d="M0 0h24V24H0z" fill="none" />
                                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                        <path d="M21 21l-6 -6" />
                                    </svg>
                                    Cari data
                                </button>
                                <!-- Tombol Reset -->
                                <a href="{{ route('presensi.izin.sakit') }}" class="btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-refresh">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4" />
                                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4" />
                                    </svg>
                                    Reset
                                </a>
                            </div>


                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <table class="table card-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>NIK</th>
                                    <th>Tanggal</th>
                                    <th>Nama Karyawan</th>
                                    <th>Jabatan</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Status Approval</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($izinsakit as $d)
                                    <tr>
                                        <td>{{ $loop->iteration + $izinsakit->firstItem() - 1 }}</td>
                                        <td>{{ $d->nik }}</td>
                                        <td>{{ $d->tgl_izin }}</td>
                                        <td>{{ $d->nama_lengkap }}</td>
                                        <td>{{ $d->jabatan }}</td>
                                        <td>{{ $d->status == 'i' ? 'Izin' : 'Sakit' }}</td>
                                        <td>{{ $d->keterangan }}</td>
                                        <td>
                                            @if ($d->status_approved == '3')
                                                <span class="badge bg-warning text-white">Waiting</span>
                                            @elseif ($d->status_approved == '1')
                                                <span class="badge bg-success text-white">Approved</span>
                                            @else
                                                <span class="badge bg-danger text-white">Rejected</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($d->status_approved == '0')
                                                <a href="" class="btn btn-sm btn-primary" id="approve"
                                                    id_izinsakit="{{ $d->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-external-link">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" />
                                                        <path d="M11 13l9 -9" />
                                                        <path d="M15 4h5v5" />
                                                    </svg>
                                                </a>
                                            @else
                                                <a href="{{ route('batal.izinsakit', $d->id) }}"
                                                    class="btn btn-sm btn-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="currentColor"
                                                        class="icon icon-tabler icons-tabler-filled icon-tabler-circle-x">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-6.489 5.8a1 1 0 0 0 -1.218 1.567l1.292 1.293l-1.292 1.293l-.083 .094a1 1 0 0 0 1.497 1.32l1.293 -1.292l1.293 1.292l.094 .083a1 1 0 0 0 1.32 -1.497l-1.292 -1.293l1.292 -1.293l.083 -.094a1 1 0 0 0 -1.497 -1.32l-1.293 1.292l-1.293 -1.292l-.094 -.083z" />
                                                    </svg>
                                                    Batalkan
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Data Tidak Ditemukan</td>
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>
                        {{ $izinsakit->links('vendor.pagination.bootstrap-5') }}

                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- modal izin sakit --}}
    <div class="modal modal-blur fade" id="modal-izinsakit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Izin / Sakit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- @include('karyawan.edit') --}}
                    <form action="{{ route('approve.izinsakit') }}" method="POST">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id_formizin" id="id_formizin">
                            <div class="col-12">
                                <div class="form-group">
                                    <select name="status_approved" class="form-select" id="status_approved">
                                        <option value="1">Disetujui</option>
                                        <option value="2">Ditolak</option>
                                    </select>
                                </div>
                                <div class="row mt-2 mb-1">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary"> Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(document).ready(function() {
            $('#approve').on('click', function(e) {
                e.preventDefault();
                // harusnya ngambil ini tuh di ajax, cmn karena tdk menggunakan ajax taroh di modal dgn id_izinsakit_form
                var id = $(this).attr('id_izinsakit');
                // alert(id);
                $('#id_formizin').val(id);
                $('#modal-izinsakit').modal('show');
            });

            $("#dari, #sampai").datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            });


            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "{{ Session::get('success') }}",
                    showConfirmButton: true,
                    timer: 1500
                });
            @endif
            @if ($errors->any())
                let errorMessages = "";
                @foreach ($errors->all() as $error)
                    errorMessages += "{{ $error }}\n";
                @endforeach

                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: errorMessages,
                    showConfirmButton: true,
                    timer: 3000
                });
            @endif
        })
    </script>
@endpush
