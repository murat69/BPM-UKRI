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
                            data-id="" data-name="" data-email="" data-role="" data-jurusan=""
                            data-url="{{ route('user.store') }}">
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
                                <form action="{{ route('user.store') }}" method="post" class="formkirim"
                                    enctype="multipart/form-data">
                                    <div class="modal-body">

                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-md-12">

                                                    @csrf

                                                    <div class="row mb-3">
                                                        <label for="name"
                                                            class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="name" type="text"
                                                                class="form-control name @error('name') is-invalid @enderror"
                                                                name="name" value="{{ old('name') }}" required
                                                                autocomplete="name" autofocus>

                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="email"
                                                            class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="email" type="email"
                                                                class="form-control email @error('email') is-invalid @enderror"
                                                                name="email" value="{{ old('email') }}" required
                                                                autocomplete="email">

                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="password"
                                                            class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="password" type="password"
                                                                class="form-control password @error('password') is-invalid @enderror"
                                                                name="password" autocomplete="new-password">

                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="password-confirm"
                                                            class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="password-confirm" type="password"
                                                                class="form-control password-conf"
                                                                name="password_confirmation" autocomplete="new-password">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label class="col-md-4 col-form-label text-md-end">Fakultas</label>

                                                        <div class="col-md-6">
                                                            <select
                                                                class="form-control fakultas @error('fakultas') is-invalid @enderror"
                                                                name="fakultas">
                                                                <option value="" selected>Pilih Salah Satu</option>
                                                                @foreach ($fakultas as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->fakultas }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('fakultas')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label class="col-md-4 col-form-label text-md-end">Jurusan</label>

                                                        <div class="col-md-6">
                                                            <select
                                                                class="form-control jurusan @error('jurusan') is-invalid @enderror"
                                                                name="jurusan">
                                                                <option value="" selected>Pilih Salah Satu</option>
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

                                                    <div class="row mb-3">
                                                        <label class="col-md-4 col-form-label text-md-end">Role</label>
                                                        <div class="col-md-6">
                                                            <select
                                                                class="form-control role @error('role') is-invalid @enderror"
                                                                name="role">
                                                                <option value="" selected>Pilih Salah Satu</option>
                                                                <option value="admin">Admin/BPM</option>
                                                                <option value="prodi">Prodi/Jurusan</option>
                                                                <option value="fakultas">Fakultas
                                                                </option>
                                                                <option value="wr1">Wakil Rektor 1</option>
                                                                <option value="wr2">Wakil Rektor 2</option>
                                                                <option value="wr3">Wakil Rektor 3</option>
                                                            </select>
                                                            @error('role')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="id" class="id">
                                                    <input type="hidden" name="old-file" class="old-file">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="submit">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Fakultas</th>
                                <th>Jurusan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($user as $data)
                                <tr>
                                    <td style="width: 5px">{{ $no }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td> {{ $data->role }}</td>
                                    <td>{{ $data->fakultas->fakultas ?? 'Null' }}</td>
                                    <td>{{ $data->jurusan->jurusan ?? 'Null' }}</td>
                                    <td>
                                        <form action="{{ route('user.destroy', $data->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="" class="btn btn-sm btn-outline-success buttonedit"
                                                data-toggle="modal" data-target="#myModal" data-id="{{ $data->id }}"
                                                data-name="{{ $data->name }}" data-email="{{ $data->email }}"
                                                data-role="{{ $data->role }}" data-jurusan="{{ $data->jurusan_id }}"
                                                data-fakultas="{{ $data->fakultas_id }}"
                                                data-url="{{ route('user.update', $data->id) }}">
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
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Fakultas</th>
                                <th>Jurusan</th>
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
            var data_name = $(this).attr('data-name');
            var data_email = $(this).attr('data-email');
            var data_role = $(this).attr('data-role');
            var data_jurusan = $(this).attr('data-jurusan');
            var data_fakultas = $(this).attr('data-fakultas');
            var data_url = $(this).attr('data-url');
            $("select.jurusan").val(data_jurusan);
            $("select.fakultas").val(data_fakultas);
            $(".name").val(data_name);
            $('.email').attr('value', data_email);
            $('.role').val(data_role);
            $('.jurusan').attr('value', data_jurusan);
            $('.id').attr('value', data_id);
            $('.formkirim').attr('action', data_url);
        });
    </script>
@endsection
