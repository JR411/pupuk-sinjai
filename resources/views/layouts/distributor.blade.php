<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('1.PNG') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <title>Pupuk Sinjai | Distributor</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <!-- leaflet css  -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

    <link href="/css/validasi.css" rel="stylesheet">
</head>

<body>

    <section class="hero">
        <main>
            <button class="btn btn-outline-light d-xl-none" style="margin: -7px auto 0 81%" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#offcanvasResponsive" aria-controls="offcanvasResponsive"><i
                    class="bi-list" style="font-size: 1.7rem;"></i></button>
            <div class="offcanvas-xl offcanvas-end text-bg-primary" tabindex="-1" id="offcanvasResponsive"
                aria-labelledby="offcanvasResponsiveLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasResponsiveLabel">Halo {{ Auth()->user()->username }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                        data-bs-target="#offcanvasResponsive" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body d-xl-none">
                    <ul class="nav flex-column mb-auto">
                        <li><a href="/informasi-pupuk" class="nav-link px-2 text-white">Informasi
                                Pupuk</a></li>
                        <li><a href="/distributor"
                                class="nav-link px-2 {{ Request::is('distributor') ? 'active' : 'text-white' }}">Pengajuan
                                Pupuk</a></li>
                        <li><a href="/distributor/data-pengiriman"
                                class="nav-link px-2 {{ Request::is('distributor/data*') ? 'active' : 'text-white' }}">Data
                                Pengiriman</a></li>
                        <li><a href="/distributor/riwayat-pesanan"
                                class="nav-link px-2 {{ Request::is('distributor/riwayat*') ? 'active' : 'text-white' }}">Riwayat
                                Pesanan</a></li>
                    </ul>
                    <hr>
                    <div class="dropdown">
                        <a href="#"
                            class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <strong class="ms-2">{{ Auth()->user()->username }}</strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                data-bs-target="#editAkun-{{ $distributor->id }}">Edit Profil</button>
                            <form action="/keluar" method="post">
                                @csrf
                                <button type="submiit" class="dropdown-item"> Keluar</button>
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
            <header class="py-3 px-5 mx-5">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-xl-start">
                    <img src="/img/sinjai.png"
                        class="d-flex align-items-center mb-2 ms-0 mb-xl-0 text-white text-decoration-none"
                        alt="" width="80px">
                    <ul class="d-none d-xl-flex nav nav-atas ms-4 mt-5">
                        <li><a href="/informasi-pupuk" class="nav-link px-2 text-white">Informasi
                                Pupuk</a></li>
                        <li><a href="/distributor"
                                class="nav-link border-start px-2 {{ Request::is('distributor') ? 'active' : 'text-white' }}">Pengajuan
                                Pupuk</a></li>
                        <li><a href="/distributor/data-pengiriman"
                                class="nav-link border-start px-2 {{ Request::is('distributor/data*') ? 'active' : 'text-white' }}">Data
                                Pengiriman</a></li>
                        <li><a href="/distributor/riwayat-pesanan"
                                class="nav-link border-start px-2 {{ Request::is('distributor/riwayat*') ? 'active' : 'text-white' }}">Riwayat
                                Pesanan</a></li>
                    </ul>
                    <div class="d-none d-xl-flex dropdown dropdown-atas text-end col-1 mt-3" style="margin: 0 -100px 0">
                        <a href="#" class="d-block link-light text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <strong>Halo {{ Auth()->user()->username }}</strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <a href="/distributor/{{ $distributor->id }}/edit" class="dropdown-item">Edit Profil</a>
                            <form action="/keluar" method="post">
                                @csrf
                                <button type="submiit" class="dropdown-item"> Keluar</button>
                            </form>
                        </ul>
                    </div>
                </div>
                @yield('card')
    </section>

    @yield('modal')

    <!-- leaflet js  -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    @yield('js')

    <script crossorigin="anonymous" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="
        src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=API_KEYS&libraries=places"></script>

    <script src="/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if (!navigator.serviceWorker.controller) {
            navigator.serviceWorker.register("/sw.js").then(function(reg) {
                console.log("Service worker has been registered for scope: " + reg.scope);
            });
        }
    </script>


</body>

</html>
