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
                                            <td>{{ $loop->iteration }}</td>
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

                </div>
            </div>
        </div>
    </div>
@endsection
