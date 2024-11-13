@extends('layout.presensi')
@section('header')
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">E-Presensi</div>
        <div class="right"></div>
    </div>
    <style>
        .webcam-capture,
        .webcam-capture video {
            display: inline-block;
            width: 100% !important;
            height: auto !important;
            margin: auto !important;
            border-radius: 15px;
        }

        #map {
            height: 250px;

        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@endsection
@section('content')
    <div class="row">
        <div class="col">
            <input type="text" id="lokasi" style="margin-top: 100px;">
            <div class="webcam-capture"></div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if ($cek > 0)
                <button id="takeabsen" class="btn btn-danger btn-block"> <ion-icon name="camera-outline"></ion-icon>
                    Absen Pulang</button>
            @else
                <button id="takeabsen" class="btn btn-primary btn-block"> <ion-icon name="camera-outline"></ion-icon>
                    Absen Masuk</button>
            @endif
        </div>

    </div>

    <div class="row mt-2">
        <div class="col">
            <div id="map"></div>
        </div>
    </div>
    <audio id="notifikasi_in">
        <source src="{{ asset('assets/sound/notifikasi_in.mp3') }}" type="audio/mpeg">
    </audio>
    <audio id="notifikasi_out">
        <source src="{{ asset('assets/sound/notifikasi_out.mp3') }}" type="audio/mpeg">
    </audio>
    <audio id="radius_sound">
        <source src="{{ asset('assets/sound/luar_radius.mp3') }}" type="audio/mpeg">
    </audio>
@endsection

@push('myscript')
    <script>
        // ambil notifikasi
        var notifikasi_in = document.getElementById('notifikasi_in');
        var notifikasi_out = document.getElementById('notifikasi_out');
        var radius_sound = document.getElementById('radius_sound');
        Webcam.set({
            height: 480,
            width: 640,
            image_format: 'jpeg',
            jpeg_quality: 80
        });

        Webcam.attach('.webcam-capture');

        // ambil lokasi
        var lokasi = document.getElementById('lokasi');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        }

        function successCallback(position) {
            // taroh di input lokasi
            lokasi.value = position.coords.latitude + ',' + position.coords.longitude;
            // menampilkan map berdasarkan lokasi kita
            var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 17);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 20,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            // marker
            var marker = L.marker([-6.353264, 106.631735]).addTo(map);
            // radius kantor (tidak boleh di luar radius ini)
            var circle = L.circle([-6.353264, 106.631735], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                // batas radius tidak boleh dari 2 meter dari lingkaran (kantor)
                radius: 79
            }).addTo(map);
        }

        function errorCallback() {

        }
        $('#takeabsen').on('click', function() {
            Webcam.snap(function(url) {
                image = url;
            })
            // ambil lokasi kita dari input
            var lokasi = $('#lokasi').val();
            $.ajax({
                url: "{{ route('presensi.store') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    image: image,
                    lokasi: lokasi
                },
                cache: false,
                success: function(respond) {
                    var status = respond.split("|");
                    if (status[0] == "success") {
                        // jika statusnya in maka play notifikasi
                        if (status[2] == 'in') {
                            notifikasi_in.play();
                        } else {
                            notifikasi_out.play();
                        }
                        Swal.fire({
                            title: 'Berhasil!',
                            text: status[1],
                            icon: 'success',
                        })
                        setTimeout("location.href = '{{ route('dashboard') }}';", 3000);
                        // setTimeout("location.href = '/dashboard';", 1000);
                    } else {
                        if (status[2] == 'radius') {
                            radius_sound.play();
                        }
                        Swal.fire({
                            title: 'Error!',
                            text: status[1],
                            icon: 'error',
                        })
                    }
                }
            });
        });
    </script>
@endpush
