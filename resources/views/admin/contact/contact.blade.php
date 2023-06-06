@extends('admin.layouts.master')



@section('content')

<style>
  #btn-back-to-top {
    position: fixed;
    bottom: 300px;
    right: 180px;
    display: none;
  }
</style>

  <div class="container p-5">

      <button type="button" class="btn btn-secondary btn-floating rounded-circle" id="btn-back-to-top">
          <i class="fa-solid fa-angle-up fa-xs"></i>
      </button>

      <div class="row justify-content-center">
          <div class="col-10 col-md-8">
              <img src="/image/ct1.png"  class="rounded mx-auto d-block" alt="..." style="width: 100%">
              <hr class="my-5" style="width: 100%;" >
          </div>
      </div>

      <div class="row justify-content-center">
          <div class="col-10 col-md-8 text-end">

            <form id="guaranteeContentsStore" class="d-inline" action="{{ route('admin.contact.update') }}" method="POST">
              @csrf
              @method('put')
              <div id="toolbar-container"></div>
              <div id="editor" style="height: 500px; border: 1px solid;">
                {!! $data->contents !!}
              </div>
              
              <input id="contents" name="contents" type="hidden">
              <a href="javascript:;" onclick="$('#contents').val($('#editor').html()); document.getElementById('guaranteeContentsStore').submit();"><i class="bi bi-check-square-fill fa-2x text-success"></i></a>
            </form>

            <!--  
              <article>
                  <h6 style="color:#00539f;">IKA® Turkey Laboratuvar ve Proses Teknolojileri A.Ş.</h6>
                  <div class="row">
                      <div class="col-4"><p style="color: rgb(108, 117, 125)">Mescit Mah. Fettah Başaran<br> Cad. No: 21/A<br>
                          Turkey</p>
                      </div>
                      <div class="col-4">
                          <span style="color: rgb(108, 117, 125)">Phone:<span style="color:#00539f;"> +90 216 394 43 43</span></span><br>
                          <span style="color: rgb(108, 117, 125)">eMail:<span style="color:#00539f;"> sales.turkey@ika.com</span></span><br>
                      </div>
                  </div>
              </article>
            -->
              <hr class="my-5" style="width: 100%;" >
          </div>
      </div>

      <!--
      <div class="row justify-content-center">
          <div class="col-10 col-md-8">
              <article>
                  <h6 style="color:#00539f;">Contact</h6>
                  <p style="color: rgb(108, 117, 125)"><strong>Ibrahim Akbas</strong><br>Managing Director IKA Turkey</p>
                  <div class="row">
                      <div class="col-12">
                          <span style="color: rgb(108, 117, 125)">Phone:<span style="color:#00539f;"> +90 216 394 43 43</span></span><br>
                          <span style="color: rgb(108, 117, 125)">Mobile:<span style="color:#00539f;"> +90 552 744 83 53</span></span><br>
                          <span style="color: rgb(108, 117, 125)">eMail:<span style="color:#00539f;"> sales.turkey@ika.com</span></span><br>
                      </div>
                  </div>
              </article>
              <hr class="my-5" style="width: 100%;" >
          </div>
      </div>
      -->


  </div>

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