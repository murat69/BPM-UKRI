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
                        <a href="{{ route('folder.tambah') }}" class="btn btn-primary">
                            Tambah Data {{ $title }}
                        </a>
                    </div>
                    <!-- Modal -->

                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Dokumen</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($folder as $data)
                                <tr>
                                    <td style="width: 5px">{{ $no }}</td>
                                    <td> {{ $data->nama }}</td>
                                    <td style="text-align: center;">
                                        @php
                                            $slug = enc($data->id) . '-' . $data->nama;
                                        @endphp
                                        <a href="{{ route('folder.detail', $slug) }}" class="btn btn-primary"
                                            style="width: 50%;" type="submit">Dokumen
                                            List</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('folder.destroy', $data->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="{{ route('folder.edit', $data->id) }}"
                                                class="btn btn-sm btn-outline-success ">
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
                                <th>Nama</th>
                                <th>Dokumen</th>
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
            var data_url = $(this).attr('data-url');
            console.log(data_id);
            console.log(data_fakultas);
            console.log(data_url);
            $('.fakultas').attr('value', data_fakultas);
            $('.id').attr('value', data_id);
            $('.formkirim').attr('action', data_url);
        });
    </script>
@endsection
