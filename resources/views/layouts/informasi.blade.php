<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('1.PNG') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <title>
        @if (Auth()->user()->kategori == 'Petani')
            Pupuk Sinjai | Petani
        @elseif (Auth()->user()->kategori == 'Distributor')
            Pupuk Sinjai | Distributor
        @elseif (Auth()->user()->kategori == 'Pemerintah')
            Pupuk Sinjai | Pemerintah
        @endif
    </title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>

    <section class="hero">
        <button class="btn btn-outline-light d-xl-none" style="margin: -7px auto 0 81%" type="button"
            data-bs-toggle="offcanvas" data-bs-target="#offcanvasResponsive" aria-controls="offcanvasResponsive"><i
                class="bi-list" style="font-size: 1.7rem;"></i></button>
        <main>
            <div class="offcanvas-xl offcanvas-end text-bg-primary" tabindex="-1" id="offcanvasResponsive"
                aria-labelledby="offcanvasResponsiveLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasResponsiveLabel">Halo {{ Auth()->user()->username }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                        data-bs-target="#offcanvasResponsive" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body d-xl-none">
                    <ul class="nav flex-column mb-auto">
                        @if (Auth()->user()->kategori == 'Petani')
                            <li><a href="/informasi-pupuk" class="nav-link px-2 active">Informasi
                                    Pupuk</a></li>
                            <li><a href="/petani" class="nav-link px-2 text-white">Pesan
                                    Pupuk</a></li>
                            <li><a href="/petani/profil-distributor" class="nav-link px-2 text-white">Profil
                                    Distributor</a></li>
                            <li><a href="/petani/riwayat-pesanan" class="nav-link px-2 text-white">Riwayat
                                    Pesanan</a></li>
                        @elseif (Auth()->user()->kategori == 'Distributor')
                            <li><a href="/informasi-pupuk" class="nav-link px-2 active">Informasi
                                    Pupuk</a></li>
                            <li><a href="/distributor" class="nav-link px-2 text-white">Pengajuan Pupuk</a>
                            </li>
                            <li><a href="/distributor/data-pengiriman" class="nav-link px-2 text-white">Data
                                    Pengiriman</a></li>
                            <li><a href="/distributor/riwayat-pesanan" class="nav-link px-2 text-white">Riwayat
                                    Pesanan</a></li>
                        @elseif (Auth()->user()->kategori == 'Pemerintah')
                            <li><a href="/informasi-pupuk" class="nav-link px-2 active">Informasi
                                    Pupuk</a></li>
                            <li><a href="/pemerintah" class="nav-link px-2 text-white">Data
                                    Akun</a></li>
                            <li><a href="/pemerintah/validasi-petani" class="nav-link px-2 text-white">Validasi
                                    Petani</a></li>
                            <li><a href="/pemerintah/validasi-distributor" class="nav-link px-2 text-white">Validasi
                                    Distributor</a></li>
                            <li><a href="/pemerintah/riwayat-pesanan" class="nav-link px-2 text-white">Riwayat
                                    Pesanan</a>
                            </li>
                        @endif
                    </ul>
                    <hr>
                    <div class="dropdown">
                        <a href="#"
                            class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <strong class="ms-2">{{ Auth()->user()->username }}</strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            @if (Auth()->user()->kategori == 'Petani')
                                <a href="/petani/{{ $petani->id }}/edit" class="dropdown-item">Edit Profil</a>
                            @elseif (Auth()->user()->kategori == 'Distributor')
                                //
                            @elseif (Auth()->user()->kategori == 'Pemerintah')
                                <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                    data-bs-target="#editAkun-{{ $pemerintah->id }}">Edit Profil</button>
                            @endif
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
                        @if (Auth()->user()->kategori == 'Petani')
                            <li><a href="/informasi-pupuk" class="nav-link px-2 active">Informasi
                                    Pupuk</a></li>
                            <li><a href="/petani" class="nav-link border-start px-2 text-white">Pesan
                                    Pupuk</a></li>
                            <li><a href="/petani/profil-distributor"
                                    class="nav-link border-start px-2 text-white">Profil Distributor</a></li>
                            <li><a href="/petani/riwayat-pesanan" class="nav-link border-start px-2 text-white">Riwayat
                                    Pesanan</a></li>
                        @elseif (Auth()->user()->kategori == 'Distributor')
                            <li><a href="/informasi-pupuk" class="nav-link px-2 active">Informasi
                                    Pupuk</a></li>
                            <li><a href="/distributor" class="nav-link border-start px-2 text-white">Pengajuan
                                    Pupuk</a>
                            </li>
                            <li><a href="/distributor/data-pengiriman"
                                    class="nav-link border-start px-2 text-white">Data Pengiriman</a></li>
                            <li><a href="/distributor/riwayat-pesanan"
                                    class="nav-link border-start px-2 text-white">Riwayat Pesanan</a></li>
                        @elseif (Auth()->user()->kategori == 'Pemerintah')
                            <li><a href="/informasi-pupuk" class="nav-link px-2 active">Informasi
                                    Pupuk</a></li>
                            <li><a href="/pemerintah" class="nav-link border-start px-2 text-white">Data
                                    Akun</a></li>
                            <li><a href="/pemerintah/validasi-petani"
                                    class="nav-link border-start px-2 text-white">Validasi
                                    Petani</a></li>
                            <li><a href="/pemerintah/validasi-distributor"
                                    class="nav-link border-start px-2 text-white">Validasi
                                    Distributor</a></li>
                            <li><a href="/pemerintah/riwayat-pesanan"
                                    class="nav-link border-start px-2 text-white">Riwayat Pesanan</a>
                            </li>
                        @endif
                    </ul>
                    <div class="d-none d-xl-flex dropdown dropdown-atas text-end col-1 mt-3"
                        style="margin: 0 -100px 0">
                        <a href="#" class="d-block link-light text-decoration-none dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <strong>Halo {{ Auth()->user()->kategori }}</strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                            @if (Auth()->user()->kategori == 'Petani')
                                <a href="/petani/{{ $petani->id }}/edit" class="dropdown-item">Edit Profil</a>
                            @elseif (Auth()->user()->kategori == 'Distributor')
                                <a href="/distributor/{{ $distributor->id }}/edit" class="dropdown-item">Edit
                                    Profil</a>
                            @elseif (Auth()->user()->kategori == 'Pemerintah')
                                <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                    data-bs-target="#editAkun-{{ $pemerintah->id }}">Edit Profil</button>
                            @endif
                            <form action="/keluar" method="post">
                                @csrf
                                <button type="submiit" class="dropdown-item"> Keluar</button>
                            </form>
                        </ul>
                    </div>
                </div>
                @yield('card')
    </section>

    @if (Auth()->user()->kategori == 'Pemerintah')
        <div class="modal fade" id="editAkun-{{ $pemerintah->id }}" tabindex="-1" aria-labelledby="editAkunLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editAkunLabel">Edit Akun {{ $pemerintah->username }}
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/pemerintah/akun/{{ $pemerintah->id }}" method="post">
                            @method('put')
                            @csrf
                            <div class="form-group mb-3">
                                <label for="username" class="label">Username</label>
                                <input type="text" name="username"
                                    class="form-control @error('username') is-invalid @enderror"
                                    placeholder="Username" value="{{ old('username', $pemerintah->username) }}"
                                    required>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="label">Password</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Password" value="{{ old('password') }}" required>
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
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-warning text-white">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script src="/js/bootstrap.bundle.min.js"></script>
    @yield('js')
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
