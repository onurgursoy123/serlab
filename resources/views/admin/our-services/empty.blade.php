@extends('admin.layouts.master')

@section('content')

<body>

    <div class="row mt-3">
      <div class="row d-flex justify-content-center mt-3">
        <div class="col-8 text-end">
            
            <form id="guaranteeContentsUpdate" class="d-inline" action="{{ route('admin.our-services.getDynamicUrl.update') }}" method="POST">
                @csrf
                @method('put')
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Sayfanın Adı</span>
                    <input type="text" name="title" value="{{ $data->title }}" class="form-control" maxlength="35" id="basic-url" aria-describedby="basic-addon3" required>
                </div>
                  
                <div id="toolbar-container"></div>
                <div id="editor" style="height: 500px; border: 1px solid;">
                  {!! $data->contents !!}
                </div>
                <input name="id" type="hidden" value="{{ $data->id }}">
                <input id="contents" name="contents" type="hidden">
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
