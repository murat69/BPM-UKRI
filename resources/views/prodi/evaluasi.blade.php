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
                    @if (Auth::user()->role == 'admin')
                        <div class="col-md-8" style="margin-top: 10px; margin-bottom: 10px;">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">List Fakultas</label>
                                        <select class="form-control list" name="monev">
                                            @foreach ($prodi as $item)
                                                <option value="{{ $item->jurusan }}">
                                                    {{ $item->jurusan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <a class="btn btn-primary buttonajax">
                                        Cari Data
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- Button trigger modal -->
                    <div class="col-md-8" style="margin-top: 10px; margin-bottom: 10px;">
                        <button type="button" class="btn btn-primary buttonedit" data-toggle="modal" data-target="#myModal"
                            data-url="{{ route('prodi.store') }}">
                            Tambah Data {{ $title }}
                        </button>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModal">Input Data {{ $title }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('prodi.store') }}" method="post" class="formkirim"
                                    enctype="multipart/form-data">
                                    <div class="modal-body">

                                        <div class="container">
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
                                                                    Pilih File
                                                                </label>
                                                            </div>
                                                            @error('nama_file')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="mb-3">
                                                            <label class="form-label">Deskripsi</label>
                                                            <textarea class="form-control deskripsi @error('deskripsi') is-invalid @enderror" id="exampleFormControlTextarea1"
                                                                rows="3" name="deskripsi"></textarea>
                                                            @error('deskripsi')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    @if (Auth::user()->role == 'admin')
                                                        <div class="form-group">
                                                            <div class="mb-3">
                                                                <label class="form-label">Jurusan</label>
                                                                <select
                                                                    class="form-control jurusan @error('jurusan') is-invalid @enderror"
                                                                    name="jurusan">
                                                                    @foreach ($prodi as $item)
                                                                        <option value="{{ $item->id }}">
                                                                            {{ $item->jurusan }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('jurusan')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    @else
                                                        <input type="hidden" value="{{ Auth::user()->jurusan_id }}"
                                                            name="jurusan">
                                                    @endif

                                                    <input type="hidden" name="old_file" class="old-file">
                                                    <input type="hidden" name="kategori" class="kategori" value="evaluasi">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
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
                                <th>jurusan</th>
                                <th>Judul</th>
                                <th>File</th>
                                <th>Deskripsi</th>
                                <th>Pengirim</th>
                                <th>Status</th>
                                <th>Pesan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($file as $data)
                                <tr>
                                    <td style="width: 5px">{{ $no }}</td>
                                    <td>{{ $data->jurusan->jurusan }}</td>
                                    <td> {{ $data->judul }}</td>
                                    <td><a href="{{ asset('storage/upload/' . $data->nama_file) }} "
                                            target="_blank">Download</a>
                                    </td>
                                    <td>{{ $data->deskripsi }}</td>
                                    <td>{{ $data->user->name }}</td>
                                    @if (Auth::user()->role == 'admin')
                                        <td>
                                            <div class="form-group">
                                                <div class="mb-3">
                                                    <select class="form-control status" name="status"
                                                        data_id="{{ $data->id }}">
                                                        <option value="">Pilih Salah Satu</option>
                                                        <option value="Data Sedang Di Cek"
                                                            @if ($data->status == 'Data Sedang Di Cek') selected @endif>Data
                                                            Sedang Di
                                                            Cek</option>
                                                        <option value="Data Tidak Memenuhi"
                                                            @if ($data->status == 'Data Tidak Memenuhi') selected @endif>Data Tidak
                                                            Memenuhi
                                                        </option>
                                                        <option value="Data Sudah Valid"
                                                            @if ($data->status == 'Data Sudah Valid') selected @endif>Data Sudah
                                                            Valid
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control pesan" name="pesan"
                                                    data_id="{{ $data->id }}" style="display: none;"
                                                    value="{{ $data->pesan }}">
                                            </div>
                                        </td>
                                    @else
                                        <td
                                            style="@if ($data->status == 'Data Sedang Di Cek') background-color: #ffe847; color: #000; @elseif($data->status == 'Data Tidak Memenuhi') background-color: #800000; color: #ffffff;@elseif($data->status == 'Data Sudah Valid') background-color: #339f3c; color: #ffffff; @endif">
                                            {{ $data->status }}
                                        </td>
                                        <td>
                                            @if ($data->status == 'Data Tidak Memenuhi')
                                                {{ $data->pesan }}
                                            @endif
                                        </td>
                                    @endif
                                    <td>
                                        <form action="{{ route('prodi.destroy', $data->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="" class="btn btn-sm btn-outline-success buttonedit"
                                                data-toggle="modal" data-target="#myModal"
                                                data-nama="{{ $data->nama }}" data-old-file="{{ $data->nama_file }}"
                                                data-judul="{{ $data->judul }}" data-jurusan="{{ $data->jurusan_id }}"
                                                data-deskripsi="{{ $data->deskripsi }}"
                                                data-url="{{ route('prodi.update', $data->id) }}">
                                                Edit
                                            </a> |


                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Apakah Anda Yakin?')">
                                                Delete
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
                                <th>jurusan</th>
                                <th>Judul</th>
                                <th>File</th>
                                <th>Deskripsi</th>
                                <th>Pengirim</th>
                                <th>Status</th>
                                <th>Pesan</th>
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
        });

        $(document).on('click', '.buttonajax', function() {

            var selectedList = $('.list').val();
            var newURL =
                "{{ route('prodi', ['kategori' => 'lain', 'kat_fak' => ':kat_fak']) }}";
            newURL = newURL.replace(':kat_fak', selectedList);
            $('.buttonajax').attr('href', newURL);
        });
        $(document).on('click', '.buttonedit', function() {
            var data_id = $(this).attr('data-id');
            var data_jurusan = $(this).attr('data-jurusan');
            var data_judul = $(this).attr('data-judul');
            var data_old_file = $(this).attr('data-old-file');
            var data_deskripsi = $(this).attr('data-deskripsi');
            var data_url = $(this).attr('data-url');
            $("select.jurusan").val(data_jurusan);
            $(".deskripsi").val(data_deskripsi);
            $('.judul').attr('value', data_judul);
            $('.old-file').attr('value', data_old_file);
            $('.id').attr('value', data_id);
            $('.formkirim').attr('action', data_url);
        });
    </script>
@endsection
