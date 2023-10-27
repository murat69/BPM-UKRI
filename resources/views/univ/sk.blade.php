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
                        <button type="button" class="btn btn-primary buttonedit" data-toggle="modal" data-target="#myModal"
                            data-url="{{ route('universitas.store') }}">
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
                                <form action="{{ route('universitas.store') }}" method="post" class="formkirim"
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
                                                                class="form-control nama @error('nama') is-invalid @enderror"
                                                                name="nama">
                                                            @error('nama')
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
                                                    {{-- <input type="hidden" name="user_id" class="user"
                                                        value="{{ Auth::user()->id }}">
                                                    <input type="hidden" name="id" class="id"> --}}
                                                    <input type="hidden" name="kategori" value="sk" id="">
                                                    <input type="hidden" name="old_file" class="old-file">

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
                                <th>Nama File</th>
                                <th>File</th>
                                <th>Deskripsi</th>
                                <th>Pengirim</th>
                                <th>status</th>
                                <th>Pesan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($univ as $data)
                                <tr>
                                    <td style="width: 5px">{{ $no }}</td>
                                    <td> {{ $data->nama }}</td>
                                    <td><a href="{{ asset('storage/upload/' . $data->file) }}" target="_blank">Download</a>
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
                                                            @if ($data->status == 'Data Sedang Di Cek') selected @endif>Data Sedang Di
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
                                        <form action="{{ route('universitas.destroy', $data->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="" class="btn btn-sm btn-outline-success buttonedit"
                                                data-toggle="modal" data-target="#myModal"
                                                data-nama="{{ $data->nama }}" data-old-file="{{ $data->file }}"
                                                data-deskripsi="{{ $data->deskripsi }}"
                                                data-url="{{ route('universitas.update', $data->id) }}">
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
                                <th>Nama File</th>
                                <th>File</th>
                                <th>Deskripsi</th>
                                <th>Pengirim</th>
                                <th>status</th>
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

            $('.status').on('change', function() {
                var selectedStatus = $(this).val();
                var data_id = $(this).attr('data_id');
                var $pesanInput = $(this).closest('tr').find('.pesan');

                if (selectedStatus === 'Data Tidak Memenuhi') {
                    $pesanInput.show();
                } else {
                    $pesanInput.hide();
                }
                var csrfToken = '{{ csrf_token() }}';

                // Mengirim data ke controller menggunakan Ajax
                $.ajax({
                    type: 'POST',
                    url: '{{ route('univ.status') }}',
                    data: {
                        status: selectedStatus,
                        _token: csrfToken,
                        id: data_id,
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Terjadi kesalahan saat mengirim data: ' + error);
                    }
                });
            });

            $('.pesan').on('blur', function() {
                var inputValue = $(this).val();
                var csrfToken = '{{ csrf_token() }}';
                var data_id = $(this).attr('data_id');
                $.ajax({
                    type: 'POST',
                    url: '{{ route('univ.pesan') }}',
                    data: {
                        pesan: inputValue,
                        _token: csrfToken,
                        id: data_id,
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Terjadi kesalahan saat mengirim data: ' + error);
                    }
                });
            });
            // Optional: Handle initial status on page load
            $('.status').trigger('change');
        });
        $(document).on('click', '.buttonedit', function() {
            var data_nama = $(this).attr('data-nama');
            var data_deskripsi = $(this).attr('data-deskripsi');
            var data_old_file = $(this).attr('data-old-file');
            var data_url = $(this).attr('data-url');
            $(".nama").attr('value', data_nama);
            $(".deskripsi").val(data_deskripsi);
            $('.old-file').attr('value', data_old_file);
            $('.formkirim').attr('action', data_url);
        });
    </script>
@endsection
