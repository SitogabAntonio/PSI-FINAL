<!doctype html>
<html lang="en">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title> {{$gereja->name}}
    </title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQbi8oMmcmsxM5Id6CuAtu19THuPBONocS4SA&s">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
            <a href="{{ route('main', ['domain' => $gereja->domain]) }}" class="logo d-flex align-items-center me-auto me-lg-0">
                <h1 class="sitename">{{$gereja->name}}</h1>
                <span>.</span>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ route('main', ['domain' => $gereja->domain]) }}">Beranda<br></a></li>
                    <li><a href="{{ url($gereja->domain . '#jadwal') }}">Jadwal Ibadah</a></li>
                    <li><a href="{{ url($gereja->domain . '#about') }}">Tentang</a></li>
                    <li><a href="{{ url($gereja->domain . '#team') }}">Pengurus</a></li>
                    <li><a href="{{ url($gereja->domain . '#contact') }}">Kontak</a></li>
                    <li class="dropdown">
                        <a href="#" class="{{ request()->routeIs('event.detail') || request()->routeIs('event.ayat') || request()->routeIs('event.warta') || request()->routeIs('event.sukaduka') || request()->is('*event') ? 'active' : '' }}">
                            <span>Informasi</span>
                            <i class="bi bi-chevron-down toggle-dropdown"></i>
                        </a>

                        <ul>
                            <li>
                                <a href="{{ route('event.detail', ['domain' => $gereja->domain]) }}"
                                    class="{{ request()->routeIs('event.detail') ? 'active' : '' }}">
                                    Event
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('event.ayat', ['domain' => $gereja->domain]) }}"
                                    class="{{ request()->routeIs('event.ayat') ? 'active' : '' }}">
                                    Ayat Harian
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('event.warta', ['domain' => $gereja->domain]) }}"
                                    class="{{ request()->routeIs('event.warta') ? 'active' : '' }}">
                                    Warta Jemaat
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('event.sukaduka', ['domain' => $gereja->domain]) }}"
                                    class="{{ request()->routeIs('event.sukaduka') ? 'active' : '' }}">
                                    Suka Duka Cita
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </header>


    <main class="content">
        @yield('content')
    </main>

    <footer id="footer" class="footer dark-background">


        <div class="copyright">
            <div class="container text-center">
                <p>© <span>Copyright</span> <strong class="px-1 sitename">2024</strong> <span>PSI</span></p>

            </div>
        </div>
    </footer>
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <div id="preloader"></div>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous">
    </script>
</body>

</html>