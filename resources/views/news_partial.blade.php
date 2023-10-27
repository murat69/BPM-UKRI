 @foreach ($berita as $data)
     <div class="col-md-4">
         <div class="card">
             <div
                 style="
                                height: 200px; 
                                width: 416px; 
                                overflow: 
                                hidden; background: url('{{ asset('storage/upload/berita/thumbnail' . '/' . $data->thumbnail) }}'); 
                                background-size: contain;
                                background-position: center;
                                background-repeat: no-repeat;">

             </div>
             <div class="card-body">
                 <h3 class="card-title">{{ $data->judul }}</h3>
                 <p class="card-text">{!! Str::limit($data->isi, 180, '...') !!}</p>
                 @php
                     $slug = enc($data->id) . '-' . $data->slug;
                 @endphp
                 <a href="{{ route('baca.news', ['id' => $slug]) }}" class="btn btn-primary">Baca
                     Selengkapnya</a>
             </div>
         </div>
     </div>
 @endforeach
