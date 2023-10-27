<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>BPM UKRI</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
    </style>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">



    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('admin/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('admin/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('admin/dist/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>



    <link href="{{ asset('admin/plugins/summernote/summernote.min.css') }}" rel="stylesheet">
    <script src="{{ asset('admin/plugins/summernote/summernote.min.js') }}"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('admin/img/ukri-logo.png') }}" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->

                <li class="nav-item d-none d-sm-inline-block">

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link">Logout</button>
                    </form>

                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{ asset('admin/img/ukri-logo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">BPM UKRI</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->


                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link active ">
                                <p>
                                    <i class="fa-solid fa-house-user"></i>
                                    Home
                                </p>
                            </a>
                        </li>
                        {{-- BPM --}}
                        @if (Auth::user()->role == 'admin')
                            <li class="nav-item menu-close">
                                <a href="#" class="nav-link">
                                    <i class="fa-solid fa-id-card-clip"></i>
                                    <p style="text-align: center;">
                                        BPM
                                    </p>
                                    <i class="right fas fa-angle-left"></i>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item menu-close">
                                        <a href="#" class="nav-link">
                                            <i class="fa-solid fa-id-card-clip"></i>
                                            <p style="text-align: center;">
                                                Sistem Penjaminanan Mutu
                                            </p>
                                            <i class="right fas fa-angle-left"></i>
                                        </a>
                                        <ul class="nav nav-treeview">

                                            <li class="nav-item menu-open">
                                                <a href="#" class="nav-link">
                                                    <i class="fa-solid fa-folder"></i>
                                                    <p style="font-size:14.5px; margin-left: 10px;">
                                                        Sistem Penjaminan Mutu Internal (SPMI)
                                                        <i class="right fas fa-angle-left"
                                                            style="margin-top: 1.5vh;"></i>
                                                    </p>
                                                </a>
                                                <ul class="nav nav-treeview">
                                                    <li class="nav-item">
                                                        <a href="{{ route('SPMI') }}" class="nav-link">
                                                            <i class="fa-solid fa-folder-open"></i>
                                                            <p>SPMI FULL</p>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item menu-close">
                                                        <a href="index.php?halaman=spme" class="nav-link">
                                                            <i class="fa-solid fa-folder-open"></i>
                                                            <p>Penetapan</p>
                                                            <i class="right fas fa-angle-left"></i>
                                                        </a>
                                                        <ul class="nav nav-treeview">

                                                            <li class="nav-item">
                                                                <a href="{{ route('SPMI.Sub_kategori', 'Pengaturan Tentang Kebijakan SPMI') }}"
                                                                    class="nav-link">
                                                                    <i class="nav-icon fas fa-circle"></i>
                                                                    <p>Pengaturan Tentang Kebijakan SPMI</p>
                                                                </a>
                                                            </li>

                                                            <li class="nav-item">
                                                                <a href="{{ route('SPMI.Sub_kategori', 'Standar Yang Di Tetapkan Intitusi') }}"
                                                                    class="nav-link">
                                                                    <i class="nav-icon fas fa-circle"></i>
                                                                    <p>Standar Yang Di Tetapkan Intitusi</p>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="{{ route('SPMI.Sub_kategori', 'Standar Lain') }}"
                                                                    class="nav-link">
                                                                    <i class="nav-icon fas fa-circle"></i>
                                                                    <p>Standar Lain</p>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="{{ route('SPMI.kategori', 'Pelaksanaan') }}"
                                                            class="nav-link">
                                                            <i class="fa-solid fa-folder-open"></i>
                                                            <p>Pelaksanaan</p>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item  menu-close">
                                                        <a href="" class="nav-link">
                                                            <i class="fa-solid fa-folder-open"></i>
                                                            <p>Evaluasi</p>
                                                            <i class="right fas fa-angle-left"></i>
                                                        </a>
                                                        <ul class="nav nav-treeview">

                                                            <li class="nav-item">
                                                                <a href="{{ route('SPMI.Sub_kategori', 'Audit Mutu Internal') }}"
                                                                    class="nav-link">
                                                                    <i class="nav-icon fas fa-circle"></i>
                                                                    <p>Audit Mutu Internal</p>
                                                                </a>
                                                            </li>

                                                            <li class="nav-item">
                                                                <a href="{{ route('SPMI.Sub_kategori', 'Evaluasi Lain') }}"
                                                                    class="nav-link">
                                                                    <i class="nav-icon fas fa-circle"></i>
                                                                    <p>Evaluasi Lain</p>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="{{ route('SPMI.kategori', 'Pengendalian') }}"
                                                            class="nav-link">
                                                            <i class="fa-solid fa-folder-open"></i>
                                                            <p>Pengendalian</p>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="{{ route('SPMI.kategori', 'Peningkatan') }}"
                                                            class="nav-link">
                                                            <i class="fa-solid fa-folder-open"></i>
                                                            <p>Peningkatan</p>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item ">
                                                        <a href="{{ route('SPMI.kategori', 'Undang-Undang') }}"
                                                            class="nav-link">
                                                            <i class="fa-solid fa-folder-open"></i>
                                                            <p style="margin: 10px;">Undang Undang</p>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-item">
                                                <a href="index.php?halaman=spme" class="nav-link">
                                                    <i class="fa-solid fa-folder"></i>
                                                    <p>Sistem Penjaminan Mutu Eksternal(SPME)</p>
                                                </a>
                                            </li>

                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        {{-- Universitas --}}
                        @if (Auth::user()->role == 'admin' ||
                                auth()->user()->role === 'wr1' ||
                                auth()->user()->role === 'wr2' ||
                                auth()->user()->role === 'wr3')
                            <li class="nav-item menu-close">
                                <a href="#" class="nav-link">
                                    <i class="fa-solid fa-id-card-clip"></i>
                                    <p style="text-align: center;">
                                        Dokument Universitas
                                    </p>
                                    <i class="right fas fa-angle-left"></i>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('universitas', 'sk') }}" class="nav-link">
                                            <i class="fa-solid fa-folder"></i>
                                            <p>SK Rektor</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('universitas', 'pedoman') }}" class="nav-link">
                                            <i class="fa-solid fa-folder"></i>
                                            <p>Pedoman</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('universitas', 'lain-lain') }}" class="nav-link">
                                            <i class="fa-solid fa-folder"></i>
                                            <p>Lain-Lain</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        {{-- Fakultas --}}
                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'fakultas')
                            <li class="nav-item menu-close">
                                <a href="" class="nav-link">
                                    <i class="fa-solid fa-id-card-clip"></i>
                                    <p style="text-align: center;">
                                        Fakultas
                                    </p>
                                    <i class="right fas fa-angle-left"></i>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('file_fakultas', 'sk') }}" class="nav-link">
                                            <i class="fa-solid fa-folder"></i>
                                            <p>SK</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('file_fakultas', 'renstra') }}" class="nav-link">
                                            <i class="fa-solid fa-folder"></i>
                                            <p>Renstra</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('file_fakultas', 'lain') }}" class="nav-link">
                                            <i class="fa-solid fa-folder"></i>
                                            <p>Lain-Lain</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        {{-- Prodi --}}
                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'prodi')
                            <li class="nav-item menu-close">
                                <a href="#" class="nav-link">
                                    <i class="fa-solid fa-id-card-clip"></i>
                                    <p style="text-align: center;">
                                        Prodi
                                    </p>
                                    <i class="right fas fa-angle-left"></i>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('prodi', 'lain') }}" class="nav-link">
                                            <i class="fa-solid fa-folder"></i>
                                            <p>Data Prodi</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('prodi', 'kinerja') }}" class="nav-link">
                                            <i class="fa-solid fa-folder"></i>
                                            <p>Laporan Kinerja Program Studi</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('prodi', 'evaluasi') }}" class="nav-link">
                                            <i class="fa-solid fa-folder"></i>
                                            <p>Laporan Evaluasi Diri</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        {{-- Akreditasi --}}
                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'fakultas' || Auth::user()->role == 'prodi')
                            <li class="nav-item menu-close">
                                <a href="#" class="nav-link">
                                    <i class="fa-solid fa-id-card-clip"></i>
                                    <p style="text-align: center;">
                                        Akreditasi
                                    </p>
                                    <i class="right fas fa-angle-left"></i>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('akreditasi') }}" class="nav-link ">
                                            <i class="fa-solid fa-certificate"></i>
                                            <p style="margin-left: 10px;">Akreditasi</p>
                                        </a>
                                    </li>
                                    <li class="nav-item menu-close">
                                        <a href="#" class="nav-link">
                                            <i class="fa-solid fa-id-card-clip"></i>
                                            <p style="text-align: center;">
                                                Reakreditasi
                                            </p>
                                            <i class="right fas fa-angle-left"></i>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="{{ route('reakreditasi', 'sk') }}" class="nav-link">
                                                    <i class="fa-solid fa-folder"></i>
                                                    <p>SK</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('reakreditasi', 'led') }}" class="nav-link">
                                                    <i class="fa-solid fa-folder"></i>
                                                    <p>LED</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('reakreditasi', 'lkps') }}" class="nav-link">
                                                    <i class="fa-solid fa-folder"></i>
                                                    <p>LKPS</p>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('reakreditasi', 'penyusunan') }}" class="nav-link">
                                            <i class="fa-solid fa-folder"></i>
                                            <p>Proses Penyusunan LKPS dan LED</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        @endif
                        {{-- Master Data --}}
                        @if (Auth::user()->role == 'admin')
                            <li class="nav-item">
                                <a href="{{ route('berita') }}" class="nav-link">
                                    <i class="fa-solid fa-folder"></i>
                                    <p style="font-size:14.5px; margin-left: 10px;">

                                        Berita
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item menu-close">
                                <a href="#" class="nav-link">
                                    <i class="fa-solid fa-gear"></i>
                                    <p style="font-size:14.5px; margin-left: 10px;">

                                        Master Data
                                        <i class="right fas fa-angle-left" style="margin-top: 0.5vh;"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('fakultas') }}" class="nav-link">
                                            <i class="fa-solid fa-gears"></i>
                                            <p>Fakultas</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('jurusan') }}" class="nav-link">
                                            <i class="fa-solid fa-gears"></i>
                                            <p>Prodi</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('kategori') }}" class="nav-link">
                                            <i class="fa-solid fa-gears"></i>
                                            <p>kategori</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('sub_kategori') }}" class="nav-link">
                                            <i class="fa-solid fa-gears"></i>
                                            <p>Sub kategori</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('user') }}" class="nav-link">
                                            <i class="fa-solid fa-gears"></i>
                                            <p>Users</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('conten') }}" class="nav-link">
                                            <i class="fa-solid fa-gears"></i>
                                            <p>Content</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>



                            <!-- Menu Prodi  -->
                        @endif
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>


        <div class="content-wrapper">
            @yield('content')
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>

    <script>
        $('#myModal').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        });

        $(function() {
            $("#example2").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
        $(function() {
            bsCustomFileInput.init();
        });
        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });

        function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>

    @yield('script')

</body>

</html>
