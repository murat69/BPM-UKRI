@extends('layouts.setengah')

@section('content')
    <section id="visi&misi" class="about" style="background: rgb(253, 253, 253); color: rgb(0, 0, 0);">
        <div class="container">

            <div class="section-title">
                <h2 class="fade-bottom" style="font-size: 40px;">Akreditasi UKRI</h2>
            </div>

            <div class="row content">
                <div class="col-lg-12 fade-kanan d-flex justify-content-center">
                    <p style="font-size: 20px;"><span> Akreditasi Institusi Baik </span> Universitas Kebangsaan Republik Indonesia
                                telah
                                mendapatkan Akreditasi Institusi Baik dari Badan Akreditasi Nasional Perguruan Tinggi
                                (BAN-PT) pada tahun 2022
                                <br>(Surat Keputusan 138/SK/BAN-PT/Ak-PNB/PT/IV/2022).
                    </p>
                    </p>

                </div>

                <div class="col-lg-12 fade-kanan d-flex justify-content-center">
                    <img src="{{ asset('img/akre/Sertifikat PNB Univ.png') }}" alt="" class="imgakre">
                </div>

            </div>
        </div>
    </section><!-- End About Section -->

    <section id="visi&misi" class="" style="background: rgb(253, 253, 253); color: rgb(0, 0, 0);">



        <div class="container">

            <div class="section-title">
                <h2 class="fade-bottom">Akreditasi BAN-PT</h2>
            </div>


            <div class="row content spmi">
                <div class="col-lg-12 fade-kanan">
                    <h1 class="" style="text-align: center;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Fakultas</th>
                                    <th scope="col">Program studi</th>
                                    <th scope="col">Jenjang</th>
                                    <th scope="col">Akreditasi</th>
                                    <th scope="col">SK BAN-PT</th>
                                    <th scope="col">Tanggal SK</th>
                                    <th scope="col">File</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($akreditasi as $data)
                                    <tr>
                                        <td style="text-align: left;">{{ $data->jurusan->fakultas->fakultas }}
                                        </td>
                                        <td style="text-align: left;">{{ $data->jurusan->jurusan }}</td>
                                        <td style="text-align: left;">{{ $data->srata }}</td>
                                        <td style="text-align: left;">{{ $data->akreditasi }}</td>
                                        <td style="text-align: left;">{{ $data->sk }}</td>
                                        <td style="text-align: left;">{{ $data->tanggal_m }}</td>
                                        <td><a href="{{ asset('storage/upload/' . str_replace(' ', '_', $data->jurusan->jurusan) . '/' . $data->nama_file) }}"
                                                target="_blank">Download</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>

        </div>
    </section>
    <!-- End About Section -->
@endsection
