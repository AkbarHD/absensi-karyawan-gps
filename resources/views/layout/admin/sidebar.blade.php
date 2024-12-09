<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href=".">
                <img src="./static/logo.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
        </h1>

        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">

                <!-- Menu Home -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboardadmin') ? 'active' : '' }}"
                        href="{{ route('dashboardadmin') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- SVG icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Home</span>
                    </a>
                </li>

                <!-- Menu Master Data -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('karyawan.index', 'departemen.index') ? 'active' : '' }}"
                        href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button"
                        aria-expanded="{{ request()->routeIs('karyawan.index', 'departemen.index') ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- SVG icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" />
                                <path d="M12 12l8 -4.5" />
                                <path d="M12 12l0 9" />
                                <path d="M12 12l-8 -4.5" />
                                <path d="M16 5.25l-8 4.5" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Master Data</span>
                    </a>
                    <div
                        class="dropdown-menu {{ request()->routeIs('karyawan.index', 'departemen.index') ? 'show' : '' }}">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ request()->routeIs('karyawan.index') ? 'active' : '' }}"
                                    href="{{ route('karyawan.index') }}">
                                    Data Karyawan
                                </a>
                                <a class="dropdown-item {{ request()->routeIs('departemen.index') ? 'active' : '' }}"
                                    href="{{ route('departemen.index') }}">
                                    Data Departemen
                                </a>
                            </div>
                        </div>
                    </div>
                </li>

                <!-- Menu Monitoring -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('monitoring.index') ? 'active' : '' }}"
                        href="{{ route('monitoring.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- SVG icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M3 4m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z" />
                                <path d="M7 20h10" />
                                <path d="M9 16v4" />
                                <path d="M15 16v4" />
                                <path d="M9 12v-4" />
                                <path d="M12 12v-1" />
                                <path d="M15 12v-2" />
                                <path d="M12 12v-1" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Monitoring Presensi</span>
                    </a>
                </li>

                <!-- Menu Data Izin/Sakit -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('presensi.izin.sakit') ? 'active' : '' }}"
                        href="{{ route('presensi.izin.sakit') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- SVG icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24V24H0z" fill="none" />
                                <path
                                    d="M3 4m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z" />
                                <path d="M7 20h10" />
                                <path d="M9 16v4" />
                                <path d="M15 16v4" />
                                <path d="M9 12v-4" />
                                <path d="M12 12v-1" />
                                <path d="M15 12v-2" />
                                <path d="M12 12v-1" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Data Izin / Sakit</span>
                    </a>
                </li>

                <!-- Menu Laporan -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('laporanpresensi', 'presensi.rekap') ? 'active' : '' }}"
                        href="#navbar-laporan" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button"
                        aria-expanded="{{ request()->routeIs('laporanpresensi', 'presensi.rekap') ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- SVG icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M15 3v4a1 1 0 0 0 1 1h4" />
                                <path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" />
                                <path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Laporan</span>
                    </a>
                    <div
                        class="dropdown-menu {{ request()->routeIs('laporanpresensi', 'presensi.rekap') ? 'show' : '' }}">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ request()->routeIs('laporanpresensi') ? 'active' : '' }}"
                                    href="{{ route('laporanpresensi') }}">
                                    Laporan Presensi
                                </a>
                                <a class="dropdown-item {{ request()->routeIs('presensi.rekap') ? 'active' : '' }}"
                                    href="{{ route('presensi.rekap') }}">
                                    Rekap Presensi
                                </a>
                            </div>
                        </div>
                    </div>
                </li>

                <!-- Menu Konfigurasi -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('lokasikantor', 'jamkerja.index') ? 'active' : '' }}"
                        href="#navbar-konfigurasi" data-bs-toggle="dropdown" data-bs-auto-close="false"
                        role="button" aria-expanded="{{ request()->routeIs('lokasikantor') ? 'true' : 'false' }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- SVG icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24V24H0z" fill="none" />
                                <path d="M12 3c4.418 0 8 7 8 12h-16c0 -5 3.582 -12 8 -12z" />
                                <path d="M12 11a2 2 0 1 0 0 -.01" />
                                <path d="M10 22l2 -2l2 2" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Konfigurasi</span>
                    </a>
                    <div
                        class="dropdown-menu {{ request()->routeIs('lokasikantor', 'jamkerja.index') ? 'show' : '' }}">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ request()->routeIs('lokasikantor') ? 'active' : '' }}"
                                    href="{{ route('lokasikantor') }}">
                                    Lokasi Kantor
                                </a>
                                <a class="dropdown-item {{ request()->routeIs('jamkerja.index') ? 'active' : '' }}"
                                    href="{{ route('jamkerja.index') }}">
                                    Jam Kerja
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

    </div>
</aside>
