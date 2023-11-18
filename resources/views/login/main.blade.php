<!doctype html>
<html lang="en">

<head>
    <title>Pupuk sinjai</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('1.PNG') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/login.css">
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <img src="/img/sinjai.png" alt="logo" width="100px">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
                            <div class="text w-100">
                                <img src="/img/LOGO PORBIO-01.png" alt="logo" width="100px">
                                @if (Request::is('daftar*'))
                                    <p>Sudah Punya Akun?</p>
                                    <a href="/" class="btn btn-white btn-outline-white">Silahkan Masuk</a>
                                @else
                                    <p>Belum Punya Akun?</p>
                                    <a href="/daftar-petani" class="btn btn-white btn-outline-white mb-2">Silahkan
                                        Daftar Sebagai Petani</a>
                                    <a href="/daftar-distributor" class="btn btn-white btn-outline-white px-2">Silahkan
                                        Daftar Sebagai Distributor</a>
                                @endif
                            </div>
                        </div>
                        <div class="login-wrap p-4 p-lg-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">
                                        @if (Request::is('daftar-petani'))
                                            Silahkan Daftar Petani
                                        @elseif (Request::is('daftar-distributor'))
                                            Silahkan Daftar Distributor
                                        @else
                                            Silahkan Masuk
                                        @endif
                                    </h3>
                                </div>
                            </div>
                            @yield('form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script crossorigin="anonymous" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="
        src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=API_KEYS&libraries=places"></script>

    <script src="/js/jquery.min.js"></script>
    <script src="/js/popper.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/main.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    @yield('js')

    {{-- PWA --}}
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
