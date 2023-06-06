@extends('admin.layouts.master')

@section('content')


  <div class="row d-flex justify-content-center mb-5">
    <div class="col-12">
      @foreach ($data as $item)
        @if ($item->title == 'logo')
          @php
            $img = json_decode($item->description);
            foreach($img as $i) {
              $url = $i->path."/".$i->name;
            }
          @endphp
          <img src="{{ $url }}" class="rounded mx-auto d-block" alt="..." style="width: 6%">
          <form id="dashboardLogoSuccess" class="text-center" action="{{ route('admin.dashboard.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="hidden" name="status" value="3">
            <input type="hidden" name="path" value="admin.dashboard">
            <input type="hidden" name="title" value="logo">
            <label for="fileDashboardLogo">
              <i class="bi bi-pencil-square fa-2x text-dark"></i>
            </label>
            <input id="fileDashboardLogo" type="file" name="description" class="d-none"/>
            <a href="javascript:;" onclick="document.getElementById('dashboardLogoSuccess').submit();"><i class="bi bi-check-square-fill fa-2x text-success"></i></a>
          </form>

          @break
        @endif
      @endforeach
      <h4 class="text-center mt-3">Teknik Servis Bakım Ve Onarım</h4>

    </div>
  </div>


  <div class="row justify-content-center mb-5">
    <div class="col-4 g-0 text-end">
      @foreach ($data as $item)
        @if ($item->title == 'products')
          @php
            $img = json_decode($item->description);
            $url = [];
            $link = [];
            foreach($img as $i) {
              array_push($url, $i->path."/".$i->name);
              array_push($link, $i->url);
            }
          @endphp
          <div class="row d-flex justify-content-center me-2">
            <div class="col-6 g-0  position-relative">
              <a href="{{ $link[0] }}">
                <span class="badge bg-secondary position-absolute top-50 start-50 translate-middle badge rounded-pill bg-danger text-center fw-bold fs-6" style="width: 80px; height: 24px;">FIRSAT</span>
                <img src="{{ $url[0] }}"  class="rounded mx-auto d-block p-1" alt="..." style="width: 100%">
              </a>
            </div>
            <div class="col-6 g-0 position-relative">
              <a href="{{ $link[1] }}">
                <span class="badge bg-secondary position-absolute top-50 start-50 translate-middle badge rounded-pill bg-danger text-center fw-bold fs-6" style="width: 80px; height: 24px;">FIRSAT</span>
                <img src="{{ $url[1] }}" class="rounded mx-auto d-block p-1" alt="..." style="width: 100%">  
              </a>
            </div> 
          </div>
          <div class="row d-flex justify-content-center me-2">
            <div class="col-6 g-0 position-relative">
              <a href="{{ $link[2] }}">
                <span class="badge bg-secondary position-absolute top-50 start-50 translate-middle badge rounded-pill bg-danger text-center fw-bold fs-6" style="width: 80px; height: 24px;">FIRSAT</span>
                <img src="{{ $url[2] }}" class="rounded mx-auto d-block p-1" alt="..." style="width: 100%">  
              </a>
            </div>
            <div class="col-6 g-0 position-relative">
              <a href="{{ $link[3] }}">
                <span class="badge bg-secondary position-absolute top-50 start-50 translate-middle badge rounded-pill bg-danger text-center fw-bold fs-6" style="width: 80px; height: 24px;">FIRSAT</span>
              <img src="{{ $url[3] }}" class="rounded mx-auto d-block p-1" alt="..." style="width: 100%"> 
              </a> 
            </div>
          </div>
        @endif
      @endforeach
      
      <!-- Button trigger modal -->
      <i data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="bi bi-pencil-square fa-2x text-dark me-3"></i>

      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Fotoğraf Ekle</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="dashboardProductsSuccess" action="{{ route('admin.dashboard.update') }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('put')
              <div class="modal-body">
                
                <input type="hidden" name="status" value="4">
                <input type="hidden" name="path" value="admin.dashboard">
                <input type="hidden" name="title" value="products">

                <div class="input-group mb-3">
                  <input type="text" name="link[]" class="form-control" placeholder="Örn: www.vve7s.store" aria-describedby="button-addon2">
                  <input id="fileDashboardProducts0" type="file" name="description[]" class="d-none" multiple/>
                  <label class="btn btn-outline-secondary" for="fileDashboardProducts0">
                    <i class="bi bi-pencil-square text-dark"></i>
                  </label>
                </div>

                <div class="input-group mb-3">
                  <input type="text" name="link[]" class="form-control" placeholder="Örn: www.vve7s.store" aria-describedby="button-addon2">
                  <input id="fileDashboardProducts1" type="file" name="description[]" class="d-none" multiple/>
                  <label class="btn btn-outline-secondary" for="fileDashboardProducts1">
                    <i class="bi bi-pencil-square text-dark"></i>
                  </label>
                </div>

                <div class="input-group mb-3">
                  <input type="text" name="link[]" class="form-control" placeholder="Örn: www.vve7s.store" aria-describedby="button-addon2">
                  <input id="fileDashboardProducts2" type="file" name="description[]" class="d-none" multiple/>
                  <label class="btn btn-outline-secondary" for="fileDashboardProducts2">
                    <i class="bi bi-pencil-square text-dark"></i>
                  </label>
                </div>

                <div class="input-group mb-3">
                  <input type="text" name="link[]" class="form-control" placeholder="Örn: www.vve7s.store" aria-describedby="button-addon2">
                  <input id="fileDashboardProducts3" type="file" name="description[]" class="d-none" multiple/>
                  <label class="btn btn-outline-secondary" for="fileDashboardProducts3">
                    <i class="bi bi-pencil-square text-dark"></i>
                  </label>
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
     

    <div class="col-4 g-1 text-end">
      <div id="carouselExampleCaptions" class="carousel slide mb-1" data-bs-ride="carousel">
        @foreach ($data as $item)
          @if ($item->title == 'slider' && !empty($item->description))
            @php
              $img = json_decode($item->description);
              $url = [];
              $link = [];
              foreach($img as $i) {
                array_push($url, $i->path."/".$i->name);
                array_push($link, $i->url);
              }
            @endphp
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <a href="{{ $link[0] }}">
                  <img src="{{ $url[0] }}" class="d-block w-100" alt="...">
                </a>
              </div>
              <div class="carousel-item">
                <a href="{{ $link[1] }}">
                  <img src="{{ $url[1] }}" class="d-block w-100" alt="...">
                </a>
              </div>
              <div class="carousel-item">
                <a href="{{ $link[2] }}">
                <img src="{{ $url[2] }}" class="d-block w-100" alt="...">
                </a>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          @endif
        @endforeach
      </div>

      <!-- Button trigger modal -->
      <i data-bs-toggle="modal" data-bs-target="#staticDashboardSlider" class="bi bi-pencil-square fa-2x text-dark me-1"></i>

      <!-- Modal -->
      <div class="modal fade" id="staticDashboardSlider" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Fotoğraf Ekle</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="dashboardSlidersSuccess" action="{{ route('admin.dashboard.update') }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('put')
              <div class="modal-body">
                
                <input type="hidden" name="status" value="4">
                <input type="hidden" name="path" value="admin.dashboard">
                <input type="hidden" name="title" value="slider">

                <div class="input-group mb-3">
                  <input type="text" name="link[]" class="form-control" placeholder="Örn: www.vve7s.store" aria-describedby="button-addon2">
                  <input id="fileDashboardSliders0" type="file" name="description[]" class="d-none" multiple/>
                  <label class="btn btn-outline-secondary" for="fileDashboardSliders0">
                    <i class="bi bi-pencil-square text-dark"></i>
                  </label>
                </div>

                <div class="input-group mb-3">
                  <input type="text" name="link[]" class="form-control" placeholder="Örn: www.vve7s.store" aria-describedby="button-addon2">
                  <input id="fileDashboardSliders1" type="file" name="description[]" class="d-none" multiple/>
                  <label class="btn btn-outline-secondary" for="fileDashboardSliders1">
                    <i class="bi bi-pencil-square text-dark"></i>
                  </label>
                </div>

                <div class="input-group mb-3">
                  <input type="text" name="link[]" class="form-control" placeholder="Örn: www.vve7s.store" aria-describedby="button-addon2">
                  <input id="fileDashboardSliders2" type="file" name="description[]" class="d-none" multiple/>
                  <label class="btn btn-outline-secondary" for="fileDashboardSliders2">
                    <i class="bi bi-pencil-square text-dark"></i>
                  </label>
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

  <div class="row d-flex pt-5 justify-content-center">
    <div class="col-12 text-end" style="color: rgb(108, 117, 125)">

      @foreach ($data as $item)
        @if ($item->title == 'description')
         
          <form id="dashboardDescriptionSuccess" class="d-inline" action="{{ route('admin.dashboard.update') }}" method="POST">
            @csrf
            @method('put')
            
            <!--
            <textarea id="editors" class="form-control" name="description">  
            </textarea>
            -->
            
            <div id="toolbar-container"></div>
            <div id="editor">
              @php
                print_r($item->description)
              @endphp
            </div>

            <input id="description" name="description" type="hidden">
            <input type="hidden" name="status" value="1">
            <input type="hidden" name="path" value="admin.dashboard">
            <input type="hidden" name="title" value="description">
            <a href="javascript:;" onclick="$('#description').val($('#editor').html()); document.getElementById('dashboardDescriptionSuccess').submit();"><i class="bi bi-check-square-fill fa-2x text-success"></i></a>
          </form>

          @break
        @endif
      @endforeach
      <form id="dashboardDescriptionDestroy" class="d-inline" action="{{ route('admin.dashboard.delete') }}" method="POST">
        @csrf
        @method('delete')
        <input type="hidden" name="status" value="2">
        <a href="javascript:;" onclick="document.getElementById('dashboardDescriptionDestroy').submit();"><i class="bi bi-x-square-fill fa-2x text-danger"></i></a>
      </form>

    </div>
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

  
  /*
  ClassicEditor
    .create( document.querySelector( '#editor' ), {
        ckfinder: {
            uploadUrl: "{{ route('admin.api.dashboard.ckeditor-upload').'?token='.Session::get('user')['token'] }}"
        }
    },{
        alignment: {
            options: [ 'right', 'right' ]
        }} )
    .then( editor => {
        // console.log( editor );
    })
    .catch( error => {
        console.error( error );
    })
    */

</script>

@endsection