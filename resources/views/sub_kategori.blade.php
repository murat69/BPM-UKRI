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
                                <form action="{{ route('sub_kategori.store') }}" method="post" class="formkirim">
                                    <div class="modal-body">

                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-md-12">

                                                    @csrf
                                                    <div class="mb-3">
                                                        <label class="form-label">Sub Kategori</label>
                                                        <input type="text"
                                                            class="form-control sub_kategori @error('sub_kategori') is-invalid @enderror"
                                                            name="sub_kategori">
                                                        @error('sub_kategori')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Kategori</label>
                                                        <select
                                                            class="form-select kategori @error('kategori') is-invalid @enderror"
                                                            name="kategori">
                                                            <option selected>Pilih Salah Satu</option>
                                                            @foreach ($kategori as $datas)
                                                                <option value="{{ $datas->id }}">{{ $datas->kategori }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <input type="hidden" name="id" class="id">
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
                                <th>Kategori</th>
                                <th>Sub Kategori</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($sub_kategori as $data)
                                <tr>
                                    <td style="width: 5px">{{ $no }}</td>
                                    <td> {{ $data->kategori->kategori }}</td>
                                    <td>{{ $data->sub_kategori }}</td>
                                    <td>

                                        <form action="{{ route('sub_kategori.destroy', $data->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="" class="btn btn-sm btn-outline-success buttonedit"
                                                data-toggle="modal" data-target="#myModal"
                                                data-subkategori="{{ $data->sub_kategori }}"
                                                data-kategori="{{ $data->kategori_id }}" data-id="{{ $data->id }}"
                                                data-url="{{ route('sub_kategori.update', $data->id) }}">
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
                                <th>Kategori</th>
                                <th>Sub Kategori</th>
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
            var data_subkategori = $(this).attr('data-subkategori');
            var data_kategori = $(this).attr('data-kategori');
            var data_url = $(this).attr('data-url');
            console.log(data_id);
            console.log(data_subkategori);
            console.log(data_kategori);
            console.log(data_url);
            $("select.kategori").val(data_kategori);
            $('.sub_kategori').attr('value', data_subkategori);
            $('.id').attr('value', data_id);
            $('.formkirim').attr('action', data_url);
        });
    </script>
@endsection