<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('1.PNG') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <title>Pupuk Sinjai | Pemerintah</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    {{-- <link href="/css/map.css" rel="stylesheet"> --}}
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
                        <li><a href="/pemerintah"
                                class="nav-link px-2 {{ Request::is('pemerintah') ? 'active' : 'text-white' }}">Data
                                Akun</a></li>
                        <li><a href="/pemerintah/data-desa"
                                class="nav-link px-2 {{ Request::is('pemerintah/data-desa*') ? 'active' : 'text-white' }}">Data
                                Desa</a></li>
                        {{-- <li><a href="/pemerintah/validasi-petani"
                                class="nav-link px-2 {{ Request::is('pemerintah/validasi-petani') ? 'active' : 'text-white' }}">Validasi
                                Petani</a></li>
                        <li><a href="/pemerintah/validasi-distributor"
                                class="nav-link px-2 {{ Request::is('pemerintah/validasi-distributor') ? 'active' : 'text-white' }}">Validasi
                                Distributor</a></li> --}}
                        <li><a href="/pemerintah/riwayat-pesanan"
                                class="nav-link px-2 {{ Request::is('pemerintah/riwayat-pesanan') ? 'active' : 'text-white' }}">Riwayat
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
                                data-bs-target="#editAkun-{{ $pemerintah->id }}">Edit Profil</button>
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
                        <li><a href="/pemerintah"
                                class="nav-link border-start px-2 {{ Request::is('pemerintah') ? 'active' : 'text-white' }}">Data
                                Akun</a></li>
                        <li><a href="/pemerintah/data-desa"
                                class="nav-link border-start px-2 {{ Request::is('pemerintah/data-desa*') ? 'active' : 'text-white' }}">Data
                                Desa</a></li>
                        {{-- <li><a href="/pemerintah/validasi-petani"
                                class="nav-link border-start px-2 {{ Request::is('pemerintah/validasi-petani') ? 'active' : 'text-white' }}">Validasi
                                Petani</a></li>
                        <li><a href="/pemerintah/validasi-distributor"
                                class="nav-link border-start px-2 {{ Request::is('pemerintah/validasi-distributor') ? 'active' : 'text-white' }}">Validasi
                                Distributor</a></li> --}}
                        <li><a href="/pemerintah/riwayat-pesanan"
                                class="nav-link border-start px-2 {{ Request::is('pemerintah/riwayat-pesanan') ? 'active' : 'text-white' }}">Riwayat
                                Pesanan</a></li>
                    </ul>
                    <div class="d-none d-xl-flex dropdown dropdown-atas text-end col-1 mt-3" style="margin: 0 -100px 0">
                        <a href="#" class="d-block link-light text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <strong>Halo {{ Auth()->user()->username }}</strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                data-bs-target="#editAkun-{{ $pemerintah->id }}">Edit Profil</button>
                            <form action="/keluar" method="post">
                                @csrf
                                <button type="submiit" class="dropdown-item"> Keluar</button>
                            </form>
                        </ul>
                    </div>
                </div>
                @yield('card')
    </section>

    <div class="modal fade" id="editAkun-{{ $pemerintah->id }}" tabindex="-1" aria-labelledby="editAkunLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editAkunLabel">Edit Akun {{ $pemerintah->username }}
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/pemerintah/akun/{{ $pemerintah->id }}" method="post">
                        @method('put')
                        @csrf
                        <div class="form-group mb-3">
                            <label for="username" class="label">Username</label>
                            <input type="text" name="username"
                                class="form-control @error('username') is-invalid @enderror" placeholder="Username"
                                value="{{ old('username', $pemerintah->username) }}" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="label">Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                value="{{ old('password') }}" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-5">
                            <label class="label" for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                placeholder="Konfirmasi Password" required>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-warning text-white">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @yield('modal')

    @yield('js')

    {{-- <script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=API_KEYS&libraries=places"></script> --}}

    <script src="/js/bootstrap.bundle.min.js"></script>
    {{-- <script src="/js/map.js"></script> --}}
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
