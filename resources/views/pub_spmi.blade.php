@extends('layouts.setengah')

@section('content')
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


    <section id="visi&misi" class="" style="background: rgb(253, 253, 253); color: rgb(0, 0, 0);">



        <div class="container">

            <div class="section-title">
                <h2 class="fade-bottom">Dokument {{ $kat }}</h2>
            </div>


            <div class="row content spmi">
                <div class="col-lg-12 fade-kanan">
                    <h1 class="" style="text-align: center;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Judul</th>
                                    <th scope="col">File</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($spmi as $data)
                                    <tr>
                                        <td style="text-align: left;">{{ $data->judul }}
                                        </td>
                                        <td style="text-align: left;"><a
                                            target="_blank"    href="{{ asset('storage/upload/' . $data->nama_file) }}">Download</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>

        </div>
    </section>
@endsection
