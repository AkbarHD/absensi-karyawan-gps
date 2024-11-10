@extends('layout.presensi')
@section('header')
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="{{ route('dashboard') }}" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Histori Presensi</div>
        <div class="right"></div>
    </div>
@endsection

@section('content')
    <div class="row" style="margin-top: 70px;">
        <div class="col">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <select name="bulan" id="bulan" class="form-control">
                            <option value="" hidden>Bulan</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ $i == date('m') ? 'selected' : '' }}>
                                    {{ $namabulan[$i] }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <select name="tahun" id="tahun" class="form-control">
                            <option value="" hidden>tahun</option>
                            @php
                                $tahunmulai = 2022;
                                $tahunskrg = date('Y');
                            @endphp
                            @for ($tahun = $tahunmulai; $tahun <= $tahunskrg; $tahun++)
                                <option value="{{ $tahun }}" {{ $tahun == date('Y') ? 'selected' : '' }}>
                                    {{ $tahun }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block" id="getdata">
                        <ion-icon name="search-outline"></ion-icon> Search
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col" id="showhistori"></div>
    </div>
@endsection

@push('myscript')
    <script>
        $(document).ready(function() {
            $('#getdata').click(function() {
                var bulan = $('#bulan').val();
                var tahun = $('#tahun').val();
                $.ajax({
                    'url': "{{ route('presensi.gethistori') }}",
                    'type': "POST",
                    'data': {
                        '_token': "{{ csrf_token() }}",
                        'bulan': bulan,
                        'tahun': tahun
                    },
                    cache: false,
                    success: function(respond) {
                        // console.log(respond);
                        $('#showhistori').html(respond);
                    }
                });
            });
        });
    </script>
@endpush
