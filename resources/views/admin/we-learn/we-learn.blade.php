@extends('admin.layouts.master')
@section('content')

<style>
  .ck-editor__editable[role="textbox"] {
    min-height: 200px;
  }
  .ck-content .image {
    max-width: 80%;
    margin: 20px auto;
  }
  .remove {
    display: block;
    background: #444;
    border: 1px solid none;
    color: white;
    text-align: center;
    cursor: pointer;
  }
  .remove:hover {
    background: white;
    color: black;
  }
  .removeOldImage {
    display: block;
    background: #444;
    border: 1px solid none;
    color: white;
    text-align: center;
    cursor: pointer;
  }
  .removeOldImage:hover {
    background: white;
    color: black;
  }
  .removeOldPdf {
    display: block;
    background: #444;
    border: 1px solid none;
    color: white;
    text-align: center;
    cursor: pointer;
  }
  .removeOldPdf:hover {
    background: white;
    color: black;
  }
</style>

<div class="container-fluid pt-0">
  
  <div class="row justify-content-center">

    <!-- modal ADD -->
    <div id="addInnerWeLearn" style="border: 1px solid grey; display: none;">
      <form id="servicesAddForm" action="{{ route('admin.we-learn.save') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Modal body -->
        <div class="modal-body text-center">
        
          <input type="hidden" name="parent_id" value="0">
          <input type="text" name="title" class="form-control my-2" placeholder="Adı" required>
          <input type="number" name="sort" class="form-control my-2" placeholder="Sıralama için sayı giriniz">

          <div class="row mb-3">
            <div class="col">
              <h5>Eklemek istediğiniz fotoğrafları seçin<h5><h6 class="fw-light text-muted"> - Sadece <strong class="fw-bold">bir </strong>fotoğraf yükleyiniz.</h6><h6 class="fw-light text-muted"> - Bu fotoğraf <strong class="fw-bold">kapak fotoğrafı </strong>olarak kullanılacak.</h6>
              <input type="file" id="fileEnd" name="files" accept="image/*" class="form-control my-4 files" placeholder="Ekleme istediğiniz fotoğrafları seçin"/>
            </div>
          </div>

          <!--
          <textarea id="editor" class="form-control editorWeLearn" name="contents" placeholder="Açıklamasını buraya yazabilirsiniz">
          </textarea>
          -->
          <div id="toolbar-container"></div>
          <div id="editor" class="form-control editorAddProduct"></div>
          <input id="description" name="contents" type="hidden">


        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
        <button type="submit" style="color: white;" onclick="$('#description').val($('.editorAddProduct').html());" class="btn btn-primary p-3 m-2">Ekle</button>
        </div>

      </form>
    </div>

    <!-- services -->
    <div class="col-lg-3 mx-3 my-3 item text-center border border-1 p-0 m-0">
      
      <div class="d-flex flex-column h-100 justify-content-center align-items-center">

        <span class="fw-bold">Yeni Ekle</span>
        <!-- Add services button -->
        <i data-bs-toggle="modal" role="button" onclick="$('#addInnerWeLearn').show();getCkEditor()" class="bi bi-plus-square-fill fa-2x text-dark me-3"><!-- data-bs-target="#servicesAdd" --></i>

        <!-- Add services modal -->
        <div class="modal fade" id="servicesAdd">
          <div class="modal-dialog modal-fullscreen">
              <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                  <h4 class="modal-title">Yeni Ekle</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <form id="servicesAddForm" action="{{ route('admin.we-learn.save') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <!-- Modal body -->
                  <div class="modal-body">
                  
                  <input type="hidden" name="parent_id" value="0">
                  <input type="text" name="title" class="form-control my-2" placeholder="Adı" required>
                  <input type="number" name="sort" class="form-control my-2" placeholder="Sıralama için sayı giriniz">

                  <div class="row mb-3">
                    <div class="col">
                      <h5>Eklemek istediğiniz fotoğrafları seçin<h5><h6 class="fw-light text-muted"> - Sadece <strong class="fw-bold">bir </strong>fotoğraf yükleyiniz.</h6><h6 class="fw-light text-muted"> - Bu fotoğraf <strong class="fw-bold">kapak fotoğrafı </strong>olarak kullanılacak.</h6>
                      <input type="file" id="fileEnd" name="files" accept="image/*" class="form-control my-4 files" placeholder="Ekleme istediğiniz fotoğrafları seçin"/>
                    </div>
                  </div>

                  <!--
                  <textarea id="editor" class="form-control editorWeLearn" name="contents" placeholder="Açıklamasını buraya yazabilirsiniz">
                  </textarea>
                  -->
                  <div id="toolbar-container"></div>
                  <div id="editor" class="form-control editorAddProduct"></div>
                  <input id="description" name="contents" type="hidden">


                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                  <button type="submit" onclick="$('#description').val($('.editorAddProduct').html());" class="btn btn-primary">Ekle</button>
                  </div>

              </form>

              </div>
          </div>
        </div>

      </div>

    </div>


    @foreach ($weLearns as $weLearn)
      @php
        $weLearn_image = json_decode($weLearn->img_json);
        $w_url = [];
        foreach($weLearn_image as $w_img) {
          array_push($w_url, $w_img->path."/".$w_img->name);
        }
        $weLearnContentFull = strip_tags($weLearn->contents);
        $weLearnContentSub = substr($weLearnContentFull, 0, 100);
      @endphp
      
      <div class="col-lg-3 mx-3 my-3 item text-center border border-1 p-0 m-0">

        <div class="d-flex justify-content-center"  style="width: 100%; height: 241.35px;">
          <img src="{{ $w_url[0] }}" class="card-img-top" alt="...">
        </div>
        <div class="card-body p-3">
          <h5 class="card-title fw-bold">{{ $weLearn->title }}</h5>
          <br>
          <p class="card-text pb-3">{{ print_r($weLearnContentSub) }} ... <br><a href="{{ route('admin.we-learn.details.index', ['id' => $weLearn->id]) }}">devamını oku...</a></p>
        </div>

        <!-- Edit product button -->
        <i data-bs-toggle="modal" onclick="getCkEditor('weLearnEdit{{ $weLearn->id }}')" data-bs-target="#weLearnEdit{{ $weLearn->id }}" class="bi bi-pencil-square fa-2x text-dark me-3"></i>

        <!-- Edit product modal -->
        <div class="modal fade" id="weLearnEdit{{ $weLearn->id }}">
          <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">{{ $weLearn->title }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

              <form id="productEditForm" action="{{ route('admin.we-learn.update', [$weLearn->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <!-- Modal body -->
                <div class="modal-body">
                  
                  <input type="text" name="title" class="form-control my-2" placeholder="Ad" value="{{ $weLearn->title }}" required>
                  <input type="number" name="sort" class="form-control my-2" value="{{ $weLearn->sort }}" placeholder="Sıralama için sayı giriniz">

                  <div class="row mb-3">
                    <div class="col">
                      <h5>Eklemek istediğiniz fotoğrafları seçin<h5><h6 class="fw-light text-muted"> - Yeni bir fotoğraf yüklediğinizde eski fotoğraf <strong class="fw-bold">silinecektir.</strong></h6>
                      <input type="file" id="files{{ $weLearn->id }}" name="files" class="form-control my-4 files" placeholder="Ekleme istediğiniz fotoğrafı seçin"/>
                    </div>
                  </div>

                  <!--
                  <textarea class="form-control editorWeLearn" name="contents">
                  </textarea>
                  -->
                  
                  <div id="toolbar-container"></div>
                  <div id="editor" class="form-control">
                    @php
                      print_r($weLearn->contents)
                    @endphp
                  </div>
                  <input id="description{{ $weLearn->id }}" name="contents" type="hidden">
                  
                  

                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                  <button type="submit" onclick="$('#description{{ $weLearn->id }}').val($('#weLearnEdit{{ $weLearn->id }}').find('#editor').html());" class="btn btn-primary">Güncelle</button>
                </div>

              </form>

            </div>
          </div>
        </div>

        <!-- Delete product button -->
        <i data-bs-toggle="modal" data-bs-target="#weLearnDeleteForm{{ $weLearn->id }}" class="bi bi-x-square-fill fa-2x text-danger"></i>
        
        <!-- Delete product modal -->
        <div class="modal fade" id="weLearnDeleteForm{{ $weLearn->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <form id="productDestroy" action="{{ route('admin.we-learn.destroy', [$weLearn->id]) }}" method="POST">
                @csrf
                @method('delete')
                <div class="modal-body fw-bold fs-5">
                  Silmek istediğinize emin misiniz?
                </div>
                
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                  <button type="submit" class="btn btn-primary">Evet</button>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>


    @endforeach

  </div>

</div>



<script>

  function getCkEditor(data) {
    if (data) {
      console.log(data);
      DecoupledEditor
      .create( document.getElementById(data).querySelector( '#editor' ), {
        ckfinder: {
          uploadUrl: "{{ route('admin.api.dashboard.ckeditor-upload').'?token='.Session::get('user')['token'] }}"
        }
      } )
      .then( editor => {
        const toolbarContainer = document.getElementById(data).querySelector( '#toolbar-container' );
        toolbarContainer.appendChild( editor.ui.view.toolbar.element );
      } )
      .catch( error => {
        console.error( error );
      } );

    } else {

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


    }
  }  

  $(document).ready(function() {

    $('.editorWeLearn').each(function(i, obj) {
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
            "<img class=\"img-thumb\" width=\"75\" height=\"75\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Sil</span>" +
            "</div>").insertAfter("#" + fileID);
          $(".remove").click(function(){
            $(this).parent(".img-thumb-wrapper").remove();
          });
          
        });
        fileReader.readAsDataURL(f);
      }
    });

  });

</script>

@endsection
