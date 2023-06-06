@extends('layouts.master')



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
    
</style>

<div class="container p-5 pt-0">
  <button type="button" class="btn btn-secondary btn-floating rounded-circle" id="btn-back-to-top">
    <i class="fa-solid fa-angle-up fa-xs"></i>
  </button>

  <div class="row">
    <div class="team-grid">
      <div class="container">
        <div class="row people d-flex justify-content-center px-5">
          
          <div class="row d-flex justify-content-center px-md-5 px-lg-5">

            <input id="search" type="text" onchange="search()" placeholder="Aramak istediğiniz kelimeyi yazın." ng-model="vm.searched" ng-change="vm.sqlsearch()" aria-invalid="false" style="-webkit-text-size-adjust: 100%; -webkit-font-smoothing: auto; -webkit-box-direction: normal; text-rendering: optimizeLegibility; -webkit-tap-highlight-color: transparent; box-sizing: border-box; vertical-align: baseline; height: 3rem !important; padding: 20px !important; border: 2px solid #dfe1e5 !important; border-radius: 24px !important; color: #202124 !important; font-family: arial,sans-serif !important; font-size: 14px !important; -webkit-appearance: none; margin-top: 1rem; width: 100%;">
            <form id="searchForm" action="{{ route('products.productList.search') }}" style="visibility: hidden;" method="POST" enctype="multipart/form-data">
              @csrf
              <input id="searchFormInput" name="word" type="text">
              <input id="parentId" name="parent_id" type="hidden" value="{{ $parent_id }}">
              <input type="submit" value="S">
            </form>



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
                <a href="{{ route('products.productList.product.index', ['parent_id' => $product->parent_id, 'id' => $product->id])}}" class="text-decoration-none text-dark">
                  <div class="box" style="height:350px">
                    <img src="{{ $urlDefault }}" class="card-img-top" alt="...">
                    <div class="card-body justify-content-center">
                      <div class="card-body my-3 mx-1">
                        <h6 class="card-title text-center">{{ $product->title }}</h6>
                      </div>
                      @if(!empty($product->price))
                        <div class="card-body justify-content-center my-3">
                          <span class="text-uppercase text-muted m-0 p-0">Fiyat </span>
                          <br>
                          <span class="card-text text-center m-0 p-0">{{ $product->price }} $</span>
                        </div>
                      @else
                        <div class="card-body justify-content-center my-3">
                          <span class="text-uppercase text-muted m-0 p-0">Teklif İste</span>
                          <br>
                        </div>
                      @endif
                    </div>
                    <div class="cover">
                      <div class="social"><i class="bi bi-box-arrow-in-right fa-2x"></i></div>
                      <p class="text-uppercase text-center mx-2">Ürün detaylarını göster</p>
                    </div>
                  </div>
                </a>
              </div>

            @endforeach

          </div>


        </div>
      </div>
    </div>
  </div>

</div>

<script>
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

  search = () => {
      
    // console.log($("#search").val());
    // $("#searchFormInput").val($("#search").val());
    document.getElementById("searchFormInput").value = $("#search").val();

    document.getElementById('searchForm').submit();
    // <a href="javascript:;" onclick="document.getElementById('dashboardDescriptionDestroy').submit();"><i class="bi bi-x-square-fill fa-2x text-danger"></i></a>

  }

</script>


@endsection