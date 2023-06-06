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
      right: 180px;
      display: none;
    }
    .carousel-inner > .item > img {
      width:510px;
      height:510px;
    }
    .carousel {
      width:510px;
      height:510px;
    }
    .carousel-inner img {
      margin: auto;
    }
  
</style>


<div class="container pt-0">


    <button type="button" class="btn btn-secondary btn-floating rounded-circle" id="btn-back-to-top">
      <i class="fa-solid fa-angle-up fa-xs"></i>
    </button>
  <!--
    <div class="row d-flex justify-content-center mb-5 me-5">
        <div class="col-12">   
            <img src="/image/ika.webp" class="rounded mx-auto d-block" alt="..." style="width: 9%">
        </div>
    </div>
  -->

    <div class="row pt-0">

        <!-- left side -->
        <div class="col-2 mt-5 pt-5 ps-5">
          <div class="position-relative">
            <div class="position-fixed top-50 start+50 translate-middle">
              <ul class="mt-4 boder border-0" id="myTab" role="tablist" style="bs-nav-tabs-border-width: 0px; bs-nav-tabs-link-active-bg: none;">

                <li class="nav-item list-group-item d-flex justify-content-end align-items-center mt-3 dropdown-hover" role="presentation">
                  <a class="nav-link active pe-3" id="products-tab" data-bs-toggle="tab" href="#products" role="tab" aria-controls="products" aria-selected="true" style="text-decoration: none; color: rgb(108, 117, 125);">Ürün</a>
                  <span class="badge bg-primary rounded-pill"> </span>
                </li>
                <!--
                <li class="nav-item list-group-item d-flex justify-content-end align-items-center mt-3 dropdown-hover" role="presentation">
                  <a class="nav-link pe-3" id="tecnical-tab" data-bs-toggle="tab" href="#tecnical" role="tab" aria-controls="tecnical" aria-selected="false" style="text-decoration: none; color: rgb(108, 117, 125);">Açıklama</a>
                  <span class="badge bg-primary rounded-pill"> </span>
                </li>
                -->
                <li class="nav-item list-group-item d-flex justify-content-end align-items-center mt-3 dropdown-hover" role="presentation">
                  <a class="nav-link pe-3" id="download-tab" data-bs-toggle="tab" href="#download" role="tab" aria-controls="download" aria-selected="false" style="text-decoration: none; color: rgb(108, 117, 125);">Dökümanlar</a>
                  <span class="badge bg-primary rounded-pill"> </span>
                </li>
                <!--
                <li class="nav-item list-group-item d-flex justify-content-end align-items-center mt-3 dropdown-hover" role="presentation">
                  <a class="nav-link pe-3" id="reviews-tab" data-bs-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false" style="text-decoration: none; color: rgb(108, 117, 125);">Değerlendirmeler</a>
                  <span class="badge bg-primary rounded-pill"> </span>
                </li>
                -->
                <li class="nav-item list-group-item d-flex justify-content-end align-items-center mt-3 dropdown-hover" role="presentation">
                  <a class="nav-link pe-3" id="videos-tab" data-bs-toggle="tab" href="#videos" role="tab" aria-controls="videos" aria-selected="false" style="text-decoration: none; color: rgb(108, 117, 125);">Videolar</a>
                  <span class="badge bg-primary rounded-pill"> </span>
                </li>

              </ul>
            </div>
          </div>
        </div>

        <!-- middle side -->
        <div class="col-7">

          <div class="tab-content" id="myTabContent">

            <!-- slider -->
            <div class="tab-pane fade show active" id="products" role="tabpanel" aria-labelledby="products-tab">
              
              <div id="carouselExampleControls" class="carousel carousel-dark slide m-auto" data-bs-ride="carousel">
                
                @php
                  $images = json_decode($product->img_json);
                  $url = [];
                  foreach($images as $img) {
                    array_push($url, $img->path."/".$img->name);
                  }
                @endphp
                
                <div class="carousel-inner">
                  @foreach ($url as $index => $img)
                    <div class="carousel-item {{ $index == 0 ? "active" : ""}}">
                      <img src="{{ $img }}" class="d-block w-100" style="height:510px;">
                    </div>
                  @endforeach
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
             
              <div class="mt-5 pt-5">
                {!! $product->description !!}
              </div>
              
            </div>

            <!-- downloads -->
            <div class="tab-pane fade" id="download" role="tabpanel" aria-labelledby="download-tab">
              @if (!empty($product->files_json))
                <div class="row p-5 d-flex justify-content-center">

                  @php
                    $files_json = json_decode($product->files_json);
                    $file_url = [];
                    foreach($files_json as $file) {
                      array_push($file_url, $file->path."/".$file->name);
                    }
                  @endphp

                  @foreach ($file_url as $index => $file)
                    <span class="d-flex justify-content-center">
                      <a href="{{ $file }}" target="_blank" class="card-link" style="text-decoration: none;">
                        <button type="button" class="btn btn-primary" style="width: 300px; height: 40px; color:white;"> ÜRÜN KATALOĞU - {{ $index + 1 }} &nbsp;&nbsp;&nbsp;<i class="bi bi-cloud-arrow-down-fill fa-1x"></i></button>
                      </a>
                    </span>
                  @endforeach

                </div>
              @endif

            </div>

            <!-- comments -->
            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">

              <div class="row py-5 d-flex justify-content-center">

                <span class="d-flex justify-content-center">
                  <a href="#" onclick="reviewAdd()" class="card-link" id="review" style="text-decoration: none;">
                    <button type="button" class="btn btn-primary" style="width: 300px; height: 40px; color:white;"> Yorum Ekle &nbsp;<i class="bi bi-pencil-square fa-1x"></i></button>
                  </a>
                </span>
              
                <div class="row mb-5" id="reviewAdd" style="display: none;">
                  
                  <form action="{{ route('comments.index') }}" method="POST">
                    @csrf
                    
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="input-group mb-3">
                      <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Adınız">
                      <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="Email">
                    </div>

                    <div class="col">
                      <div class="mb-3">
                        <textarea name="contents" class="form-control" id="exampleFormControlTextarea1" placeholder="Yorumunuz" rows="3"></textarea>
                      </div>

                      <div class="mb-3 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary" style="width: 300px; height: 40px; color:white;"> Gönder </button>
                      </div>
                    </div>

                  </form>

                </div>

              </div>


              
              @foreach ($product->comments as $comment)
                <div class="card text-center my-5">

                    <div class="card-header">
                      {{ $comment->name }}
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">{{ $comment->contents }}</h5>
                    </div>
                    <div class="card-footer text-muted">
                      {{ $comment->created_at }}
                    </div>

                </div>
              @endforeach

            </div>

            <!-- video -->
            <div class="tab-pane fade text-center" id="videos" role="tabpanel" aria-labelledby="videos-tab">
              @if (!empty($product->video))
                <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $product->video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              @endif
            </div>

          </div>


          <!-- same product -->
          <div class="row mt-5 pt-5 text-center">
            <h3 class="text-center fw-lighter mb-3">Uygulama uzmanlarımız ek olarak şunu önermektedir
            </h3>
            
            @foreach ($product->same_products as $s_product)
              @php
                $s_images = json_decode($s_product->img_json);
                $s_url = [];
                foreach($s_images as $s_img) {
                  array_push($s_url, $s_img->path."/".$s_img->name);
                  break;
                }
              @endphp
              <div class="col-md-3 col-lg-3 item text-center p-0 m-0 mx-1">

                <a href="{{ route('admin.products.productList.product.index', ['parent_id' => $s_product->parent_id, 'id' => $s_product->id])}}" class="text-decoration-none text-dark position-relative">
                  <div class="box" style="height:400px">
                    <img src="{{ $s_url[0] }}" class="card-img-top" alt="...">
                    <div class="card-body justify-content-center mt-3">
                      <div class="card-body">
                        <h6 class="card-title text-center">{{ $s_product->title }}</h6>
                      </div>
                      <!--
                        <div class="card-body justify-content-center">
                          <p class="card-text text-center mb-0 pb-0">Fiyat</p>
                          <a href="#" class="card-link" style="text-decoration: none;"><p class="text-center">Teklif İste</p></a>
                        </div>
                      -->                     
                    </div>
                    <div class="cover">
                      <div class="social"><i class="bi bi-box-arrow-in-right fa-2x"></i></div>
                      <p class="text-uppercase">Daha Fazlası</p>
                    </div>
                  </div>
                </a>
                
              </div>
            @endforeach
  
          </div>


        </div>

        <div class="col-3">
            <div class="card border border-1 ms-3" style="width: 18rem;">
                <div class="card-body">
                    <div class="card-body">
                        <h4 class="card-title text-center">{{ $product->title }}</h4>
                    </div>
                    
                    @if (isset($product->priceLink) && !empty($product->priceLink))
                      <div class="card-body">
                        <p class="card-text text-center mb-0 pb-0">Fiyat: {{ $product->price }} $</p>
                        <a href="{{ $product->priceLink }}" target="_blank" class="card-link" style="text-decoration: none; color:white;"><button type="button" class="btn btn-primary" style="width: 100%; height: 40px;">Satın Al</button></a>
                      </div>
                    @else
                      <div class="card-body">
                        <p class="card-text text-center mb-0 pb-0">Fiyat: {{ $product->price }} $</p>
                        <a href="{{ route('admin.form.index') }}" class="card-link" style="text-decoration: none; color:white;"><button type="button" class="btn btn-primary" style="width: 100%; height: 40px;">Teklif İste</button></a>
                      </div>
                    @endif

                </div>
            </div>
        </div>

    </div>
</div>


<script>
  
  const myInterval = setInterval(myTimer, 1);
  var countCk = 0;
  function myTimer() {
    $(".ck-widget__resizer").remove();
    $(".ck-widget__type-around").remove();
    if (countCk > 10) {
        myStopFunction();
    }
    countCk++;
  }
  function myStopFunction() {
    clearInterval(myInterval);
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


  function reviewAdd() {
  var review = document.getElementById("review");
  var reviewAdd = document.getElementById("reviewAdd");
  review.style.display = "none";
  reviewAdd.style.display = "block";
}

function reviewSuccess() {
  var reviewAdd = document.getElementById("reviewAdd");
  var successAlert = document.getElementById("successAlert");
  reviewAdd.style.display = "none";
  successAlert.style.display = "block";
}

</script>


@endsection