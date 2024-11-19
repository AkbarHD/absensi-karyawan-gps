@extends('layout.admin.tabler')
@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->

                    <h2 class="page-title">
                        Data Karyawan
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
                    <div class="card">
                        <div class="card-body">
                            <a href="javascript:void(0);" class="btn btn-primary" id="btnTambahKaryawan">Tambah data</a>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>No HP</th>
                                                <th>Foto</th>
                                                <th>Departemen</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($karyawan as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration + $karyawan->firstItem() - 1 }}</td>
                                                    <td>{{ $item->nik }}</td>
                                                    <td>{{ $item->nama_lengkap }}</td>
                                                    <td>{{ $item->jabatan }}</td>
                                                    <td>{{ $item->no_hp }}</td>
                                                    <td>
                                                        @if (empty($item->foto))
                                                            <img class="avatar" src="{{ asset('no-foto.jpg') }}"
                                                                alt="{{ $item->nama_lengkap }}">
                                                        @else
                                                            <img class="avatar"
                                                                src="{{ Storage::url('uploads/karyawan/' . $item->foto) }}"
                                                                alt="{{ $item->nama_lengkap }}">
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->nama_dept }}</td>
                                                    <td>
                                                        <a href="" class="btn btn-sm btn-primary edit"
                                                            nik="{{ $item->nik }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                fill="none" stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" width="20" height="20"
                                                                stroke-width="2">
                                                                <path
                                                                    d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                                </path>
                                                                <path
                                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                                </path>
                                                                <path d="M16 5l3 3"></path>
                                                            </svg>
                                                        </a>
                                                        <form class="d-inline delete-form"
                                                            action="{{ route('karyawan.destroy', $item->nik) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger delete-button">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                    fill="none" stroke="currentColor"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    width="20" height="20" stroke-width="2">
                                                                    <path d="M4 7l16 0"></path>
                                                                    <path d="M10 11l0 6"></path>
                                                                    <path d="M14 11l0 6"></path>
                                                                    <path
                                                                        d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12">
                                                                    </path>
                                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3">
                                                                    </path>
                                                                </svg>
                                                            </button>

                                                        </form>

                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{ $karyawan->links('vendor.pagination.bootstrap-5') }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- modal tambah karyawan --}}
    <div class="modal modal-blur fade" id="modal-inputKaryawan" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('karyawan.store') }}" method="POST" id="frmKaryawan"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-barcode">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 7v-1a2 2 0 0 1 2 -2h2" />
                                            <path d="M4 17v1a2 2 0 0 0 2 2h2" />
                                            <path d="M16 4h2a2 2 0 0 1 2 2v1" />
                                            <path d="M16 20h2a2 2 0 0 0 2 -2v-1" />
                                            <path d="M5 11h1v2h-1z" />
                                            <path d="M10 11l0 2" />
                                            <path d="M14 11h1v2h-1z" />
                                            <path d="M19 11l0 2" />
                                        </svg>
                                    </span>
                                    <input type="text" name="nik" class="form-control" id="nik"
                                        placeholder="NIK">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                        </svg>
                                    </span>
                                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control"
                                        placeholder="Nama lengkap">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-sitemap">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M3 15m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v2a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                            <path
                                                d="M15 15m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v2a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                            <path
                                                d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v2a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                            <path d="M6 15v-1a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v1" />
                                            <path d="M12 9l0 3" />
                                        </svg>
                                    </span>
                                    <input type="text" name="jabatan" id="jabatan" class="form-control"
                                        placeholder="Jabatan">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-phone">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                                        </svg>
                                    </span>
                                    <input type="text" name="no_hp" id="no_hp" class="form-control"
                                        placeholder="No Telepon">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <input type="file" name="foto" id="foto" class="form-control">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <span class="input-icon">
                                    <span class="input-icon-addon ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-file-download">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                            <path
                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                            <path d="M12 17v-6" />
                                            <path d="M9.5 14.5l2.5 2.5l2.5 -2.5" />
                                        </svg>
                                    </span>

                                    <select name="kode_dept" id="kode_dept" class="form-select">
                                        <option value="" hidden>Departemen</option>
                                        @forelse ($department as $d)
                                            <option {{ Request('kode_dept') == $d->kode_dept ? 'selected' : '' }}
                                                value="{{ $d->kode_dept }}">{{ $d->nama_dept }}</option>
                                        @empty
                                            <option value="">Tidak ada data</option>
                                        @endforelse
                                    </select>

                                </span>

                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-file-download">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                            <path
                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                            <path d="M12 17v-6" />
                                            <path d="M9.5 14.5l2.5 2.5l2.5 -2.5" />
                                        </svg>
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- modal edit --}}
    <div class="modal modal-blur fade" id="modal-editKaryawan" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadededitform">
                    {{-- @include('karyawan.edit') --}}
                </div>

            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(document).ready(function() {
            $('#btnTambahKaryawan').on('click', function() {
                $('#modal-inputKaryawan').modal('show');
            });

            $('.edit').on('click', function(e) {
                e.preventDefault();
                var nik = $(this).attr('nik');
                $.ajax({
                    type: 'GET',
                    url: '{{ route('karyawan.edit') }}',
                    data: {
                        _token: "{{ csrf_token() }}",
                        nik: nik
                    },
                    success: function(response) {
                        // kita tidak menggunakan @include('karyawan.edit') tetapi menggunakan #loadededitform
                        $('#loadededitform').html(response);
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseJSON.error);
                    }
                });
                $('#modal-editKaryawan').modal('show');

            });


            $('#frmKaryawan').on('submit', function() {
                var nik = $('#nik').val();
                var nama_lengkap = $('#nama_lengkap').val();
                var jabatan = $('#jabatan').val();
                var no_hp = $('#no_hp').val();
                var kode_dept = $('#frmKaryawan').find('#kode_dept').val();
                if (nik == "") {
                    $('#nik').focus();
                    Swal.fire({
                        title: 'Oops!',
                        text: 'NIK Tidak Boleh Kosong',
                        icon: 'warning',
                    });
                    return false;
                } else if (nama_lengkap == "") {
                    $('#nama_lengkap').focus();
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Nama Lengkap Tidak Boleh Kosong',
                        icon: 'warning',
                    });
                    return false;
                } else if (jabatan == "") {
                    $('#jabatan').focus();
                    swal.fire({
                        title: 'Oops!',
                        text: 'Jabatan Tidak Boleh Kosong',
                        icon: 'warning',
                    });
                    return false;
                } else if (no_hp == "") {
                    $('#no_hp').focus();
                    swal.fire({
                        title: 'Oops!',
                        text: 'No Telepon Tidak Boleh Kosong',
                        icon: 'warning',
                    });
                    return false;
                } else if (kode_dept == "") {
                    $('#kode_dept').focus();
                    swal.fire({
                        title: 'Oops!',
                        text: 'Departemen Tidak Boleh Kosong',
                        icon: 'warning',
                    });
                    return false;
                }
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

            $('.delete-button').on('click', function(e) {
                e.preventDefault(); // Mencegah form langsung submit

                let form = $(this).closest('.delete-form'); // Form terdekat dari tombol

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

        });
    </script>
@endpush
