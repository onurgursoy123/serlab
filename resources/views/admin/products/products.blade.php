@extends('admin.layouts.master')


@section('content')



<style>
  
  @media (max-width:767px) {
    h2 {
      margin-bottom:25px;
      padding-top:25px;
      font-size:24px;
    }
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
    padding-top:80px;
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

</style>


<div class="container p-5 pt-0">

  <div class="row p-lg-5 m-lg-4 py-lg-0 my-lg-0">

    <div class="col">
      @foreach ($data as $item)
        @if ($item->title == 'banner')
          @php
            $img = json_decode($item->description);
            $url = "";
            $link = "";
            foreach($img as $i) {
              $url = $i->path."/".$i->name;
              $link = $i->url;
            }
          @endphp
          <a href="{{ $link }}"><img src="{{ $url }}" class="rounded mx-auto d-block" alt="..." style="width: 100%"></a>
          @break
        @endif
      @endforeach
    </div>
    
    <form id="dashboardBannerSuccess" class="text-end" action="{{ route('admin.products.update') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('put')
      <div class="input-group mb-3">
        <input type="text" name="link" class="form-control" placeholder="Örn: http://vve7s.store/" aria-describedby="button-addon2">
        <input id="fileDashboardProducts0" type="file" name="description" class="d-none" multiple/>
        <label class="btn btn-outline-secondary" for="fileDashboardProducts0">
          <i class="bi bi-pencil-square text-dark"></i>
        </label>
        <label class="btn btn-outline-secondary">
          <a href="javascript:;" onclick="document.getElementById('dashboardBannerSuccess').submit();"><i class="bi bi-check-square-fill text-success"></i></a>
        </label>
      </div>
      <input type="hidden" name="status" value="3">
      <input type="hidden" name="path" value="admin.products">
      <input type="hidden" name="title" value="banner">
    </form>
    
    <div class="team-grid">
      <div class="container text-center">

        <div class="row people d-flex justify-content-center">

          <input id="search" type="text" onchange="search()" placeholder="Aramak istediğiniz kelimeyi yazın." ng-model="vm.searched" ng-change="vm.sqlsearch()" aria-invalid="false" style="-webkit-text-size-adjust: 100%; -webkit-font-smoothing: auto; -webkit-box-direction: normal; text-rendering: optimizeLegibility; -webkit-tap-highlight-color: transparent; box-sizing: border-box; vertical-align: baseline; height: 3rem !important; padding: 20px !important; border: 2px solid #dfe1e5 !important; border-radius: 24px !important; color: #202124 !important; font-family: arial,sans-serif !important; font-size: 14px !important; -webkit-appearance: none; margin-top: 1rem; width: 100%;">
          <form id="searchForm" action="{{ route('admin.products.search') }}" style="visibility: hidden;" method="POST" enctype="multipart/form-data">
            @csrf
            <input id="searchFormInput" name="word" type="text">
            <input type="submit" value="S">
          </form>

          <div class="col-lg-3 col-md-5 col-sm-6 col-9 item text-center p-1 m-0 border border-1">
            <div class="d-flex flex-column h-100 justify-content-center align-items-center">
              <span class="fw-bold">Yeni Ketegori Ekle</span>

              <!-- Add product button -->
              <i data-bs-toggle="modal" data-bs-target="#productAdd" class="bi bi-plus-square-fill fa-2x text-dark me-3"></i>

              <!-- Add product modal -->
              <div class="modal fade" id="productAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Yeni Kategori Ekle</h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form id="dashboardProductsSuccess" action="{{ route('admin.products.save') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <!-- Modal body -->
                      <div class="modal-body">
                        
                        <input type="hidden" name="parent_id" value="0">
                        <input type="text" name="title" class="form-control my-2" placeholder="Ürün Adı" required>
                        <input type="number" name="sort" class="form-control my-2" placeholder="Sıralama için sayı giriniz">

                        <div class="row mb-3">
                          <div class="col">
                            <input type="file" id="fileEnd" name="files[]" accept="image/*" multiple class="form-control my-4 files" placeholder="Ekleme istediğini fotoğrafları seçin"/>
                          </div>
                        </div>

                      </div>

                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">Ekle</button>
                      </div>

                    </form>


                  </div>
                </div>
              </div>
            </div>
          </div>
          
          @foreach ($products as $product)

            @if (!empty($product) && !empty($product->img_json))
              @php
                $img = json_decode($product->img_json);
                $url = [];
                foreach($img as $i) {
                  array_push($url, $i->path."/".$i->name);
                  break;
                }
              @endphp
              <div class="col-lg-3 col-md-5 col-sm-6 col-9 item text-center p-1 m-0">
                <a href="{{ route('admin.products.subProducts.index', [$product->id]) }}" class="text-decoration-none text-dark">
                  <div class="box border border-1 p-2">
                    <img src="{{ $url[0] }}" class="card-img-top" alt="...">
                    <div class="card-body justify-content-center">
                      <div class="card-body">
                        <h6 class="card-title text-center">{{ $product->title }}</h6>
                      </div>
                    </div>
                    <div class="cover">
                      <div class="social"><i class="bi bi-box-arrow-in-right fa-2x"></i></div>
                      <p class="text-uppercase">Daha Fazlası</p>
                    </div>
                  </div>
                </a>

                <!-- Edit product button -->
                <i data-bs-toggle="modal" data-bs-target="#productEdit{{ $product->id }}" class="bi bi-pencil-square fa-2x text-dark me-3"></i>

                <!-- Edit product modal -->
                <div class="modal fade" id="productEdit{{ $product->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">{{ $product->title }}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>

                      <form id="productEditForm" action="{{ route('admin.products.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <!-- Modal body -->
                        <div class="modal-body">
                          
                          <input type="hidden" name="id" value="{{ $product->id }}">
                          <input type="hidden" name="parent_id" value="{{ $product->parent_id }}">
                          <input type="text" name="title" class="form-control my-2" placeholder="Ürün Adı" value="{{ $product->title }}" required>
                          <input type="number" name="sort" class="form-control my-2" value="{{ $product->sort }}" placeholder="Sıralama için sayı giriniz">

                          <div class="row mb-3">
                            <div class="col">
                              <input type="file" id="files{{ $product->id }}" name="files[]" accept="image/*" multiple class="form-control my-4 files" placeholder="Ekleme istediğini fotoğrafları seçin"/>
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
            @endif
            
          @endforeach

        </div>
      </div>
    </div>

  </div>

</div>


<script>
  $(document).ready(function() {

    $('.editorProduct').each(function(i, obj) {
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