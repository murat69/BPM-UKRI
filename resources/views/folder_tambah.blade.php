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
                    <!-- Modal -->
                    @if (isset($folder))
                        <form action="{{ route('folder.update', $folder->id) }}" method="post">
                        @else
                            <form action="{{ route('folder.store') }}" method="post">
                    @endif
                    <div class="container-fluid">
                        <div class="row justify-content-start">
                            <div class="col-md-12">

                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Nama Folder</label>
                                    <input type="text" value="{{ @$folder->nama }}"
                                        class="form-control nama @error('nama') is-invalid @enderror" name="nama">
                                    @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Pilih file yang akan di masukan ke dalam folder</label>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="form-label">search</label>
                                    <input id="searchInput" type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <table id="myTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>Judul</th>
                                <th>File</th>
                                <th>Kategori</th>
                                <th>Sub Kategori</th>
                                <th>Akses</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                if (isset($folder)) {
                                    $dokumen = json_decode($folder->dokumen);
                                }
                            @endphp

                            @foreach ($spmi as $key => $data)
                                <tr>
                                    <td style="width: 5px; text-align: center;">
                                        <div class="custom-control custom-checkbox">
                                            @if (isset($folder))
                                                <input class="custom-control-input" type="checkbox" name="dokumen[]"
                                                    id="customCheckbox{{ $data->id }}" value="{{ $data->id }}"
                                                    {{ in_array($data->id, $dokumen) ? 'checked' : '' }} />
                                            @else
                                                <input class="custom-control-input" type="checkbox" name="dokumen[]"
                                                    id="customCheckbox{{ $data->id }}" value="{{ $data->id }}" />
                                            @endif
                                            <label for="customCheckbox{{ $data->id }}"
                                                class="custom-control-label"></label>
                                        </div>
                                    </td>

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
                                    <td>{{ $data->akses }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Select</th>
                                <th>Judul</th>
                                <th>File</th>
                                <th>Kategori</th>
                                <th>Sub Kategori</th>
                                <th>Akses</th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="container-fluid" style="margin-bottom: 10px; margin-top: 10px;">
                        <div class="row justify-content-start">
                            <div class="col-md-12">
                                <button class="btn btn-primary" style="width: 100%;" type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("#searchInput").on("input", function() {
                var searchText = $(this).val().toLowerCase();

                $("#myTable tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
                });
            });
        });
    </script>
@endsection
