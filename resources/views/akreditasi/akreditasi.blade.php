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
                        @if (Auth::user()->role == 'prodi')
                            @if (count($akreditasi) < 1)
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Tambah Data
                                </button>
                            @endif
                        @elseif (Auth::user()->role == 'fakultas')
                            @if (count($akreditasi) < count($jurusan))
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Tambah Data
                                </button>
                            @endif
                        @elseif (Auth::user()->role == 'admin')
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Data
                            </button>
                        @endif
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
                                <form action="{{ route('akreditasi.store') }}" method="post" enctype="multipart/form-data"
                                    class="formkirim">
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-md-12">
                                                    @csrf
                                                    @if (Auth::user()->role == 'admin' || Auth::user()->role == 'fakultas')
                                                        <div class="form-group">
                                                            <div class="mb-3">
                                                                <label class="form-label">Jurusan</label>
                                                                <select
                                                                    class="form-control jurusan @error('jurusan') is-invalid @enderror"
                                                                    name="jurusan">
                                                                    <option selected>Pilih Salah Satu</option>
                                                                    @foreach ($jurusan as $item)
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
                                                    @elseif(Auth::user()->role == 'prodi')
                                                        <input type="hidden" name="jurusan"
                                                            value="{{ Auth::user()->jurusan_id }}">
                                                    @endif

                                                    <div class="form-group">
                                                        <div class="mb-3">
                                                            <label class="form-label">Srata</label>
                                                            <select
                                                                class="form-control srata @error('srata') is-invalid @enderror"
                                                                name="srata">
                                                                <option selected>Pilih Salah Satu</option>
                                                                <option value="S1">S1</option>
                                                            </select>
                                                            @error('srata')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="mb-3">
                                                            <label class="form-label">Akreditasi</label>
                                                            <select
                                                                class="form-control akreditasi @error('akreditasi') is-invalid @enderror"
                                                                name="akreditasi">
                                                                <option selected>Pilih Salah Satu</option>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                            </select>
                                                            @error('akreditasi')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="mb-3">
                                                            <label class="form-label">No SK</label>
                                                            <input type="text"
                                                                class="form-control sk @error('sk') is-invalid @enderror"
                                                                name="sk">
                                                            @error('sk')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="mb-3">
                                                            <label class="form-label">Gambar Akreditasi</label>
                                                            <div class="custom-file">
                                                                <input type="file"
                                                                    class="custom-file-input nama_file @error('nama_file') is-invalid @enderror"
                                                                    name="nama_file" id="customFile">
                                                                <label class="custom-file-label" for="customFile">
                                                                    Pilih Gambar
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
                                                            <label class="form-label">Tanggal SK</label>
                                                            <input type="date"
                                                                class="form-control tanggal_m  @error('tanggal_m') is-invalid @enderror"
                                                                name="tanggal_m">
                                                            @error('tanggal_m')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="mb-3">
                                                            <label class="form-label">Tanggal Habis SK</label>
                                                            <input type="date"
                                                                class="form-control tanggal_h  @error('tanggal_h') is-invalid @enderror"
                                                                name="tanggal_h">
                                                            @error('tanggal_h')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <input type="hidden" class="data_old_file" name="data_old_file">
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
                                <th>Fakultas</th>
                                <th>Prodi</th>
                                <th>Strata</th>
                                <th>Akreditasi</th>
                                <th>SK BAN-PT</th>
                                <th>file</th>
                                <th>Tanggal SK</th>
                                <th>Masa Habis</th>
                                <th>Status SK</th>
                                <th>Masa Berlaku</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($akreditasi as $data)
                                @php
                                    $now = new DateTime();
                                    $depan = new DateTime($data->tanggal_h);
                                    $interval = $depan->diff($now);
                                    // $interval = $data->tanggal_h->diff($tanggal);
                                    $days = $interval->days;
                                @endphp
                                <tr @if ($days < 365) style="background: #ff8787" @endif>

                                    <td>{{ $data->jurusan->fakultas->fakultas }}</td>
                                    <td> {{ $data->jurusan->jurusan }}</td>
                                    <td> {{ $data->srata }}</td>
                                    <td> {{ $data->akreditasi }}</td>
                                    <td> {{ $data->sk }}</td>
                                    <td><a href="{{ asset('storage/upload/' . str_replace(' ', '_', $data->jurusan->jurusan) . '/' . $data->nama_file) }}"
                                            target="blank_"><img src="{{ asset('storage/upload' . $data->nama_file) }}"
                                                alt="" style="width: 100px"></a>
                                    </td>
                                    <td> {{ $data->tanggal_m }}</td>
                                    <td> {{ $data->tanggal_h }}</td>
                                    <td>
                                        @if ($days > 0)
                                            Aktif
                                        @else
                                            Tidak Aktif
                                        @endif
                                    </td>
                                    <td>{{ $days }} Hari</td>
                                    <td>
                                        <form action="{{ route('akreditasi.destroy', $data->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="" class="btn btn-sm btn-outline-success buttonedit"
                                                data-toggle="modal" data-target="#myModal"
                                                data-jurusan="{{ $data->jurusan_id }}" data-srata="{{ $data->srata }}"
                                                data-id="{{ $data->id }}" data-akreditasi="{{ $data->akreditasi }}"
                                                data-sk="{{ $data->sk }}" data-tanggal_m="{{ $data->tanggal_m }}"
                                                data-tanggal_h="{{ $data->tanggal_h }}"
                                                data-old-file="{{ $data->nama_file }}"
                                                data-url="{{ route('akreditasi.update', $data->id) }}">
                                                Edit
                                            </a> |
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Apakah Anda Yakin?')">Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Fakultas</th>
                                <th>Prodi</th>
                                <th>Strata</th>
                                <th>Akreditasi</th>
                                <th>SK BAN-PT</th>
                                <th>file</th>
                                <th>Tanggal SK</th>
                                <th>Masa Habis</th>
                                <th>Status SK</th>
                                <th>Masa Berlaku</th>
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
            var data_jurusan = $(this).attr('data-jurusan');
            var data_srata = $(this).attr('data-srata');
            var data_id = $(this).attr('data-id');
            var data_akreditasi = $(this).attr('data-akreditasi');
            var data_sk = $(this).attr('data-sk');
            var data_tanggal_m = $(this).attr('data-tanggal_m');
            var data_old_file = $(this).attr('data-old-file');
            var data_tanggal_h = $(this).attr('data-tanggal_h');
            var data_url = $(this).attr('data-url');
            $("select.jurusan").val(data_jurusan);
            $("select.srata").val(data_srata);
            $("select.akreditasi").val(data_akreditasi);
            $('.tanggal_m').attr('value', data_tanggal_m);
            $('.data_old_file').attr('value', data_old_file);
            $('.sk').attr('value', data_sk);
            $('.tanggal_h').attr('value', data_tanggal_h);
            $('.id').attr('value', data_id);
            $('.formkirim').attr('action', data_url);
        });
    </script>
@endsection
