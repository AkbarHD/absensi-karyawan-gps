@extends('layout.admin.tabler')

@section('content')
    <div class="page-body">
        <div class="container-xl">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="javascript:void(0);" class="btn btn-primary" id="btnTambahCabang">Tambah data</a>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <form action="{{ route('cabang.index') }}" method="GET">
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <select name="" id="" class="form-control">
                                                        <option value="">Semua Cabang</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Cabang</th>
                                                <th>Nama Nama Cabang</th>
                                                <th>Lokasi</th>
                                                <th>Radius</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($cabang as $x)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $x->kode_cabang }}</td>
                                                    <td>{{ $x->nama_cabang }}</td>
                                                    <td>{{ $x->lokasi_cabang }}</td>
                                                    <td>{{ $x->radius_cabang }}</td>
                                                    <td>
                                                        <a href="" class="btn btn-sm btn-primary edit"
                                                            kode_cabang="{{ $x->kode_cabang }}">
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
                                                        <form action="{{ route('cabang.delete', $x->kode_cabang) }}"
                                                            method="POST" style="display: inline" class="delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger delete-button"
                                                                type="submit">
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
                                                <td colspan="6">Data tidak tersedia</td>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- {{ $departemen->links('vendor.pagination.bootstrap-5') }} --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- modal tambah karyawan --}}
    <div class="modal modal-blur fade" id="modal-inputCabang" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Cabang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('cabang.store') }}" method="POST" id="frmCabang">
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
                                    <input type="text" name="kode_cabang" class="form-control" id="kode_cabang"
                                        placeholder="Kode Cabang">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-building-community">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8" />
                                            <path d="M13 7l0 .01" />
                                            <path d="M17 7l0 .01" />
                                            <path d="M17 11l0 .01" />
                                            <path d="M17 15l0 .01" />
                                        </svg>
                                    </span>
                                    <input type="text" name="nama_cabang" id="nama_cabang" class="form-control"
                                        placeholder="Nama Cabang">
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
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-map-pin">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                            <path
                                                d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" />
                                        </svg>
                                    </span>
                                    <input type="text" name="lokasi_cabang" id="lokasi_cabang" class="form-control"
                                        placeholder="Lokasi Cabang">
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
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-brand-flightradar24">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                            <path d="M12 12m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0" />
                                            <path d="M8.5 20l3.5 -8l-6.5 6" />
                                            <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                        </svg>
                                    </span>
                                    <input type="number" name="radius" id="radius" class="form-control"
                                        placeholder="Radius">
                                </div>
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
    <div class="modal modal-blur fade" id="modal-editCabang" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Cabang</h5>
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
            $('#btnTambahCabang').on('click', function() {
                $('#modal-inputCabang').modal('show');
            });

            $('.edit').on('click', function(e) {
                e.preventDefault();
                var kode_cabang = $(this).attr('kode_cabang');
                // alert(kode_cabang);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('cabang.edit') }}',
                    data: {
                        _token: "{{ csrf_token() }}",
                        kode_cabang: kode_cabang
                    },
                    success: function(respond) {
                        $('#loadededitform').html(respond);
                        $('#modal-editCabang').modal('show');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseJSON.error);
                    }

                });
            });

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
                })
            });

            $('#frmCabang').on('submit', function() {
                var kode_cabang = $('#kode_cabang').val();
                var nama_cabang = $('#nama_cabang').val();
                var lokasi_cabang = $('#lokasi_cabang').val();
                var radius_cabang = $('#radius').val();
                if (kode_cabang == "") {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'kode cabang Tidak Boleh Kosong',
                        icon: 'warning',
                    });
                    return false;
                } else if (nama_cabang == "") {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Nama cabang tidak boleh kosong',
                        icon: 'warning'
                    });
                    return false;
                } else if (lokasi_cabang == "") {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Lokasi cabang tidak boleh kosong',
                        icon: 'warning'
                    });
                    return false;
                } else if (radius_cabang == "") {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Radius cabang tidak boleh kosong',
                        icon: 'warning'
                    });
                    return false
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
        });
    </script>
@endpush
