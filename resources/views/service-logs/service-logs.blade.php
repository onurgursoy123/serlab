@extends('layouts.master')
@section('content')



<div class="container-fluid pt-0">
  
  <div class="row justify-content-center">


    <!-- services -->
    @foreach ($blogs as $blog)
      @php
        $blog_image = json_decode($blog->img_json);
        $b_url = [];
        foreach($blog_image as $b_img) {
          array_push($b_url, $b_img->path."/".$b_img->name);
        }
        $blogContentFull = strip_tags($blog->contents);
        $blogContentSub = substr($blogContentFull, 0, 100);
      @endphp
      <!--
      <div class="col-lg-3 mx-3 my-3 item text-center border border-1 p-0 m-0">
      241.35px;
      -->

      <div class="col-xl-2 col-lg-3 col-md-5 col-sm-12 mx-1 my-3 item text-center border border-1 p-0 m-0">

        <div class="d-flex justify-content-center"  style="width: 100%; height: 141.35px;">
          <img src="{{ $b_url[0] }}" class="card-img-top" alt="...">
        </div>
        <div class="card-body p-3">
          <h5 class="card-title fw-bold">{{ $blog->title }}</h5>
          <br>
          <p class="card-text pb-3">{{ print_r($blogContentSub) }} ... <br><a href="{{ route('serviceLogs.details.index', ['id' => $blog->id]) }}">devamını oku...</a></p>
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

    $(".files").on("change", function(e, obj) {
      var files = e.target.files;
      var fileID = e.target.id;
      filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<div class=\"img-thumb-wrapper card shadow\">" +
            "<img class=\"img-thumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove</span>" +
            "</div>").insertAfter("#" + fileID);
          $(".remove").click(function(){
            $(this).parent(".img-thumb-wrapper").remove();
          });
          
        });
        fileReader.readAsDataURL(f);
      }
      console.log(files);
    });

  });
</script>

@endsection
