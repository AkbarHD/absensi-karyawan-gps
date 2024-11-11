@extends('layout.presensi')
@section('content')
    <div class="section" id="user-section">
        <div id="user-detail">
            <div class="avatar">

                @if (Auth::guard('karyawan')->user()->foto == null)
                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" style="width: 70px; height: 60px;"
                        class="imaged">
                @else
                    <img src="{{ Storage::url('uploads/karyawan/' . Auth::guard('karyawan')->user()->foto) }}" alt="avatar"
                        style="width: 70px; height: 60px;" class="imaged ">
                @endif
            </div>
            <div id="user-info">
                <h2 id="user-name">{{ Auth::guard('karyawan')->user()->nama_lengkap }}</h2>
                <span id="user-role">{{ Auth::guard('karyawan')->user()->jabatan }}</span>
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
                                        <img src="{{ url($path) }}" alt="" class="imaged w48">
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
                                        <img src="{{ url($path) }}" alt="" class="imaged w48">
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

        <div id="rekappresensi">
            <h4>Rekap Presensi Bulan {{ $namabulan[$bulanini] }} Tahun {{ $tahunini }}</h4>
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 12px 12px !important;">
                            <span class="badge badge-danger"
                                style="position: absolute; top: 3px; right: 11px; font-size: 0.5rem; z-index: 9999;">{{ $rekappresensi->jmlhadir ?? 0 }}</span>
                            <ion-icon name="accessibility-outline" style="font-size: 1.2rem;"
                                class="text-success"></ion-icon>
                            <br>
                            <span style="font-size: 0.7rem; font-weight: 600;">Hadir</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 12px 12px !important;">
                            <span class="badge badge-danger"
                                style="position: absolute; top: 3px; right: 11px; font-size: 0.5rem; z-index: 9999;">{{ $rekapizin->jmlizin }}</span>
                            <ion-icon name="newspaper-outline" style="font-size: 1.2rem;" class="text-success"></ion-icon>
                            <br>
                            <span style="font-size: 0.7rem; font-weight: 600;">Izin</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 12px 12px !important;">
                            <span class="badge badge-danger"
                                style="position: absolute; top: 3px; right: 11px; font-size: 0.5rem; z-index: 9999;">{{ $rekapizin->jmlsakit }}</span>
                            <ion-icon name="newspaper-outline" style="font-size: 1.2rem;"
                                class="text-warning"></ion-icon>
                            <br>
                            <span style="font-size: 0.7rem; font-weight: 600;">Sakit</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 12px 12px !important;">
                            <span class="badge badge-danger"
                                style="position: absolute; top: 3px; right: 11px; font-size: 0.5rem; z-index: 9999;">{{ $rekappresensi->jmlterlambat ?? 0 }}</span>
                            <ion-icon name="alarm-outline" style="font-size: 1.2rem;" class="text-danger"></ion-icon>
                            <br>
                            <span style="font-size: 0.7rem; font-weight: 600;">Telat</span>
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
                        @forelse ($leaderboard as $leader)
                            <li>
                                <div class="item">
                                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                    <div class="in">
                                        <div>
                                            <strong>{{ $leader->nama_lengkap }}</strong> <br>
                                            <small class="text-muted">{{ $leader->jabatan }}</small>
                                        </div>
                                        <span
                                            class="badge {{ $leader->jam_in <= '07:00' ? 'badge-success' : 'badge-danger' }}">{{ $leader->jam_in }}</span>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li>
                                <div class="item">
                                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                    <div class="in">
                                        <div>Belum ada yang absen hari ini</div>
                                        {{-- <span class="text-muted">Designer</span> --}}
                                    </div>
                                </div>
                            </li>
                        @endforelse

                    </ul>
                </div>

            </div>
        </div>
    </div>
@endsection
