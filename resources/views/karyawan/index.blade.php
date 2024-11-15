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
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{ route('karyawan.index') }}" method="GET">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="text" name="nama_karyawan" id="nama_karyawan"
                                                        class="form-control" placeholder="Nama karyawan"
                                                        value="{{ Request('nama_karyawan') }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <select name="kode_dept" id="kode_dept" class="form-select">
                                                        <option value="" hidden>Departemen</option>
                                                        @forelse ($department as $d)
                                                            <option
                                                                {{ Request('kode_dept') == $d->kode_dept ? 'selected' : '' }}
                                                                value="{{ $d->kode_dept }}">{{ $d->nama_dept }}</option>
                                                        @empty
                                                            <option value="">Tidak ada data</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            fill="none" stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" width="24" height="20"
                                                            stroke-width="2">
                                                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                            <path d="M21 21l-6 -6"></path>
                                                        </svg>
                                                        Cari
                                                    </button>
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
                                                        <a href="" class="btn btn-sm btn-primary">Edit</a>
                                                        <a href="" class="btn btn-sm btn-danger">Delete</a>
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
@endsection
