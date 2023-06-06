@extends('admin.layouts.master')



@section('content')


<style>

  @media (max-width:767px) {

  }
  
  .intro {
      font-size:16px;
      max-width:500px;
      margin:0 auto;
  }
  .intro p {
      margin-bottom:0;
  }
  
  .people {
      padding:50px 0;
      cursor: pointer;
  }
  .item {
      margin-bottom:30px;
  }
  
  .item .box {
      text-align:center;
      background-repeat:no-repeat;
      background-size:cover;
      background-position:center;
      height:280px;
      position:relative;
      overflow:hidden;
  }
  
  .item .cover {
      position:absolute;
      top:0;
      left:0;
      width:100%;
      height:100%;
      background-color:rgba(31,148,255,0.75);
      transition:opacity 0.15s ease-in;
      opacity:0;
      padding-top:130px;
      color:#fff;
      text-shadow:1px 1px 1px rgba(0,0,0,0.15);
  }
  
  .item:hover .cover {
      opacity:1;
  }
  
  .item .name {
      font-weight:bold;
      margin-bottom:8px;
  }
  
  .item .title {
      text-transform:uppercase;
      font-weight:bold;
      color:#bbd8fb;
      letter-spacing:2px;
      font-size:13px;
      margin-bottom:20px;
  }
  
  .social {
      font-size:18px;
  }
      
  .social a {
      color:inherit;
      margin:0 10px;
      display:inline-block;
      opacity:0.7;
  }
  .social a:hover {
      opacity:1;
  }

  #btn-back-to-top {
  position: fixed;
  bottom: 300px;
  right: 170px;
  display: none;
  }


  .img-thumb {
    max-height: 75px;
    border: 2px solid none;
    border-radius:3px;
    padding: 1px;
    cursor: pointer;
  }
  .img-thumb-wrapper {
    display: inline-block;
    margin: 10px 10px 0 0;
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
  .ck-editor__editable[role="textbox"] {
    min-height: 200px;
  }
  .ck-content .image {
    max-width: 80%;
    margin: 20px auto;
  }
    
</style>

<div class="container p-5 pt-0">
  <button type="button" class="btn btn-secondary btn-floating rounded-circle" id="btn-back-to-top">
    <i class="fa-solid fa-angle-up fa-xs"></i>
  </button>

  <div class="row">
    <!-- products -->
    <div class="team-grid col-12">
      <div class="container">
        <div class="row people d-flex justify-content-center">

          <input id="search" type="text" onchange="search()" placeholder="Aramak istediğiniz kelimeyi yazın." ng-model="vm.searched" ng-change="vm.sqlsearch()" aria-invalid="false" style="-webkit-text-size-adjust: 100%; -webkit-font-smoothing: auto; -webkit-box-direction: normal; text-rendering: optimizeLegibility; -webkit-tap-highlight-color: transparent; box-sizing: border-box; vertical-align: baseline; height: 3rem !important; padding: 20px !important; border: 2px solid #dfe1e5 !important; border-radius: 24px !important; color: #202124 !important; font-family: arial,sans-serif !important; font-size: 14px !important; -webkit-appearance: none; margin-top: 1rem; width: 100%;">
          <form id="searchForm" action="{{ route('admin.products.productList.search') }}" style="visibility: hidden;" method="POST" enctype="multipart/form-data">
            @csrf
            <input id="searchFormInput" name="word" type="text">
            <input id="parentId" name="parent_id" type="hidden" value="{{ $parent_id }}">
            <input type="submit" value="S">
          </form>

          <div id="addInnerProduct" style="border: 1px solid grey; display: none;">
            <form id="dashboardProductsSuccess" action="{{ route('admin.products.productList.save') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <!-- Modal body -->
              <div class="modal-body text-center">
                
                <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                <input type="text" name="title" class="form-control my-2" placeholder="Ürün Adı" required>
                <input type="number" min="0.00" max="999999999.00" step="0.01" name="price" class="form-control my-2" placeholder="Ürün Fiyatı Örn: 52.00">
                <input type="number" name="stock" class="form-control my-2" placeholder="Stok Adeti">
                <input type="number" name="sort" class="form-control my-2" placeholder="Sıralama için sayı giriniz">
                <input type="text" name="video" class="form-control my-2" placeholder="youtube video linki yazabilirsiniz">
                <input type="text" name="priceLink" class="form-control my-2" placeholder="Ürün satış linkini girebilirsiniz">

                <div class="row mb-3">
                  <div class="col">
                    <h5>Eklemek istediğiniz fotoğrafları seçin <h6 class="fw-light text-muted"> - Aşağıda gösterilen fotoğrafları bu kısımda <strong class="fw-bold">silemezsiniz.<br></strong> - Bir <strong class="fw-bold">kapak fotoğrafı</strong> seçiniz aksi takdirde rastgele bir fotoğraf seçilecektir.</h6></h5>
                    <input type="file" id="fileEnd" v="image" name="files[]" accept="image/*" multiple class="form-control my-4 files" placeholder="Ekleme istediğiniz fotoğrafları seçin"/>
                  </div>
                </div>


                <div class="row mb-3">
                  <div class="col">
                    <h5>Eklemek istediğiniz pdfleri seçin</h5>
                    <input type="file" id="filePdf" v="file" name="files_pdf[]" multiple class="form-control my-4 files" placeholder="Ekleme istediğiniz pdfleri seçin"/>
                  </div>
                </div>
                <div id="toolbar-container"></div>
                <div id="editor" class="form-control editorAddProduct"></div>
                <input id="description" name="description" type="hidden">
                
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="submit" style="color: white" onclick="$('#description').val($('.editorAddProduct').html());" class="btn btn-primary p-3 m-2">Ekle</button>
              </div>

            </form>
          </div>
          

          <div class="col-lg-2 mx-3 item text-center border border-1 p-0 m-0">
            <div class="d-flex flex-column h-100 justify-content-center align-items-center">
              <span class="fw-bold">Yeni Ürün Ekle</span>
              
              <!-- Add product button --> <!-- data-bs-target="#productAdd" -->
              <i data-bs-toggle="modal" onclick="$('#addInnerProduct').show();getCkEditor()" class="bi bi-plus-square-fill fa-2x text-dark me-3"></i>

              <!-- Add product modal -->
              <div class="modal fade" id="productAdd">
                <div class="modal-dialog modal-fullscreen">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Yeni Ürün Ekle</h4>
                      <button type="button" onclick="" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form id="dashboardProductsSuccess" action="{{ route('admin.products.productList.save') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <!-- Modal body -->
                      <div class="modal-body">
                        
                        <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                        <input type="text" name="title" class="form-control my-2" placeholder="Ürün Adı" required>
                        <input type="number" min="0.00" max="999999999.00" step="0.01" name="price" class="form-control my-2" placeholder="Ürün Fiyatı Örn: 52.00">
                        <input type="number" name="stock" class="form-control my-2" placeholder="Stok Adeti">
                        <input type="number" name="sort" class="form-control my-2" placeholder="Sıralama için sayı giriniz">
                        <input type="text" name="video" class="form-control my-2" placeholder="youtube video linki yazabilirsiniz">
                        <input type="text" name="priceLink" class="form-control my-2" placeholder="Ürün satış linkini girebilirsiniz">

                        <div class="row mb-3">
                          <div class="col">
                            <h5>Eklemek istediğiniz fotoğrafları seçin <h6 class="fw-light text-muted"> - Aşağıda gösterilen fotoğrafları bu kısımda <strong class="fw-bold">silemezsiniz.<br></strong> - Bir <strong class="fw-bold">kapak fotoğrafı</strong> seçiniz aksi takdirde rastgele bir fotoğraf seçilecektir.</h6></h5>
                            <input type="file" id="fileEnd" v="image" name="files[]" accept="image/*" multiple class="form-control my-4 files" placeholder="Ekleme istediğiniz fotoğrafları seçin"/>
                          </div>
                        </div>


                        <div class="row mb-3">
                          <div class="col">
                            <h5>Eklemek istediğiniz pdfleri seçin</h5>
                            <input type="file" id="filePdf" v="file" name="files_pdf[]" multiple class="form-control my-4 files" placeholder="Ekleme istediğiniz pdfleri seçin"/>
                          </div>
                        </div>
                        <div id="toolbar-container"></div>
                        <div id="editor" class="form-control editorAddProduct"></div>
                        <input id="description" name="description" type="hidden">
                        
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

          
          @foreach ($products as $product)

            @php
              $img = json_decode($product->img_json);
              $url = [];
              $urlDefault = "";
              foreach($img as $i) {
                if (isset($i->is_dafault) && $i->is_dafault == 1) {
                  $urlDefault = $i->path."/".$i->name;
                } else {
                  array_push($url, $i->path."/".$i->name);
                }
              }
              if (empty($urlDefault)) {
                $urlDefault = $url[0];
              }
            @endphp
            
            <div class="col-md-4 col-lg-3 item text-center border border-1 p-0 m-0">
              <a href="{{ route('admin.products.productList.product.index', ['parent_id' => $product->parent_id, 'id' => $product->id])}}" class="text-decoration-none text-dark">
                <div class="box" style="height:400px">
                  <img src="{{ $urlDefault }}" class="card-img-top" alt="...">
                  <div class="card-body justify-content-center">
                    <div class="card-body my-3 mx-1">
                      <h6 class="card-title text-center">{{ $product->title }}</h6>
                    </div>
                    @if (!empty($product->price))
                      <div class="card-body justify-content-center my-3">
                        <span class="text-uppercase text-muted m-0 p-0">Fiyat </span>
                        <br>
                        <span class="card-text text-center m-0 p-0">{{ $product->price }} $</span>
                      </div>
                    @endif
                  </div>
                  <div class="cover">
                    <div class="social"><i class="bi bi-box-arrow-in-right fa-2x"></i></div>
                    <p class="text-uppercase text-center mx-2">Ürün detaylarını göster</p>
                  </div>
                </div>
              </a>

              <!-- Edit product button -->
              <i data-bs-toggle="modal" data-bs-target="#productEdit{{ $product->id }}" onclick="getCkEditor('productEdit{{ $product->id }}')" class="bi bi-pencil-square fa-2x text-dark me-3"></i>

              <!-- Edit product modal -->
              <div class="modal fade" id="productEdit{{ $product->id }}">
                <div class="modal-dialog modal-fullscreen">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">{{ $product->title }}</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form id="productEditForm" action="{{ route('admin.products.productList.update', [$product->id]) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('put')
                      <!-- Modal body -->
                      <div class="modal-body">
                        
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="parent_id" value="{{ $product->parent_id }}">
                        <input type="text" name="title" class="form-control my-2" placeholder="Ürün Adı" value="{{ $product->title }}" required>
                        <input type="number" min="0.00" max="999999999.00" step="0.01" name="price" class="form-control my-2" placeholder="Ürün Fiyatı Örn: 52.00" value="{{ $product->price }}">
                        <input type="number" name="stock" class="form-control my-2" placeholder="Stok Adeti" value="{{ $product->stock }}">
                        <input type="number" name="sort" class="form-control my-2" value="{{ $product->sort }}" placeholder="Sıralama için sayı giriniz">
                        <input type="text" name="video" class="form-control my-2" placeholder="youtube video linki yazabilirsiniz" value="{{ $product->video }}">

                        <div class="row mb-3">
                          <div class="col">
                            <h5>Eklemek istediğiniz fotoğrafları seçin</h5>
                            <input type="file" id="files{{ $product->id }}" v="image" name="files[]" multiple class="form-control my-4 files" placeholder="Ekleme istediğini fotoğrafları seçin"/>
                            
                            
                            <?php
                            $imgEdit = json_decode($product->img_json);
                            foreach($imgEdit as $j) {
                              if (isset($j->is_dafault) && $j->is_dafault == 1) {
                                ?>
                                
                                <div class="img-thumb-wrapper card shadow"><input id="imageDel" type="hidden" name="imgsDel[]" value=""><img class="img-thumb" src="{{ $j->path."/".$j->name }}" title="{{ $j->path."/".$j->name }}"><br><span class="removeOldImage">Sil</span><div class="px-5"><div class="form-check"><input class="form-check-input" type="radio" name="default_image_title" value="{{ $j->path."/".$j->name }}" id="{{ $j->path."/".$j->name }}" checked><label class="form-check-label" for="{{ $j->path."/".$j->name }}">Kapak Fotoğrafı</label></div></div></div>
                                
                                <?php
                              } else {
                                ?>
                                
                                <div class="img-thumb-wrapper card shadow"><input id="imageDel" type="hidden" name="imgsDel[]" value=""><img class="img-thumb" src="{{ $j->path."/".$j->name }}" title="{{ $j->path."/".$j->name }}"><br><span class="removeOldImage">Sil</span><div class="px-5"><div class="form-check"><input class="form-check-input" type="radio" name="default_image_title" value="{{ $j->path."/".$j->name }}" id="{{ $j->path."/".$j->name }}"><label class="form-check-label" for="{{ $j->path."/".$j->name }}">Kapak Fotoğrafı</label></div></div></div>

                                <?php
                              }
                            }
                            ?>


                          </div>
                        </div>

                        <div class="row mb-3">
                          <div class="col">
                            <h5>Eklemek istediğiniz pdfleri seçin</h5>
                            <input type="file" id="filePdf{{ $product->id }}" name="files_pdf[]" v="file" multiple class="form-control my-4 files" placeholder="Ekleme istediğiniz pdfleri seçin"/>

                            <?php
                            if (!empty($product->files_json)) {

                              $imgEdit = json_decode($product->files_json);
                              foreach($imgEdit as $j) {
                                $extension = (explode(".", $j->name));
                                $extension = $extension[1];

                                if ($extension == 'pdf') { ?>
                                  <div class="img-thumb-wrapper card shadow"><img width="75" height="75" src="/image/static/pdfFileImage.png"><br><span id="fileName" value="{{ $j->name }}"></span><input id="pdfDel" type="hidden" name="pdfsDel[]" value=""><span>{{ $j->name }}</span><br><span class="removeOldPdf">Sil</span></div>
                                  
                                <?php
                                } else if ($extension == 'doc') { ?>
                                  <div class="img-thumb-wrapper card shadow"><img width="75" height="75" src="/image/static/docFileImage.png"><br><span id="fileName" value="{{ $j->name }}"></span><input id="pdfDel" type="hidden" name="pdfsDel[]" value=""><span>{{ $j->name }}</span><br><span class="removeOldPdf">Sil</span></div>
                                    
                                <?php
                                } else if ($extension == 'docx') { ?>
                                  <div class="img-thumb-wrapper card shadow"><img width="75" height="75" src="/image/static/docFileImage.png"><br><span id="fileName" value="{{ $j->name }}"></span><input id="pdfDel" type="hidden" name="pdfsDel[]" value=""><span>{{ $j->name }}</span><br><span class="removeOldPdf">Sil</span></div>
                                                                    
                                <?php
                                } else { ?>
                                  <div class="img-thumb-wrapper card shadow"><img width="75" height="75" src="/image/static/docFileImage.png"><br><span id="fileName" value="{{ $j->name }}"></span><input id="pdfDel" type="hidden" name="pdfsDel[]" value=""><span>Tanımlanamayan dosya, silmenizi öneririm.</span><br><span class="removeOldPdf">Sil</span></div>
                                
                                <?php
                                }
                                ?>

                                
                              <?php
                              }
                            }
                            ?>


                          </div>
                        </div>

                        <div id="toolbar-container"></div>
                        <div id="editor" class="form-control">
                          @php
                            print_r($product->description)
                          @endphp
                        </div>
                        <input id="description{{ $product->id }}" name="description" type="hidden">
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" onclick="$('#description{{ $product->id }}').val($('#productEdit{{ $product->id }}').find('#editor').html());" class="btn btn-primary">Güncelle</button>
                      </div>

                    </form>

                  </div>
                </div>
              </div>

              <!-- Delete product button -->
              <i data-bs-toggle="modal" data-bs-target="#productDeleteForm{{ $product->id }}" class="bi bi-x-square-fill fa-2x text-danger"></i>
              
              <!-- Delete product modal -->
              <div class="modal fade" id="productDeleteForm{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <form id="productDestroy" action="{{ route('admin.products.destroy') }}" method="POST">
                      @csrf
                      @method('delete')
                      <input type="hidden" name="id" value="{{ $product->id }}">

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
    </div>
  </div>

</div>

<script>

  $(".removeOldImage").click(function(){
    $(this).parent(".img-thumb-wrapper").find("#imageDel")[0].value = $(this).parent(".img-thumb-wrapper").find("img")[0].title;
    $(this).parent(".img-thumb-wrapper").hide();
  });

  $(".removeOldPdf").click(function(){
    $(this).parent(".img-thumb-wrapper").find("#pdfDel")[0].value = $(this).parent(".img-thumb-wrapper").find("#fileName")[0].getAttribute('value');
    $(this).parent(".img-thumb-wrapper").hide();
  });


  function getCkEditor(data) {
    if (data) {

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
    
  let mybutton = document.getElementById("btn-back-to-top");
  
  window.onscroll = function () {
    scrollFunction();
  };

  function scrollFunction() {
    if (
      document.body.scrollTop > 20 ||
      document.documentElement.scrollTop > 20
    ) {
      mybutton.style.display = "block";
    } else {
      mybutton.style.display = "none";
    }
  }
  mybutton.addEventListener("click", backToTop);

  function backToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }

  $(document).ready(function() {
    
    $('.editorProduct').each(function(i, obj) {
      /*
      ClassicEditor
          .create( obj )
          .then( editor => {
                  // console.log( editor );
          } )
          .catch( error => {
                  // console.error( error );
          } );
          */
      
    });
    

    $(".files").on("change", function(e, obj) {

      if (e.target.getAttribute("v") == "file") {
        console.log("if");

        var fileID = e.target.id;
        console.log(fileID);
        var files = this.files;
        var i = 0;
        len = files.length;
        console.log("ifs");

        (function readFile(n) {
          var reader = new FileReader();
          var f = files[n];
          reader.onload = function(e) {
            console.log("HH");
            $("<div class=\"img-thumb-wrapper card shadow\">" + f.name +
              "<br/><span class=\"remove\">Sil</span>" + "<div class='px-5'></div>" +
              "</div>").insertAfter("#" + fileID);
            $(".remove").click(function(){
              $(this).parent(".img-thumb-wrapper").remove();
            });

            if (n < len -1) readFile(++n)
          };
          reader.readAsDataURL(f);
        }(i)); 
      } else {
        var fileID = e.target.id;
        var files = this.files;
        var i = 0;
        len = files.length;

        (function readFile(n) {
          var reader = new FileReader();
          var f = files[n];
          reader.onload = function(e) {
            $("<div class=\"img-thumb-wrapper card shadow\">" +
              "<img class=\"img-thumb\" src=\"" + e.target.result + "\" title=\"" + f.name + "\"/>" +
              "<br/><span class=\"remove\">Sil</span>" + "<div class='px-5'>" + "<div class='form-check'><input class='form-check-input' type='radio' name='default_image_title' value='" + f.name + "' id='" + f.name +"'><label class='form-check-label' for='" + f.name +"'>Kapak Fotoğrafı</label></div>" + "</div>" +
              "</div>").insertAfter("#" + fileID);
            $(".remove").click(function(){
              $(this).parent(".img-thumb-wrapper").remove();
            });

            if (n < len -1) readFile(++n)
          };
          reader.readAsDataURL(f);
        }(i)); 
      }


    });

    search = () => {
      
      // console.log($("#search").val());
      // $("#searchFormInput").val($("#search").val());
      document.getElementById("searchFormInput").value = $("#search").val();

      document.getElementById('searchForm').submit();
      // <a href="javascript:;" onclick="document.getElementById('dashboardDescriptionDestroy').submit();"><i class="bi bi-x-square-fill fa-2x text-danger"></i></a>

    }

  });

</script>


@endsection