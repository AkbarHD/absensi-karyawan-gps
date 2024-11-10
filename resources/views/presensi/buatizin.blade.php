@extends('layout.presensi')
@section('header')
    {{-- materialize datepicker --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="{{ route('dashboard') }}" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Form Izin</div>
        <div class="right"></div>
    </div>
@endsection
@section('content')
    <div class="row" style="margin-top: 70px;">
        <div class="col">
            <form action="{{ route('presensi.storeizin') }}" method="POST" id="frmIzin">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control datepicker" name="tgl_izin" id="tgl_izin"
                        placeholder="Tanggal Izin">
                </div>
                <div class="form-group">
                    <select name="status" id="status" class="form-control">
                        <option value="" hidden>Izin / Sakit</option>
                        <option value="1">Izin</option>
                        <option value="2">Sakit</option>
                    </select>
                </div>

                <div class="form-group">
                    <textarea name="keterangan" id="keterangan" class="form-control" rows="5" placeholder="Keterangan"></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('myscript')
    <script>
        var currYear = (new Date()).getFullYear();

        $(document).ready(function() {
            // Inisialisasi Materialize Datepicker
            $(".datepicker").datepicker({
                format: "yyyy-mm-dd",
            });

            // Inisialisasi Materialize Select

            // Validasi form
            $('#frmIzin').submit(function(e) {
                // Ambil nilai dari form
                var tgl_izin = $('#tgl_izin').val();
                var status = $('#status').val();
                var keterangan = $('#keterangan').val();

                // Validasi
                if (tgl_izin == "") {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Tanggal Izin Tidak Boleh Kosong',
                        icon: 'warning',
                    });
                    return false;
                } else if (status == "") {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Status Izin atau Sakit Tidak Boleh Kosong',
                        icon: 'warning',
                    });
                    return false;
                } else if (keterangan == "") {
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Keterangan Tidak Boleh Kosong',
                        icon: 'warning',
                    });
                    return false;
                }
            });
        });
    </script>
@endpush
