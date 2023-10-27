@extends('layouts.setengah')

@section('content')
    <section id="visi&misi" class="about" style="background: rgb(253, 253, 253); color: rgb(0, 0, 0);">
        <div class="container">

            <div class="section-title">
                <h2 class="fade-bottom">Visi & Misi</h2>
            </div>

            <div class="row content">
                <div class="col-lg-6 fade-kanan">
                    <h1 class="" style="text-align: center;">
                        Visi
                    </h1>
                    <p>{{ $visi->conten }}</p>
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 fade-kiri">
                    <h1 style="text-align: center;">
                        Misi
                    </h1>
                    <p>{{ $misi->conten }}</p>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts" style="background: rgb(128, 0, 0); color: #fff!important;">
        <div class="container">

            <div class="row justify-content-center counters">

                <div class="col-lg-12 col-6">

                    <h1 style="text-align: center;">Tugas</h1>
                    <p style="text-align: left;">{{ $tugas->conten }}</p>

                    <h1 style="text-align: center;">Fungsi</h1>
                    <p style="text-align: right;">{{ $fungsi->conten }}</p>
                </div>



            </div>

        </div>
    </section><!-- End Counts Section -->



    <!-- ======= Testimonials Section ======= -->
    <section id="akreditasi" class="testimonials section-bg">
        <div class="container">

            <div class="section-title">
                <h2>Struktur Organisasi BPM</h2>
            </div>

            <img src="{{ asset('img/STOK DRAF 222002-BPM.jpg') }}" alt="">
        </div>
    </section><!-- End Testimonials Section -->
@endsection
