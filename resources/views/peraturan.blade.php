@extends('layouts.setengah')

@section('content')
    <section id="visi&misi" class="about" style="background: rgb(253, 253, 253); color: rgb(0, 0, 0);">
        <div class="container">

            <div class="section-title">
                <h2 class="fade-bottom" style="font-size: 40px;">PRODUK HUKUM TERKAIT PENDIDIKAN TINGGI</h2>
            </div>

            <div class="row content">
                <div class="col-lg-12 fade-kanan ">
                    <div class="accordion peraturan" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Undang-Undang
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ul class="list-group">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($uu as $data)
                                            <li class="list-group-item"><strong>{{ $i }}. </strong><a
                                                    href="{{ asset('storage/upload/' . str_replace(' ', '_', 'BPM') . '/' . $data->nama_file) }}"
                                                    target="_blank">{{ $data->judul }}
                                            </li></a>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Peraturan Pendidikan Tinggi
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ul class="list-group">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($ppt as $item)
                                            <li class="list-group-item"><strong>{{ $i }}. </strong><a
                                                    href="{{ asset('storage/upload/' . str_replace(' ', '_', 'BPM') . '/' . $item->nama_file) }}"
                                                    target="_blank">{{ $item->judul }}
                                            </li></a>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Statuta UKRI
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ul class="list-group">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($su as $data)
                                            <li class="list-group-item"><strong>{{ $i }}. </strong><a
                                                    href="{{ asset('storage/upload/' . str_replace(' ', '_', 'BPM') . '/' . $data->nama_file) }}"
                                                    target="_blank">{{ $data->judul }}
                                            </li></a>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingfour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                                    Peraturan Turunan Statuta UKRI
                                </button>
                            </h2>
                            <div id="collapsefour" class="accordion-collapse collapse" aria-labelledby="headingfour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <ul class="list-group">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($ptsu as $data)
                                            <li class="list-group-item"><strong>{{ $i }}. </strong><a
                                                    href="{{ asset('storage/upload/' . str_replace(' ', '_', 'BPM') . '/' . $data->nama_file) }}"
                                                    target="_blank">{{ $data->judul }}
                                            </li></a>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
