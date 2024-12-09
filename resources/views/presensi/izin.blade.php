@extends('layout.presensi')
@section('header')
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="{{ route('dashboard') }}" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Data Izin / Sakit</div>
        <div class="right"></div>
    </div>
@endsection

@section('content')
    <div class="col" style="margin-top: 70px;">
        @php
            $messagesuccess = Session::get('success');
            $messageerror = Session::get('error');
        @endphp
        @if (Session::get('success'))
            <div class="alert alert-success">
                {{ $messagesuccess }}
            </div>
        @endif
        @if (Session::get('error'))
            <div class="alert alert-danger">
                {{ $messageerror }}
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col">
            @foreach ($dataizin as $d)
                <ul class="listview image-listview">
                    <li>
                        <div class="item">

                            <div class="in">
                                <div>
                                    <strong>{{ date('d-m-Y', strtotime($d->tgl_izin)) }}
                                        ({{ $d->status == 'i' ? 'Izin' : 'Sakit' }})
                                    </strong> <br>
                                    <small class="text-muted">{{ $d->keterangan }}</small>
                                </div>

                                @if ($d->status_approved == 3)
                                    <span class="badge badge-warning">Waiting</span>
                                @elseif($d->status_approved == 1)
                                    <span class="badge badge-success">Approved</span>
                                @elseif($d->status_approved == 2)
                                    <span class="badge badge-danger">Rejected</span>
                                @endif
                            </div>
                        </div>
                    </li>
                </ul>
            @endforeach
        </div>
    </div>
    <div class="fab-button bottom-right" style="margin-bottom: 70px">
        <a href="{{ route('presensi.buatizin') }}" class="fab">
            <ion-icon name="add-outline"></ion-icon>
        </a>
    </div>
@endsection
