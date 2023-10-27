@extends('layouts.setengah')

@section('content')
    <section id="visi&misi" class="" style="background: rgb(253, 253, 253); color: rgb(0, 0, 0);">



        <div class="container">

            <div class="section-title">
                <h2 class="fade-bottom">Dokumen Program Studi
                </h2>
            </div>


            <div class="row content spmi">
                <div class="col-lg-12 fade-kanan">
                    <h1 class="" style="text-align: center;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Fakultas</th>
                                    <th scope="col">Program studi</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">File</th>
                                    <th scope="col">Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($file_prodi as $data)
                                    <tr>
                                        <td style="text-align: left;">{{ $data->jurusan->fakultas->fakultas }}
                                        </td>
                                        <td style="text-align: left;">{{ $data->jurusan->jurusan }}</td>
                                        <td style="text-align: left;">{{ $data->judul }}</td>
                                        <td style="text-align: left;"><a
                                                href="{{ asset('storage/upload/' . str_replace(' ', '_', $data->jurusan->jurusan) . '/' . $data->nama_file) }}">Download</a>
                                        </td>
                                        <td style="text-align: left;">{{ $data->deskripsi }}</td>
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
