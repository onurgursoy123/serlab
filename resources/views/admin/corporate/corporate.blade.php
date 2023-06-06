@extends('admin.layouts.master')


@section('content')

<body>

<div class="row mt-3">
  <div class="row d-flex justify-content-center">
    <div class="col-8 mt-2 text-end">
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
      <!-- Edit product button -->
      <i data-bs-toggle="modal" data-bs-target="#corporateEdit" class="bi bi-pencil-square fa-2x text-dark "></i>
  
      <!-- Edit product modal -->
      <div class="modal fade" id="corporateEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
  
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Fotoğraf ekleyebilirsiniz</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
  
            <form id="productEditForm" action="{{ route('admin.corporate.update') }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('put')
              <!-- Modal body -->
              <div class="modal-body">
                
                <input type="hidden" name="status" value="1">
  
                <div class="row mb-3">
                  <div class="col">
                    <input type="file" id="files" name="files" accept="image/*" multiple class="form-control my-4 files" placeholder="Ekleme istediğini fotoğrafları seçin"/>
                  </div>
                </div>
  
              </div>
  
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                <button type="submit" class="btn btn-primary">Güncelle</button>
              </div>
            </form>
  
          </div>
        </div>
      </div>
    </div>



  </div>
  <div class="row d-flex justify-content-center mt-3">
    <div class="col-8 text-end">
      <form id="corporateDescriptionSuccess" class="d-inline" action="{{ route('admin.corporate.update') }}" method="POST">
        @csrf
        @method('put')
        <input type="hidden" name="status" value="2">
        
        <!--
        <textarea id="editor" class="form-control" name="contents">
        </textarea>
        -->

        <div id="toolbar-container"></div>
        <div id="editor" class="editorAddProduct">
          @php
            print_r($corporate->contents)
          @endphp
        </div>
        <input id="description" name="contents" type="hidden">


        <a href="javascript:;" onclick="$('#description').val($('.editorAddProduct').html()); document.getElementById('corporateDescriptionSuccess').submit();"><i class="bi bi-check-square-fill fa-2x text-success"></i></a>

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