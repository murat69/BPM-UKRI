@extends('layouts.admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6 mx-auto">
                        <div style=" padding: 25px; text-align: center;">
                            <img src="{{ asset('img/ukri-logo.png') }}" alt="">
                            <h1>Badan Penjamin Mutu <br>Universitas Kebangsaan Republik Indonesia </h1>
                        </div>
                    </div>
                </div><!-- /.row -->

                <div class="row d-flex justify-content-center">
                    @foreach ($total as $key => $data)
                        <div class="col-md-4 col-sm-6 col-12">
                            <div class="info-box shadow-lg">
                                <span class="bulat d-flex @if ($data['status'] == 'fa-exclamation') circle @endif"
                                    @if ($data['status'] == 'fa-exclamation') style="background-color: #f0b241!important;" @endif><i
                                        class="fa-solid {{ $data['status'] }}"></i></span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Data File {{ $key }}</span>
                                    <span class="info-box-number">
                                        @if ($data['status'] == 'fa-exclamation')
                                            Data yang belum di validasi
                                        @else
                                            Data total
                                        @endif : {{ $data['jumlah'] }}
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                    @endforeach
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->

    </div>
@endsection

@section('script')
@endsection
