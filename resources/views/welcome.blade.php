@extends('layouts.app')

@section('content')
    <!-- ======= About Section ======= -->
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
                    <p>{{ $visi->conten }}
                    </p>
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 fade-kiri">
                    <h1 style="text-align: center;">
                        Misi
                    </h1>
                    <p>{{ $misi->conten }}
                    </p>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts" style="background: rgb(128, 0, 0); color: #fff!important;">
        <div class="container">

            <div class="row counters justify-content-center">

                <div class="col-lg-2 col-6 text-center">

                    <a href="{{ route('spmi-pub', 'Penetapan') }}" name="spmi"
                        style="background-color: transparent; border: 0px;">
                        <div class="d-flex justify-content-center circle">
                            <span class=""><i class="fa-solid fa-gavel"></i></span>
                        </div>
                    </a>
                    <p>
                        Penetapan
                    </p>

                </div>

                <div class="col-lg-2 col-6 text-center">
                    <a href="{{ route('spmi-pub', 'Pelaksanaan') }}" name="audit"
                        style="background-color: transparent; border: 0px;">
                        <div class="d-flex justify-content-center circle">
                            <span><i class="fa-solid fa-binoculars"></i></span>
                        </div>
                    </a>
                    <p>Pelaksanaan</p>
                </div>

                <div class="col-lg-2 col-6 text-center">
                    <a href="{{ route('spmi-pub', 'Evaluasi') }}" name="evaluasi"
                        style="background-color: transparent; border: 0px;">
                        <div class="d-flex justify-content-center circle">
                            <span><i class="fa-solid fa-arrow-rotate-right"></i></span>
                        </div>
                    </a>
                    <p>Evaluasi</p>
                </div>

                <div class="col-lg-2 col-6 text-center">
                    <a href="{{ route('spmi-pub', 'Pengendalian') }}" name="akre"
                        style="background-color: transparent; border: 0px;">
                        <div class="d-flex justify-content-center circle">
                            <span><i class="fa-solid fa-magnifying-glass"></i></span>
                        </div>
                    </a>
                    <p>Pengendalian</p>
                </div>

                <div class="col-lg-2 col-6 text-center">
                    <a href="{{ route('spmi-pub', 'Peningkatan') }}" name="akre"
                        style="background-color: transparent; border: 0px;">
                        <div class="d-flex justify-content-center circle">
                            <span><i class="fa-solid fa-arrow-trend-up"></i></span>
                        </div>
                    </a>
                    <p>Peningakatan</p>
                </div>

            </div>

        </div>
    </section><!-- End Counts Section -->



    <!-- ======= Testimonials Section ======= -->
    <section id="akreditasi" class="testimonials section-bg">
        <div class="container">

            <div class="section-title">
                <h2>Info Akreditasi</h2>
            </div>

            <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">

                    @foreach ($akreditasi as $item)
                        <div class="swiper-slide">
                            <div class="testimonial-item">

                                <p>
                                  
                                    {{ $item->jurusan->jurusan }}
                                </p>
                                <img src="{{ asset('storage/upload/' . $item->nama_file) }}" class="testimonial-img"
                                    alt="">
                                <h3>Terakreditasi {{ $item->akreditasi }}</h3>
                            </div>
                        </div>
                    @endforeach
                    <!-- End testimonial item -->

                </div>

            </div>

        </div>
    </section><!-- End Testimonials Section -->

    {{-- Section Berita --}}
    <section class="section-berita">
        <div class="container">
            <div class="section-title">
                <h2>Berita Terbaru</h2>
            </div>
            <div class="row">
                @foreach ($berita as $data)
                    <div class="col-md-4">
                        <div class="card">
                            <div
                                style="
                                height: 200px; 
                                width: 416px; 
                                overflow: 
                                hidden; background: url('{{ asset('storage/upload/berita/thumbnail' . '/' . $data->thumbnail) }}'); 
                                background-size: contain;
                                background-position: center;
                                background-repeat: no-repeat;">

                            </div>
                            <div class="card-body">
                                <h3 class="card-title">{{ $data->judul }}</h3>
                                <p class="card-text">{!! Str::limit($data->isi, 180, '...') !!}</p>
                                @php
                                    $slug = enc($data->id) . '-' . $data->slug;
                                @endphp
                                <a href="{{ route('baca.news', $slug) }}" class="btn btn-primary">Baca
                                    Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="text-center" style="margin-top: 50px">
                <a href="{{ route('baca.full') }}" class="btn btn-lg btn-primary">Semua Berita</a>
            </div>

        </div>
    </section>
    {{-- End Section Berita --}}
@endsection
