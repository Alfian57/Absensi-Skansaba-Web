<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Absensi Siswa | {{ $title }}</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="/img/icon.ico" type="image/x-icon" />

    <script src="/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--   Core JS Files   -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="/js/core/jquery.3.2.1.min.js"></script>
    <script src="/js/core/popper.min.js"></script>
    <script src="/js/core/bootstrap.min.js"></script>

    <!-- jQuery UI -->
    <script src="/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

    <!-- Chart JS -->
    <script src="/js/chart.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Datatables -->
    <script src="/js/plugin/datatables/datatables.min.js"></script>

    <!-- Sweet Alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Atlantis JS -->
    <script src="/js/atlantis.min.js"></script>

    {{-- My Js --}}
    <script src="/js/dashboard.js"></script>

    <!-- CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/atlantis.min.css">

    {{-- My Style --}}
    <link rel="stylesheet" href="/css/dashboard.css">
</head>

<body>
    <div class="wrapper">
        @include('components.navbar')

        @include('components.sidebar')


        <div class="main-panel">
            <div class="content">
                @if (Request::is('admin/home'))
                    <div class="bg-primary" style="height: 175px">
                    </div>
                    <div class="p-5" style="margin-top: -175px">
                        @yield('content')
                        @include('components.chart')
                    </div>
                @else
                    <div class="p-5">
                        @yield('content')
                    </div>
                @endif
            </div>

            <footer class="footer">
                <div class="container">
                    <div class="copyright ml-auto">
                        &copy; <?php echo date('Y'); ?> Absensi Siswa SMKN 1 BANTUL (2022)
                    </div>
                </div>
            </footer>
        </div>
    </div>
    @include('sweetalert::alert')
</body>

</html>
