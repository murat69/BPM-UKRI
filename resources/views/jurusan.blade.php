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
                            Tambah Data {{ $title }}
                        </button>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('jurusan.store') }}" method="post" class="formkirim"
                                    enctype="multipart/form-data">
                                    <div class="modal-body">

                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-md-12">

                                                    @csrf
                                                    <div class="mb-3">
                                                        <label class="form-label">Jurusan</label>
                                                        <input type="text"
                                                            class="form-control jurusan @error('jurusan') is-invalid @enderror"
                                                            name="jurusan">
                                                        @error('jurusan')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Logo Jurusan</label>
                                                        <input type="file"
                                                            class="form-control nama_file @error('nama_file') is-invalid @enderror"
                                                            name="nama_file">
                                                        @error('nama_file')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Fakultas</label>
                                                        <select
                                                            class="form-select fakultas @error('fakultas') is-invalid @enderror"
                                                            name="fakultas">
                                                            <option selected>Pilih Salah Satu</option>
                                                            @foreach ($fakultas as $datas)
                                                                <option value="{{ $datas->id }}">{{ $datas->fakultas }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <input type="hidden" name="id" class="id">
                                                    <input type="hidden" name="data-old-file" class="data-old-file">
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
                                <th>Fakultas</th>
                                <th>jurusan</th>
                                <th>logo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($jurusan as $data)
                                <tr>
                                    <td style="width: 5px">{{ $no }}</td>
                                    <td>{{ $data->fakultas->fakultas }}</td>
                                    <td>{{ $data->jurusan }}</td>
                                    <td>
                                        <img src="{{ asset('storage/upload/' . str_replace(' ', '_', $data->jurusan) . '/' . $data->logo) }}"
                                            alt="" style="width: 100px">
                                    </td>
                                    <td>

                                        <form action="{{ route('jurusan.destroy', $data->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="" class="btn btn-sm btn-outline-success buttonedit"
                                                data-toggle="modal" data-target="#myModal"
                                                data-jurusan="{{ $data->jurusan }}" data-old-file="{{ $data->logo }}"
                                                data-fakultas="{{ $data->fakultas_id }}" data-id="{{ $data->id }}"
                                                data-url="{{ route('jurusan.update', $data->id) }}">
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
                                <th>Fakultas</th>
                                <th>jurusan</th>
                                <th>logo</th>
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
        $(document).on('click', '.buttonedit', function() {
            var data_id = $(this).attr('data-id');
            var data_fakultas = $(this).attr('data-fakultas');
            var data_jurusan = $(this).attr('data-jurusan');
            var data_url = $(this).attr('data-url');
            var data_old_file = $(this).attr('data-old-file');
            $("select.fakultas").val(data_fakultas);
            $('.jurusan').attr('value', data_jurusan);
            $('.id').attr('value', data_id);
            $('.data-old-file').attr('value', data_old_file);
            $('.formkirim').attr('action', data_url);
        });
    </script>
@endsection
