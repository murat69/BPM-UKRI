<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BPM UKRI</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Favicons -->
    <link href="{{ asset('img/ukri-logo.png') }}" rel="icon">
    <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

    <!-- Template Main CSS File -->
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
    <link href="{{ asset('css/hero.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nav-menu.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/about.css') }}" rel="stylesheet">
    <link href="{{ asset('css/backtoup.css') }}" rel="stylesheet">
    <link href="{{ asset('css/count.css') }}" rel="stylesheet">
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
    <link href="{{ asset('css/general.css') }}" rel="stylesheet">
    <link href="{{ asset('css/preloader.css') }}" rel="stylesheet">
    <link href="{{ asset('css/section.css') }}" rel="stylesheet">
    <link href="{{ asset('css/testimonial.css') }}" rel="stylesheet">
    <link href="{{ asset('css/kontak.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Valera - v4.9.1
  * Template URL: https://bootstrapmade.com/valera-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>





    @yield('style')

    <!-- Scripts -->


</head>

<body>

    <!-- ======= Hero Section ======= -->
    <section id="setengah"
        style="background: url('{{ asset('img/background2.webp') }}') top center;
  background-size: cover;">
        <div class="hero-container">
            <div class="fade-in-text">
                <h1>Badan Penjaminan Mutu</h1>
                <h2>Universitas Kebangsaan Republik Inodnesia</h2>

            </div>
        </div>
    </section><!-- End Hero -->

    <header id="header" class="d-flex align-items-center ">
        <div class="container-fluid d-flex align-items-center justify-content-lg-between">
            <img class="logouk" src="{{ asset('img/ukri-logo.png') }}" alt="">
            <h1 class="logo me-auto "><a href="{{ route('welcome') }}">BPM UKRI</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link" href="{{ route('welcome') }}">Home</a></li>
                    <li><a class="nav-link" href="{{ route('tentang') }}">Tentang</a></li>
                    <li><a class="nav-link" href="{{ route('tentang_spmi') }}">SPMI</a></li>
                    <li><a class="nav-link" href=" {{ route('akre') }}">Akreditasi</a></li>
                    <li><a class="nav-link " href="{{ route('peraturan') }}">Peraturan</a></li>
                    <li><a class="nav-link " href=" {{ route('kontak') }}">Kontak</a></li>

                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

            <div class="header-social-links d-flex align-items-center">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
            </div>

        </div>
    </header><!-- End Header -->


    <main id="main">
        @yield('content')
    </main>

    <footer id="footer">

        <div class="footer-top">

            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-md-6 alamat">
                        <h1>Badan Penjaminan Mutu. <br>Universitas Kebangsaan Republik Indonesia</h1>
                        <p> Gedung Universitas Kebangsaan Republik Indonesia <br>
                            Jl. Terusan Halimun No.37, Lkr. Sel., Kec. Lengkong, Kota Bandung, Jawa Barat 40263<br>
                            Telepon: (022) 7301987<br>
                            Email: bpm@ukri.ac.id</p>
                    </div>

                    <div class="col-md-6 " style="padding-left: 100px;  padding-top: 50px;">
                        <div class="akre">
                            <p><span> Akreditasi Institusi Baik </span> Universitas Kebangsaan Republik Indonesia
                                telah
                                mendapatkan Akreditasi Institusi Baik dari Badan Akreditasi Nasional Perguruan Tinggi
                                (BAN-PT) pada tahun 2022
                                <br>(Surat Keputusan 138/SK/BAN-PT/Ak-PNB/PT/IV/2022).
                            </p>
                        </div>

                    </div>

                </div>
            </div>

            <div class="container footer-bottom clearfix">
                <div class="copyright">
                    &copy; Copyright <strong><span>BPM UKRI</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/valera-free-bootstrap-theme/ -->

                </div>
            </div>
    </footer><!-- End Footer -->


    @yield('script')

</body>

</html>
