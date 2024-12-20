<div class="appBottomMenu">
    <a href="{{ route('dashboard') }}" class="item {{ Route::is('dashboard') ? ' active' : '' }}">
        <div class="col">
            <ion-icon name="home-outline"></ion-icon>
            <strong>Home</strong>
        </div>
    </a>
    <a href="{{ route('presensi.histori') }}" class="item {{ Route::is('presensi.histori') ? ' active' : '' }}">
        <div class="col">
            <ion-icon name="calendar-outline" role="img" class="md hydrated" aria-label="calendar outline">
            </ion-icon>
            <strong>Histori</strong>
        </div>
    </a>
    <a href="{{ route('presensi.create') }}" class="item ">
        <div class="col">
            <div class="action-button large">
                <ion-icon name="camera" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
            </div>
        </div>
    </a>
    <a href="{{ route('presensi.izin') }}" class="item {{ Route::is('presensi.izin') ? ' active' : '' }}">
        <div class="col">
            <ion-icon name="document-text-outline" role="img" class="md hydrated"
                aria-label="document text outline"></ion-icon>
            <strong>Izin</strong>
        </div>
    </a>
    <a href="{{ route('presensi.editprofile') }}" class="item {{ Route::is('presensi.editprofile') ? ' active' : '' }}">
        <div class="col">
            <ion-icon name="people-outline" role="img" class="md hydrated" aria-label="people outline"></ion-icon>
            <strong>Profile</strong>
        </div>
    </a>
</div>
