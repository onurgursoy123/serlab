@extends('admin.layouts.master')




@section('content')

<body>

  <div class="row mt-3">
  
    <div class="row d-flex justify-content-center">
      <div class="col-8 mt-2">
  
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
  
        <form id="guaranteeImageUpdate" class="text-center" action="{{ route('admin.our-services.repairAndMaintenance.update') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('put')
          <input type="hidden" name="status" value="1">
          <label for="fileGuaranteeImage">
            <i class="bi bi-pencil-square fa-2x text-dark"></i>
          </label>
          <input id="fileGuaranteeImage" type="file" name="files" class="d-none"/>
          <a href="javascript:;" onclick="document.getElementById('guaranteeImageUpdate').submit();"><i class="bi bi-check-square-fill fa-2x text-success"></i></a>
        </form>
      </div>
    </div>
  
    <div class="row d-flex justify-content-center mt-3">
      <div class="col-8 text-end">
  
        <form id="guaranteeContentsUpdate" class="d-inline" action="{{ route('admin.our-services.repairAndMaintenance.update') }}" method="POST">
          @csrf
          @method('put')
          <div id="toolbar-container"></div>
          <div id="editor">
            @php
              print_r($data->contents)
            @endphp
          </div>

          <input id="contents" name="contents" type="hidden">
          <input type="hidden" name="status" value="2">
          <a href="javascript:;" onclick="$('#contents').val($('#editor').html()); document.getElementById('guaranteeContentsUpdate').submit();"><i class="bi bi-check-square-fill fa-2x text-success"></i></a>
        </form>
  
      </div>
  
  
    </div>
  </div>
  
  </body>
  
  
  <script>
    DecoupledEditor
            .create( document.querySelector( '#editor' ), {
              ckfinder: {
                uploadUrl: "{{ route('admin.api.dashboard.ckeditor-upload').'?token='.Session::get('user')['token'] }}"
              }
            } )
            .then( editor => {
                const toolbarContainer = document.querySelector( '#toolbar-container' );

                toolbarContainer.appendChild( editor.ui.view.toolbar.element );
            } )
            .catch( error => {
                console.error( error );
            } );
  </script>
  
  @endsection