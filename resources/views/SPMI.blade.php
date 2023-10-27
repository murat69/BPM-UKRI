@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-5">
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
                            Tambah Data
                        </button>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Input Data {{ $title }}</h5>

                                </div>
                                <form action="{{ route('SPMI.store') }}" method="post" enctype="multipart/form-data"
                                    class="formkirim">
                                    <div class="modal-body">

                                        <div class="container card-body">
                                            <div class="row justify-content-center">
                                                <div class="col-md-12">

                                                    @csrf
                                                    <div class="form-group">
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama/Judul File</label>
                                                            <input type="text"
                                                                class="form-control judul @error('judul') is-invalid @enderror"
                                                                name="judul">
                                                            @error('judul')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="mb-3">
                                                            <label class="form-label">File</label>
                                                            <div class="custom-file">
                                                                <input type="file"
                                                                    class="custom-file-input nama_file @error('nama_file') is-invalid @enderror"
                                                                    name="nama_file" id="customFile">
                                                                <label class="custom-file-label" for="customFile">
                                                                    Pilih file
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="mb-3">
                                                            <label class="form-label">Kategori</label>
                                                            <select
                                                                class="form-control kategori @error('kategori') is-invalid @enderror"
                                                                name="kategori" id="select1" style="width: 100%;">
                                                                <option selected>Pilih Salah Satu</option>
                                                                @foreach ($kategori as $datas)
                                                                    <option value="{{ $datas->id }}">
                                                                        {{ $datas->kategori }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="mb-3">
                                                            <label class="form-label">Sub Kategori</label>
                                                            <select
                                                                class="form-control sub_kategori @error('sub_kategori') is-invalid @enderror"
                                                                name="sub_kategori" id="select2">
                                                                <option selected>Pilih Salah Kategori dulu</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="mb-3">
                                                            <label class="form-label">Akses</label>
                                                            <select
                                                                class="form-control  akses @error('akses') is-invalid @enderror"
                                                                name="akses" id="">
                                                                <option selected value="Internal">Internal</option>
                                                                <option value="Publik">Publik</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="id" class="id">
                                                    <input type="hidden" class="data_old_file" name="data_old_file">

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
                                <th>File</th>
                                <th>Kategori</th>
                                <th>Sub Kategori</th>
                                <th>Akses</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                
                                $no = 1;
                            @endphp
                            @foreach ($spmi as $data)
                                <tr>
                                    <td style="width: 5px">{{ $no }}</td>

                                    <td>{{ $data->judul }}</td>

                                    <td>
                                        <a href="{{ asset('storage/upload/' . $data->nama_file) }}" target="_blank">
                                            Download
                                        </a>
                                    </td>


                                    <td> {{ $data->kategori->kategori }}</td>

                                    @if ($data->sub_kategori_id != null)
                                        <td>{{ $data->sub_kategori->sub_kategori }}</td>
                                    @else
                                        <td>kosong</td>
                                    @endif
                                    <td>{{ $data->akses }}</td>
                                    <td>
                                        <form action="{{ route('SPMI.destroy', $data->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="" class="btn btn-sm btn-outline-success buttonedit"
                                                data-toggle="modal" data-target="#myModal"
                                                data-subkategori="{{ $data->sub_kategori_id }}"
                                                data-judul="{{ $data->judul }}" data-kategori="{{ $data->kategori_id }}"
                                                data-akses="{{ $data->akses }}" data-id="{{ $data->id }}"
                                                data-old-file="{{ $data->nama_file }}"
                                                data-url="{{ route('SPMI.update', $data->id) }}">
                                                Edit
                                            </a> |
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Apakah Anda Yakin?')">Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @php
                                    $no++;
                                @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>File</th>
                                <th>Kategori</th>
                                <th>Sub Kategori</th>
                                <th>Akses</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // $('#example').DataTable();

            $('#select1').change(function() {
                var id = $(this).val();

                $.ajax({
                    url: "{{ route('SPMI.getdata', ':id') }}".replace(':id', id),
                    method: 'get',
                    dataType: 'json',
                    success: function(data) {
                        var options = '';
                        $.each(data, function(index, value) {
                            options += '<option value="' + value.id + '">' + value
                                .sub_kategori + '</option>';
                        });
                        $('#select2').html(options);
                    }
                });
            });
        });
        $(document).on('click', '.buttonedit', function() {
            var data_id = $(this).attr('data-id');
            var data_subkategori = $(this).attr('data-subkategori');
            var data_akses = $(this).attr('data-akses');
            var data_judul = $(this).attr('data-judul');
            var data_kategori = $(this).attr('data-kategori');
            var data_url = $(this).attr('data-url');
            var data_old_file = $(this).attr('data-old-file');
            $("select.kategori").val(data_kategori);
            $("select.akses").val(data_akses);
            $('.judul').attr('value', data_judul);
            $('.id').attr('value', data_id);
            $('.formkirim').attr('action', data_url);
            $('.data_old_file').attr('value', data_old_file);

            var id = data_kategori;
            $.ajax({
                url: "{{ route('SPMI.getdata', ':id') }}".replace(':id', id),
                method: 'get',
                dataType: 'json',
                success: function(data) {
                    var options = '';
                    $.each(data, function(index, value) {
                        if (value.id == data_subkategori) {
                            options += '<option value="' + value.id + '" selected>' + value
                                .sub_kategori + '</option>';
                        }
                    });
                    $('#select2').html(options);
                }
            });
        });
    </script>
@endsection
