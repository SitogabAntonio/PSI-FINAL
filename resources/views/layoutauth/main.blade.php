<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @if (env('IS_DEMO'))
    <x-demo-metas></x-demo-metas>
    @endif
    <link rel="apple-touch-icon" sizes="76x76"
        href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQbi8oMmcmsxM5Id6CuAtu19THuPBONocS4SA&s">
    <link rel="icon" type="image/png"
        href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQbi8oMmcmsxM5Id6CuAtu19THuPBONocS4SA&s">
    <title>
        Login </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />

    <style>
        .nav-link {
            position: relative;
            padding: 8px 12px;
            transition: color 0.3s;
        }

        .nav-link.active-tab {
            color: #5e72e4;
        }

        .nav-link.active-tab::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #5e72e4;
            transition: width 0.4s ease;
        }
    </style>
</head>

<body>
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <nav
                    class="navbar navbar-expand-lg position-absolute top-0 z-index-3 my-3 {{ (Request::is('static-sign-up') ? 'w-100 shadow-none  navbar-transparent mt-4' : 'blur blur-rounded shadow py-2 start-0 end-0 mx4') }}">
                    <div
                        class="container-fluid {{ (Request::is('static-sign-up') ? 'container' : 'container-fluid') }}">
                        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 {{ (Request::is('static-sign-up') ? 'text-white' : '') }}"
                            href="{{ url('login') }}">
                            <img src="../assets/img/logo1.png" alt="..."
                                style="width: 40px; height: auto; margin-right: 10px;">
                            Login </a>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <main class="content">
        @yield('content')
    </main>
    <footer class="footer py-5">
        <div class="container">

            <div class="row">
                <div class="col-8 mx-auto text-center mt-1">
                    <p class="mb-0 text-secondary">
                        Copyright ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> Sistem Informasi Gereja - PSI 21

                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>