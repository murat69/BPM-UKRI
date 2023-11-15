@extends('layouts.admin')

@section('content')
    <div class="container-fluid ">
        <div class="row justify-content-center">
            <div class="col-md-12" style="margin-top: 20px;">
                @include('layouts/flash')
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $title }} {{ $folder->nama }}</h3>
                    </div>
                    <!-- Button trigger modal -->
                    <!-- Modal -->
                    <div class="row">
                        <!-- /.col -->
                        @foreach ($spmi as $item)
                            @foreach (json_decode($folder->dokumen) as $data)
                                @if ($data == $item->id)
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="info-box shadow">
                                            <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                                            <div class="info-box-content">
                                                <span class="info-box-text">{{ $item->judul }}</span>
                                                <span class="info-box-number">
                                                    <a href="{{ asset('storage/upload/' . $item->nama_file) }}"
                                                        target="_blank">
                                                        Download
                                                    </a>
                                                </span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                        <!-- /.col -->
                        <!-- /.col -->
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
@endsection
