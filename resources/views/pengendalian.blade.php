@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Launch demo modal
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">

                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('pengendalian.store') }}" method="post"
                                    enctype="multipart/form-data" class="formkirim">
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-md-12">
                                                    @csrf
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

                                                    <div class="mb-3">
                                                        <label class="form-label">File RTM</label>
                                                        <input type="file"
                                                            class="form-control file_rtm @error('file_rtm') is-invalid @enderror"
                                                            name="file_rtm">
                                                        @error('file_rtm')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>


                                                    <div class="mb-3">
                                                        <label class="form-label">File Pelaksanaan RTM</label>
                                                        <input type="file"
                                                            class="form-control file_pel_rtm @error('file_pel_rtm') is-invalid @enderror"
                                                            name="file_pel_rtm">
                                                        @error('file_pel_rtm')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>


                                                    <div class="mb-3">
                                                        <label class="form-label">File RTL</label>
                                                        <input type="file"
                                                            class="form-control file_rtl @error('file_rtl') is-invalid @enderror"
                                                            name="file_rtl">
                                                        @error('file_rtl')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">File Pelaksanaan RTL</label>
                                                        <input type="file"
                                                            class="form-control file_pel_rtl @error('file_pel_rtl') is-invalid @enderror"
                                                            name="file_pel_rtl">
                                                        @error('file_pel_rtl')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <input type="hidden" class="data_old_file_rtm"
                                                        name="data_old_file_rtm">

                                                    <input type="hidden" class="data_old_file_pel_rtm"
                                                        name="data_old_file_pel_rtm">

                                                    <input type="hidden" class="data_old_file_rtl"
                                                        name="data_old_file_rtl">

                                                    <input type="hidden" class="data_old_file_pel_rtl"
                                                        name="data_old_file_pel_rtl">

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
                </div>

                <table id="example" class="display">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Judul</th>
                            <th>File RTM</th>
                            <th>File Pelaksanaan RTM</th>
                            <th>File RTL</th>
                            <th>File Pelaksanaan RTL</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($pengendalian as $data)
                            <tr>
                                <td> {{ $no }}</td>
                                <td>{{ $data->judul }}
                                </td>
                                <td> <a
                                        href="{{ asset('storage/upload/' . str_replace(' ', '_', 'BPM') . '/' . $data->file_rtm) }}">Download</a>
                                </td>
                                <td><a
                                        href="{{ asset('storage/upload/' . str_replace(' ', '_', 'BPM') . '/' . $data->file_pel_rtm) }}">Download</a>
                                </td>
                                <td><a
                                        href="{{ asset('storage/upload/' . str_replace(' ', '_', 'BPM') . '/' . $data->file_rtl) }}">Download</a>
                                </td>
                                <td> <a
                                        href="{{ asset('storage/upload/' . str_replace(' ', '_', 'BPM') . '/' . $data->file_pel_rtl) }}">Download</a>
                                </td>
                                {{-- <td><img src="{{ asset('storage/upload/' . str_replace(' ', '_', 'BPM') . '/' . $data->nama_file) }}"
                                        alt="" style="width: 100px">
                                </td> --}}
                                <td>
                                    <form action="{{ route('pengendalian.destroy', $data->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a href="" class="btn btn-sm btn-outline-success buttonedit"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal"
                                            data-rtm="{{ $data->file_rtm }}" data-pel-rtm="{{ $data->file_pel_rtm }}"
                                            data-id="{{ $data->id }}" data-rtl="{{ $data->file_rtl }}"
                                            data-pel-rtl="{{ $data->file_pel_rtl }}" data-judul="{{ $data->judul }}"
                                            data-url="{{ route('pengendalian.update', $data->id) }}">
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
                            <th>File RTM</th>
                            <th>File Pelaksanaan RTM</th>
                            <th>File RTL</th>
                            <th>File Pelaksanaan RTL</th>
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
            var data_judul = $(this).attr('data-judul');
            var data_rtm = $(this).attr('data-rtm');
            var data_pel_rtm = $(this).attr('data-pel-rtm');
            var data_rtl = $(this).attr('data-rtl');
            var data_pel_rtl = $(this).attr('data-pel-rtl');
            var data_id = $(this).attr('data-id');
            var data_url = $(this).attr('data-url');
            $('.data_old_file_rtm').attr('value', data_rtm);
            $('.data_old_file_pel_rtm').attr('value', data_pel_rtm);
            $('.data_old_file_rtl').attr('value', data_rtl);
            $('.data_old_file_pel_rtl').attr('value', data_pel_rtl);
            $('.judul').attr('value', data_judul);
            $('.id').attr('value', data_id);
            $('.formkirim').attr('action', data_url);
        });
    </script>
@endsection
