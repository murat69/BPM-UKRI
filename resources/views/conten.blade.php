@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-5">
        <div class="row justify-content-center">
            <div class="col-md-12" style="margin-top: 20px;">
                @include('layouts/flash')
                <div class="card">
                    <div class="card-header">
                        <h3>Data Akreditasi</h3>
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
                                    <h5 class="modal-title" id="exampleModalLabel">Input Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('conten.store') }}" method="post" enctype="multipart/form-data"
                                    class="formkirim">
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-md-12">
                                                    @csrf

                                                    <div class="form-group">
                                                        <div class="mb-3">
                                                            <label class="form-label">Section</label>
                                                            <input type="text"
                                                                class="form-control section @error('section') is-invalid @enderror"
                                                                name="section">
                                                            @error('section')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <div class="mb-3">
                                                            <label class="form-label">Conten</label>
                                                            <input type="text"
                                                                class="form-control conten @error('conten') is-invalid @enderror"
                                                                name="conten">
                                                            @error('conten')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <input type="hidden" class="id" name="id">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button class="btn btn-primary formkirim" type="submit">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>


                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>no</th>
                                <th>Section</th>
                                <th>Conten</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($conten as $data)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td> {{ $data->section }}</td>
                                    <td> {{ $data->conten }}</td>
                                    <td>
                                        <form action="{{ route('conten.destroy', $data->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="" class="btn btn-sm btn-outline-success buttonedit"
                                                data-toggle="modal" data-target="#myModal"
                                                data-section="{{ $data->section }}" data-conten="{{ $data->conten }}"
                                                data-id="{{ $data->id }}"
                                                data-url="{{ route('conten.update', $data->id) }}">
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
                                <th>no</th>
                                <th>Section</th>
                                <th>Conten</th>
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
            $('#example').DataTable();
        });

        $('#myModal').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        })

        $(document).on('click', '.buttonedit', function() {
            var data_section = $(this).attr('data-section');
            var data_conten = $(this).attr('data-conten');
            var data_id = $(this).attr('data-id');
            var data_url = $(this).attr('data-url');
            $('.section').attr('value', data_section);
            $('.conten').attr('value', data_conten);
            $('.id').attr('value', data_id);
            $('.formkirim').attr('action', data_url);
        });
    </script>
@endsection
