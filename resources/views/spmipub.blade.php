@extends('layouts.setengah')

@section('content')
    <!-- ======= About Section ======= -->
    <section id="visi&misi" class="about" style="background: rgb(253, 253, 253); color: rgb(0, 0, 0);">
        <div class="container">

            <div class="section-title">
                <h2 class="fade-bottom" style="font-size: 40px;">Tentang SPMI</h2>
            </div>

            <div class="row content">
                <div class="col-lg-12 fade-kanan">
                    <p style="font-size: 20px;">{{ $tentang->conten }}
                    </p>
                </div>

            </div>

            <div class="section-title" style="padding-top: 60px;">
                <h2 class="fade-bottom" style="font-size: 40px;">Document SPMI</h2>
            </div>

            <div class="row content">
                <div class="col-lg-12 fade-kanan ">
                    <p style="font-size: 20px;">{{ $dokumen->conten }}</p>

                </div>

                <div class="col-lg-12 fade-kanan d-flex justify-content-center">

                    <button type="submit" name="spmi" class="btn-get-started " style="margin-top: 6px;">
                        Read More
                    </button>

                </div>
            </div>

            <div class="section-title" style="padding-top: 60px;">
                <h2 class="fade-bottom" style="font-size: 40px;">Pelaksanaan SPMI</h2>
            </div>

            <div class="row content">
                <div class="col-lg-12 fade-kanan ">
                    <p style="font-size: 20px;">{{ $pelaksanaan->conten }}</p>

                </div>

                <div class="col-lg-12 fade-kanan d-flex justify-content-center">

                    <button type="submit" name="spmi" class="btn-get-started " style="margin-top: 6px;">
                        Read More
                    </button>

                </div>
            </div>

            <div class="section-title" style="padding-top: 60px;">
                <h2 class="fade-bottom" style="font-size: 40px;">Laporan SPMI - UPM</h2>
            </div>

            <div class="row content">
                <div class="col-lg-12 fade-kanan ">
                    <p style="font-size: 20px;">{{ $laporan->conten }}</p>

                </div>

                <div class="col-lg-12 fade-kanan d-flex justify-content-center">

                    <button type="submit" name="spmi" class="btn-get-started " style="margin-top: 6px;">
                        Read More
                    </button>

                </div>
            </div>

            <div class="section-title" style="padding-top: 60px;">
                <h2 class="fade-bottom" style="font-size: 40px;">Survey SPMI</h2>
            </div>

            <div class="row content">
                <div class="col-lg-12 fade-kanan ">
                    <p style="font-size: 20px;">{{ $survey->conten }}</p>

                </div>

                <div class="col-lg-12 fade-kanan d-flex justify-content-center">

                    <button type="submit" name="spmi" class="btn-get-started " style="margin-top: 6px;">
                        Read More
                    </button>

                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    <!-- ======= About Section ======= -->
    <section id="visi&misi" class="about" style="background: rgb(253, 253, 253); color: rgb(0, 0, 0); padding-top: 20px">
        <div class="container">



        </div>
    </section><!-- End About Section -->
@endsection
