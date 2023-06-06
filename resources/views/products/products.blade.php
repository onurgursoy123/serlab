@extends('layouts.master')

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

  
    <div class="team-grid">
      <div class="container text-center">
        <div class="row people d-flex justify-content-center">

          <input id="search" type="text" onchange="search()" placeholder="Aramak istediğiniz kelimeyi yazın." ng-model="vm.searched" ng-change="vm.sqlsearch()" aria-invalid="false" style="-webkit-text-size-adjust: 100%; -webkit-font-smoothing: auto; -webkit-box-direction: normal; text-rendering: optimizeLegibility; -webkit-tap-highlight-color: transparent; box-sizing: border-box; vertical-align: baseline; height: 3rem !important; padding: 20px !important; border: 2px solid #dfe1e5 !important; border-radius: 24px !important; color: #202124 !important; font-family: arial,sans-serif !important; font-size: 14px !important; -webkit-appearance: none; margin-top: 1rem; width: 100%;">
          <form id="searchForm" action="{{ route('products.search') }}" style="visibility: hidden;" method="POST" enctype="multipart/form-data">
            @csrf
            <input id="searchFormInput" name="word" type="text">
            <input type="submit" value="S">
          </form>
          
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
                <a href="{{ route('products.subProducts.index', [$product->id]) }}" class="text-decoration-none text-dark">
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