@extends('layouts.master')
@section('content')



<div class="container-fluid pt-0">
  
  <div class="row justify-content-center">


    <!-- services -->
    @foreach ($weLearn as $weLearn)
      @php
        $weLearn_image = json_decode($weLearn->img_json);
        $w_url = [];
        foreach($weLearn_image as $w_img) {
          array_push($w_url, $w_img->path."/".$w_img->name);
        }
        $weLearnContentFull = strip_tags($weLearn->contents);
        $weLearnContentSub = substr($weLearnContentFull, 0, 100);
      @endphp
      <!--
      <div class="col-lg-3 mx-3 my-3 item text-center border border-1 p-0 m-0">
      -->
      <div class="col-xl-2 col-lg-3 col-md-5 col-sm-12 mx-1 my-3 item text-center border border-1 p-0 m-0">
        <div class="d-flex justify-content-center"  style="width: 100%; height: 141.35px;">
          <img src="{{ $w_url[0] }}" class="card-img-top" alt="...">
        </div>
        <div class="card-body p-3">
          <h5 class="card-title fw-bold">{{ $weLearn->title }}</h5>
          <br>
          <p class="card-text pb-3">{{ print_r($weLearnContentSub) }} ... <br><a href="{{ route('we-learn.details.index', ['id' => $weLearn->id]) }}">devamını oku...</a></p>
        </div>

      </div>


    @endforeach

  </div>

</div>



<script>

  $(document).ready(function() {

    $('.editorServices').each(function(i, obj) {
      ClassicEditor
          .create( obj )
          .then( editor => {
                // console.log( editor );
          } )
          .catch( error => {
                // console.error( error );
          } );
    });

  });
</script>

@endsection
