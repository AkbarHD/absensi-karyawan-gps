@extends('layout.presensi')
@section('content')
    <div class="section" id="user-section">
        <div id="user-detail">
            <div class="avatar">
                <img src="{{ asset('assets/img/sample/avatar/user-female.png') }}" alt="avatar" style="width: 70px;"
                    class="imaged  rounded">
            </div>
            <div id="user-info">
                <h2 id="user-name">Anjely Febby</h2>
                <span id="user-role">Presiden RI ke-8</span>
            </div>
        </div>
    </div>

    <div class="section" id="menu-section">
        <div class="card">
            <div class="card-body text-center">
                <div class="list-menu">
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="green" style="font-size: 40px;">
                                <ion-icon name="person-sharp"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Profil</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="danger" style="font-size: 40px;">
                                <ion-icon name="calendar-number"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Cuti</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="warning" style="font-size: 40px;">
                                <ion-icon name="document-text"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Histori</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="orange" style="font-size: 40px;">
                                <ion-icon name="location"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            Lokasi
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section mt-2" id="presence-section">
        <div class="todaypresence">
            <div class="row">
                <div class="col-6">
                    <div class="card gradasigreen">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    @if ($absenHariini != null)
                                        @php
                                            $path = Storage::url('uploads/absensi/' . $absenHariini->foto_in);
                                        @endphp
                                        <img src="{{ url($path) }}" alt="" class="imaged w64">
                                    @else
                                        <ion-icon name="camera"></ion-icon>
                                    @endif
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Masuk</h4>
                                    <span>{{ $absenHariini != null ? $absenHariini->jam_in : 'Belum absen' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card gradasired">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    @if ($absenHariini != null && $absenHariini->foto_out != null)
                                        @php
                                            $path = Storage::url('uploads/absensi/' . $absenHariini->foto_out);
                                        @endphp
                                        <img src="{{ url($path) }}" alt="" class="imaged w64">
                                    @else
                                        <ion-icon name="camera"></ion-icon>
                                    @endif
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Pulang</h4>
                                    <span>{{ $absenHariini != null && $absenHariini->jam_out != null ? $absenHariini->jam_out : 'Belum absen' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="rekappresence">
            <div id="chartdiv"></div>
            <!-- <div class="row">
                                                                                                    <div class="col-6">
                                                                                                        <div class="card">
                                                                                                            <div class="card-body">
                                                                                                                <div class="presencecontent">
                                                                                                                    <div class="iconpresence primary">
                                                                                                                        <ion-icon name="log-in"></ion-icon>
                                                                                                                    </div>
                                                                                                                    <div class="presencedetail">
                                                                                                                        <h4 class="rekappresencetitle">Hadir</h4>
                                                                                                                        <span class="rekappresencedetail">0 Hari</span>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-6">
                                                                                                        <div class="card">
                                                                                                            <div class="card-body">
                                                                                                                <div class="presencecontent">
                                                                                                                    <div class="iconpresence green">
                                                                                                                        <ion-icon name="document-text"></ion-icon>
                                                                                                                    </div>
                                                                                                                    <div class="presencedetail">
                                                                                                                        <h4 class="rekappresencetitle">Izin</h4>
                                                                                                                        <span class="rekappresencedetail">0 Hari</span>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row mt-1">
                                                                                                    <div class="col-6">
                                                                                                        <div class="card">
                                                                                                            <div class="card-body">
                                                                                                                <div class="presencecontent">
                                                                                                                    <div class="iconpresence warning">
                                                                                                                        <ion-icon name="sad"></ion-icon>
                                                                                                                    </div>
                                                                                                                    <div class="presencedetail">
                                                                                                                        <h4 class="rekappresencetitle">Sakit</h4>
                                                                                                                        <span class="rekappresencedetail">0 Hari</span>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-6">
                                                                                                        <div class="card">
                                                                                                            <div class="card-body">
                                                                                                                <div class="presencecontent">
                                                                                                                    <div class="iconpresence danger">
                                                                                                                        <ion-icon name="alarm"></ion-icon>
                                                                                                                    </div>
                                                                                                                    <div class="presencedetail">
                                                                                                                        <h4 class="rekappresencetitle">Terlambat</h4>
                                                                                                                        <span class="rekappresencedetail">0 Hari</span>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div> -->
        </div> --}}
        <div class="presencetab mt-2">
            <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                <ul class="nav nav-tabs style1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                            Bulan Ini
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                            Leaderboard
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content mt-2" style="margin-bottom:100px;">
                <div class="tab-pane fade show active" id="home" role="tabpanel">
                    <ul class="listview image-listview">
                        @forelse ($historibulanini as $data)
                            @php
                                $path = Storage::url('uploads/absensi/' . $data->foto_in);
                            @endphp
                            <li>
                                <div class="item">
                                    <div class="icon-box bg-primary">
                                        {{-- <ion-icon name="image-outline" role="img" class="md hydrated"
                                            aria-label="image outline"></ion-icon> --}}
                                        <img src="{{ url($path) }}" alt="" class="imaged w64">
                                    </div>
                                    <div class="in">
                                        <div style="transform: translateX(20px); font-size: 14px">
                                            {{ date('d-m-Y', strtotime($data->tgl_presensi)) }}</div>
                                        <span class="badge badge-success">{{ $data->jam_in }}</span>
                                        <span class="badge badge-danger">{{ $data->jam_out ?? 'belum absen' }}</span>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li>
                                <div class="item">
                                    <div class="icon-box bg-primary">
                                        <ion-icon name="image-outline" role="img" class="md hydrated"
                                            aria-label="image outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        <div>Tidak ada absen</div>
                                    </div>
                                </div>
                            </li>
                        @endforelse

                    </ul>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel">
                    <ul class="listview image-listview">
                        <li>
                            <div class="item">
                                <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                <div class="in">
                                    <div>Edward Lindgren</div>
                                    <span class="text-muted">Designer</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                <div class="in">
                                    <div>Emelda Scandroot</div>
                                    <span class="badge badge-primary">3</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                <div class="in">
                                    <div>Henry Bove</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                <div class="in">
                                    <div>Henry Bove</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                <div class="in">
                                    <div>Henry Bove</div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection
