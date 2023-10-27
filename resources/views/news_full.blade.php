@extends('layouts.setengah')


@section('style')
    <!-- Scripts -->
    <style>
        .section-berita {
            background-color: #f8f9fa;
            padding: 80px 0;
        }

        .section-judul {
            font-size: 36px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 60px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            margin-bottom: 30px;
        }

        .card-img-top {
            border-radius: 10px 10px 0 0;
        }

        .card-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }

        .card-text {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 30px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-size: 16px;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .img_card_berita {
            height: 200px;
            width: 416px;
            overflow: hidden;
            background-size: contain !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
        }
    </style>
@endsection

@section('content')
    {{-- Section Berita --}}
    <section class="section-berita">
        <div class="container">
            <div class="section-title">
                <h2>Berita BPM UKRI</h2>
            </div>
            <div class="row" id="perdata">
                @foreach ($data as $item)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="img_card_berita"
                                style=" background: url({{ asset('storage/upload/berita/thumbnail' . '/' . $item->thumbnail) }}); ">

                            </div>
                            <div class="card-body">
                                <h3 class="card-title">{{ $item->judul }}</h3>
                                <p class="card-text">{!! Str::limit($item->isi, 180, '...') !!}</p>
                                @php
                                    $slug = enc($item->id) . '-' . $item->slug;
                                @endphp
                                <a href="{{ route('baca.news', $slug) }}" class="btn btn-primary">Baca
                                    Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <button id="load-more-btn" data-page="2" data-per-page="10" class="btn btn-primary">Load More</button>

                </div>
            </div>
        </div>
    </section>
    {{-- End Section Berita --}}
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#load-more-btn', function() {
                var page = $(this).data('page');
                var perPage = $(this).data('per-page');
                var url = '/baca/semua/loadmore?page=' + page;
                $.ajax({
                    url: url,
                    success: function(response) {
                        // Menambahkan data baru ke tampilan
                        console.log(response);
                        var no = 0;
                        $.each(response.data.data, function(key, value) {

                            var dataItem = '<div class="col-md-4">';
                            dataItem += ' <div class="card">';
                            dataItem +=
                                "<div class='img_card_berita' style='background: url({{ asset('storage/upload/berita/thumbnail') }}/" +
                                value.thumbnail + ") '; >";
                            dataItem += "</div>";
                            dataItem += ' <div class="card-body">';
                            dataItem += '<h3 class="card-title">' + value.judul;
                            dataItem += '</h3>';
                            dataItem += '<p class="card-text">' + value.isi +
                                '</p>';
                            dataItem += " <a href='/baca/berita/" + response.slug[no] +
                                "' class='btn btn-primary'>Baca Selengkapnya </a>"
                            dataItem += '</div>';
                            dataItem += '</div>';
                            dataItem += '</div>';
                            $('#perdata').append(dataItem);
                            no = no + 1;
                        });
                        // Mengubah nilai data-page pada tombol load more
                        $('#load-more-btn').data('page', page + 1);
                    }
                });
            });
        });
    </script>
@endsection
