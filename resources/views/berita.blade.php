@extends('layouts.admin')

@section('content')
    <style>
        .scroll-container {
            white-space: nowrap;
            /* atur konten tidak dibungkus ke baris baru */
            overflow-x: scroll;
            /* atur overflow-x menjadi scroll */
            height: 200px;
            /* atur tinggi scroll container */
        }

        .image-wrapper {
            position: relative;
            display: inline-block;
            margin: 10px;
            min-width: 100px;
            min-height: 100px;
            max-height: 150px;
        }

        .image-wrapper img {
            display: block;
            width: 100%;
            height: auto;
            width: 100px;
            margin-left: 20px;

        }

        .overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            visibility: hidden;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .image-wrapper:hover .overlay {
            visibility: visible;
            opacity: 1;
        }

        .overlay button {
            margin: 10px;
        }
    </style>

    <div class="">
        <div class="row justify-content-center">
            <div class="col-md-12" style="margin-top: 20px;">
                @include('layouts/flash')
                <div class="card">
                    <div class="card-header">
                        <h3>Data {{ $title }}</h3>
                    </div>
                    <!-- Button trigger modal -->
                    <div class="col-md-8" style="margin-top: 10px; margin-bottom: 10px;">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                            Tambah Data {{ $title }}
                        </button>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModal" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Form {{ $title }} </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('berita.store') }}" method="post" class="formkirim"
                                    enctype="multipart/form-data">
                                    <div class="modal-body" style="max-height: 400px; overflow-y: scroll;">

                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label class="form-label">Judul</label>
                                                            <input type="text"
                                                                class="form-control judul @error('judul') is-invalid @enderror"
                                                                name="judul">
                                                            @error('judul')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>


                                                        <div class="mb-3">
                                                            <label class="form-label">Isi</label>

                                                            <textarea class="form-control isi @error('isi') is-invalid @enderror" id="summernote" name="isi"></textarea>

                                                            @error('isi')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Thumbnail</label>
                                                            <div class="custom-file">
                                                                <input type="file"
                                                                    class="custom-file-input thumbnail @error('thumbnail') is-invalid @enderror"
                                                                    name="thumbnail" id="customFile">
                                                                <label class="custom-file-label" for="customFile">
                                                                    Pilih Gambar
                                                                </label>
                                                            </div>
                                                            @error('thumbnail')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <input type="hidden" name="id" class="id">
                                                    <input type="hidden" name="data_lama" class="data-old-file">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="submit">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Isi</th>
                                <th>Thumbnail</th>
                                <th>File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($berita as $data)
                                <tr>
                                    <td style="width: 5px">{{ $no }}</td>
                                    <td>{{ $data->judul }}</td>
                                    <td>{!! $data->isi !!}</td>
                                    <td>
                                        <img class="foto"
                                            src="{{ asset('storage/upload/berita/thumbnail' . '/' . $data->thumbnail) }}"
                                            alt="" style="width: 100px">
                                    </td>

                                    @if ($data->img_berita != null)
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#modalimg{{ $no }}">
                                                gallery berita
                                            </button>
                                        </td>
                                    @else
                                        <td>
                                            Tidak ada Gambar
                                        </td>
                                    @endif

                                    <td>

                                        <form action="{{ route('berita.destroy', $data->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="" class="btn btn-sm btn-outline-success buttonedit"
                                                data-toggle="modal" data-target="#myModal" data-judul="{{ $data->judul }}"
                                                data-old-file="{{ $data->thumbnail }}" data-isi="{{ $data->isi }}"
                                                data-id="{{ $data->id }}"
                                                data-url="{{ route('berita.update', $data->id) }}">
                                                Edit
                                            </a> |
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Apakah Anda Yakin?')">Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal
                                                fade"
                                    id="modalimg{{ $no }}" tabindex="-1" aria-labelledby="modalimg"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Upload / Edit
                                                    Gallery</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                </style>
                                                <div class="container">
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-12">
                                                            <div class="scroll-container">

                                                                @foreach ($data->img_berita as $image)
                                                                    <div class="image-wrapper">
                                                                        <img class="img_gallery_{{ $image->id }}"
                                                                            src="{{ asset('storage/upload/berita/gallery' . '/' . $image->file) }}"
                                                                            alt=""
                                                                            style=" min-width: 150px; min-height: 150px; max-height: 150px;">
                                                                        <div class="overlay">

                                                                            <form
                                                                                action="{{ route('berita.img_destroy', $image->id) }}"
                                                                                method="post">
                                                                                @csrf
                                                                                @method('delete')
                                                                                <button type="submit"
                                                                                    class="btn btn-sm btn-outline-danger"
                                                                                    onclick="return confirm('Apakah Anda Yakin?')">Delete</button>
                                                                            </form>

                                                                            <label for="file-input-{{ $image->id }}"
                                                                                class="btn btn-primary edit"
                                                                                style="margin-top: 10px">Edit
                                                                            </label>
                                                                            </form>
                                                                            <form id="uploadForm-{{ $image->id }}"
                                                                                class="uploadForm"
                                                                                enctype="multipart/form-data">

                                                                                <input id="file-input-{{ $image->id }}"
                                                                                    class="file-input" type="file"
                                                                                    name="file" style="display: none;"
                                                                                    data_id_img="{{ $image->id }}"
                                                                                    data_old_file="{{ $image->file }}">
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                @endforeach

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('berita.image', $data->id) }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="file" name="images[]" multiple>
                                                    <button class="btn btn-primary" type="submit">Upload
                                                        Gambar</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @php
                                    $no++;
                                @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Isi</th>
                                <th>Thumbnail</th>
                                <th>File</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();

            $('#summernote').summernote({
                placeholder: 'Hello stand alone ui',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear', 'italic']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            $('.file-input').change(function() {
                var id_img = $(this).attr('data_id_img');
                var old_file = $(this).attr('data_old_file');
                var data_judul = $(this).attr('data-judul');
                var _token = $('input[name="_token"]').val();
                var formData = new FormData($('#uploadForm-' + id_img)[0]);
                formData.append('id_img',
                    id_img);
                formData.append('_token', _token);
                formData.append('old_file',
                    old_file);
                formData.append('data_judul', data_judul);
                $.ajax({
                    url: '{{ route('berita.img_edit') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $(data['id_img']).attr('src', '../storage/upload/berita/gallery/' +
                            data[
                                'foto']);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        // handle error response
                    }
                });
            });

        });

        $(document).on('click', '.buttonedit', function() {
            var data_id = $(this).attr('data-id');
            var data_judul = $(this).attr('data-judul');
            var data_isi = $(this).attr('data-isi');
            var data_url = $(this).attr('data-url');
            var data_old_file = $(this).attr('data-old-file');
            $('.judul').attr('value', data_judul);
            $('.isi').summernote('code', data_isi);
            $('.id').attr('value', data_id);
            $('.data-old-file').attr('value', data_old_file);
            $('.formkirim').attr('action', data_url);
        });
    </script>
@endsection
