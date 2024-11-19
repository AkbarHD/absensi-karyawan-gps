@extends('layout.admin.tabler')

@section('content')
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
                                                <th>Kode departemen</th>
                                                <th>Nama departemen</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($departemen as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration + $departemen->firstItem() - 1 }}</td>
                                                    <td>{{ $item->kode_dept }}</td>
                                                    <td>{{ $item->nama_dept }}</td>
                                                    <td>
                                                        <a href="" class="btn btn-sm btn-primary edit"
                                                            nik="{{ $item->kode_dept }}">
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
                                                        <form class="d-inline delete-form" action="" method="POST">
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

                            {{ $departemen->links('vendor.pagination.bootstrap-5') }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
