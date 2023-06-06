@extends('layouts.master')




@section('content')

<body>

<div class="row mt-3">
  <div class="row d-flex justify-content-center">
    <div class="col-8 mt-2">
      @php
        $corporate_image = json_decode($corporate->img_json);
        $c_url = [];
        foreach($corporate_image as $c_img) {
          array_push($c_url, $c_img->path."/".$c_img->name);
        }
      @endphp
      @if (!empty($c_url[0])) 
        <img src="{{ $c_url[0] }}"  class="rounded mx-auto d-block p-1" alt="..." style="width: 100%">
      @endif 
    </div>
  </div>
  <div class="row d-flex justify-content-center mt-3">
    <div class="col-8">
      {!! $corporate->contents !!}
    </div>
  </div>
</div>

</body>


@endsection