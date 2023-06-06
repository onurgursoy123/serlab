@extends('layouts.master')




@section('content')

<body>

  <div class="row d-flex justify-content-center mb-3">
    <div class="col-12">
      @foreach ($data as $item)
        @if ($item->title == 'logo')
          @php
            $img = json_decode($item->description);
            foreach($img as $i) {
              $url = $i->path."/".$i->name;
            }
          @endphp
          <img src="{{$url}}" class="rounded mx-auto d-block" alt="..." style="width: 6%">
          @break
        @endif
      @endforeach
      <h4 class="text-center mt-3">Teknik Servis Bakım Ve Onarım</h4>
    </div>
  </div>

  <div class="row justify-content-center mb-5">

    <div class="col-4 g-0">
      @foreach ($data as $item)
        @if ($item->title == 'products')
          @php
            $img = json_decode($item->description);
            $url = [];
            $link = [];
            foreach($img as $i) {
              array_push($url, $i->path."/".$i->name);
              array_push($link, $i->url);
            }
          @endphp
          <div class="row d-flex justify-content-center me-2">
            <div class="col-6 g-0  position-relative">
              <a href="{{ $link[0] }}">
                <span class="badge position-absolute top-50 start-50 translate-middle rounded-pill bg-danger text-center fw-bold fs-6" style="width: 80px; height: 24px;">FIRSAT</span>
                <img src="{{ $url[0] }}"  class="rounded mx-auto d-block p-1" alt="..." style="width: 100%">
              </a>
            </div>
            <div class="col-6 g-0 position-relative">
              <a href="{{ $link[1] }}">
                <span class="badge position-absolute top-50 start-50 translate-middle rounded-pill bg-danger text-center fw-bold fs-6" style="width: 80px; height: 24px;">FIRSAT</span>
                <img src="{{ $url[1] }}" class="rounded mx-auto d-block p-1" alt="..." style="width: 100%">  
              </a>
            </div> 
          </div>
          <div class="row d-flex justify-content-center me-2">
            <div class="col-6 g-0 position-relative">
              <a href="{{ $link[2] }}">
                <span class="badge position-absolute top-50 start-50 translate-middle rounded-pill bg-danger text-center fw-bold fs-6" style="width: 80px; height: 24px;">FIRSAT</span>
                <img src="{{ $url[2] }}" class="rounded mx-auto d-block p-1" alt="..." style="width: 100%">  
              </a>
            </div>
            <div class="col-6 g-0 position-relative">
              <a href="{{ $link[3] }}">
                <span class="badge position-absolute top-50 start-50 translate-middle rounded-pill bg-danger text-center fw-bold fs-6" style="width: 80px; height: 24px;">FIRSAT</span>
              <img src="{{ $url[3] }}" class="rounded mx-auto d-block p-1" alt="..." style="width: 100%"> 
              </a> 
            </div>
          </div>
        @endif
      @endforeach
    </div>

    <div class="col-4 g-1">
      <div id="carouselExampleCaptions" class="carousel slide mb-1" data-bs-ride="carousel">
        @foreach ($data as $item)
          @if ($item->title == 'slider')
            @php
              $img = json_decode($item->description);
              $url = [];
              $link = [];
              foreach($img as $i) {
                array_push($url, $i->path."/".$i->name);
                array_push($link, $i->url);
              }
            @endphp
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <a href="{{ $link[0] }}">
                  <img src="{{ $url[0] }}" class="d-block w-100" alt="...">
                </a>
              </div>
              <div class="carousel-item">
                <a href="{{ $link[1] }}">
                  <img src="{{ $url[1] }}" class="d-block w-100" alt="...">
                </a>
              </div>
              <div class="carousel-item">
                <a href="{{ $link[2] }}">
                <img src="{{ $url[2] }}" class="d-block w-100" alt="...">
                </a>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          @endif
        @endforeach
      </div>
    </div>

  </div>

  <div class="row d-flex justify-content-center">
    <div class="col-12 text-center" style="color: rgb(108, 117, 125)">
      @foreach ($data as $item)
        @if ($item->title == 'description')
          <div id="editor" class="ck-content ck-editor__editable ck-rounded-corners ck-editor__editable_inline ck-blurred" lang="en" dir="ltr" role="textbox" aria-label="Rich Text Editor. Editing area: main" >

            {!! $item->description !!}

          </div>
          @break

        @endif
      @endforeach
    </div>
  </div>

</body>


@endsection