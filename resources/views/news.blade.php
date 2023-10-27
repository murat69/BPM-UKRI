@extends('layouts.setengah')


@section('style')
    <link rel="stylesheet" href="{{ asset('vendor\OwlCarousel\docs\assets\owlcarousel\assets\owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor\OwlCarousel\docs\assets\owlcarousel\assets\owl.theme.default.min.css') }}">
    <style>
        .modal-body {
            text-align: center;
        }

        .modal-body img {
            max-width: 100%;
            max-height: 80vh;
            margin: 0 auto;
        }

        body {
            font-family: Arial, sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: bold;
        }

        p.lead {
            font-size: 1.2em;
        }

        .embed-responsive {
            margin: 20px 0;
        }

        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .gallery img {
            margin: 10px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            transition: box-shadow 0.3s ease;
        }

        .gallery img:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .comments {
            margin-top: 50px;
        }

        /* Media queries */
        @media screen and (max-width: 768px) {
            .gallery {
                justify-content: space-between;
            }

            .gallery img {
                max-width: 45%;
            }
        }

        @media screen and (max-width: 576px) {
            .gallery {
                flex-direction: column;
                align-items: center;
            }

            .gallery img {
                max-width: 80%;
            }
        }

        @media screen and (max-width: 768px) {
            .main-content {
                margin-top: 20px;
            }
        }

        @media screen and (max-width: 576px) {
            .main-content {
                margin-top: 10px;
            }
        }

        /* Custom styles */
        .container {
            margin-top: 50px;
        }

        .news-img {
            max-width: 100%;
            margin-bottom: 20px;
            border-radius: 5px;

            text-align: center;
        }

        .news-img img {
            max-width: 900px;
        }

        .author {
            font-style: italic;
            margin-bottom: 10px;
        }

        .comment {
            margin-bottom: 20px;
        }

        .comment h4 {
            margin-bottom: 5px;
        }

        .list-unstyled {
            margin-top: 20px;
            padding-left: 0;
        }

        .list-unstyled li {
            margin-bottom: 10px;
        }

        .list-unstyled li a {
            color: #337ab7;
        }

        .list-unstyled li a:hover {
            text-decoration: none;
            color: #23527c;
        }

        .related-news {
            padding: 0 !important;
        }

        .related-news h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .related-news .card {
            border: none;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .related-news .card:hover {
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }

        .related-news .card-img-top {
            height: 200px;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .related-news .card-title {
            font-size: 18px;
            margin-bottom: 10px;
            text-transform: capitalize;
        }

        .related-news .card-text {
            font-size: 14px;
            margin-bottom: 15px;
        }

        .related-news .btn-primary {
            font-size: 14px;
            background-color: #007bff;
            border-color: #007bff;
            transition: all 0.3s ease-in-out;
        }

        .related-news .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
            transform: translateY(-2px);
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">{{ $berita->judul }}</h1>
                <div class="news-img">
                    <img src="{{ asset('storage/upload/berita/thumbnail' . '/' . $berita->thumbnail) }}"
                        alt="{{ $berita->judul }}">
                </div>
                <p>{!! $berita->isi !!}</p>
                <h1 style="text-align: center;">Gallery</h1>
                <div class="gallery">
                    <div class="owl-carousel owl-theme">
                        @foreach ($berita->img_berita as $gallery)
                            <a href="#" class="shoot" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                data-img="{{ asset('storage/upload/berita/gallery' . '/' . $gallery->file) }}">
                                <div class="item"
                                    style="max-height: 110px; 
                                min-height: 110px;
                                overflow: 
                                hidden; background: url('{{ asset('storage/upload/berita/gallery' . '/' . $gallery->file) }}'); 
                                background-size: contain;
                                background-position: center;
                                background-repeat: no-repeat">
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>


                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-body">
                                <img class="mdl-img" src="gambar.jpg" alt="Gambar" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>

                <section class="related-news">
                    <div class="container">
                        <h3>Berita Lain</h3>
                        <div class="row">
                            @foreach ($related as $data)
                                <div class="col-md-3 col-sm-6">
                                    <div class="card mb-4">
                                        <a href="#">
                                            <div class="card-img-top"
                                                style=" overflow: 
                                                        hidden; background: url('{{ asset('storage/upload/berita/thumbnail' . '/' . $data->thumbnail) }}'); 
                                                        background-size: contain;
                                                        background-position: center;
                                                        background-repeat: no-repeat;">
                                            </div>
                                        </a>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $data->judul }}</h5>
                                            <p class="card-text">{!! Str::limit($data->isi, 100, '...') !!}</p>
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
                    </div>
                </section>

            </div>

        </div>
    @endsection

    @section('script')
        <script src="{{ asset('vendor\OwlCarousel\docs\assets\owlcarousel\owl.carousel.js') }}"></script>
        <script>
            $(document).on('click', '.shoot', function() {
                var data_img = $(this).attr('data-img');
                console.log(data_img);
                $('.mdl-img').attr('src', data_img);
            });

            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 5
                    }
                }
            })
        </script>
    @endsection
