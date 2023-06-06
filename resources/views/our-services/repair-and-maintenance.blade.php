@extends('layouts.master')
@section('content')


<body>

<div class="row mt-3">
  <div class="row d-flex justify-content-center">
    <div class="col-8 mt-2">,
      @php
        $image = json_decode($data->description);
        $url = [];
        if (!empty($image)) {
          foreach($image as $img) {
            array_push($url, $img->path."/".$img->name);
          }
        }
      @endphp
      @if (!empty($url[0])) 
        <img src="{{ $url[0] }}"  class="rounded mx-auto d-block p-1" alt="..." style="width: 100%">
      @endif 
    </div>
  </div>
  <div class="row d-flex justify-content-center mt-3">
    <div class="col-8">
      
      <div id="editor" class="ck-content ck-editor__editable ck-rounded-corners ck-editor__editable_inline ck-blurred" lang="en" dir="ltr" role="textbox" aria-label="Rich Text Editor. Editing area: main" >
        {!! $data->contents !!}
      </div>
    </div>
  </div>
</div>

</body>


@endsection