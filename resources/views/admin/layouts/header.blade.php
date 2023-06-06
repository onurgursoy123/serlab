<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <title>{{ config('app.name', '') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/decoupled-document/ckeditor.js"></script>


  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/v.css') }}" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100" style="background: #fff">

<div class="">
  <div class="">
    <div class="">

      <footer class="mt-auto text-center text-lg-start bg-light text-muted border border-top">
        <section class="d-flex justify-content-center justify-content-lg-between px-4 mx-3 border-top">
          <div class="d-flex flex-row bd-highlight p-0 m-0">
            <a id="telNo" href="#" class="py-2 d-none d-xxl-inline-block me-4 fw-bold ms-5 text-nowrap" style="text-decoration: none; color:#3467ef"></a>
            <a id="mail" class="py-2 d-none d-xxl-inline-block me-4 ms-5 text-nowrap" style="color: rgb(108, 117, 125); text-decoration: none;"></a>
            <a id="time" class="py-2 d-none d-xxl-inline-block me-4 ms-5 text-nowrap" style="color: rgb(108, 117, 125); text-decoration: none;" ></a>
            {{-- <a class="py-2 d-none d-xxl-inline-block" style="color: rgb(108, 117, 125); text-decoration: none;" >Privacy Policy</a> --}}
            <a id="address" class="py-2 d-none d-xxl-inline-block me-4 ms-5 text-nowrap" style="color: rgb(108, 117, 125); text-decoration: none;" ></a> 
            <a id="wtelNo" class="navbar-brand" target="_blank" href=""></a>
            <span id="wtelNoSpan" style="display: none" class="pt-2">WhatsApp</span>

          </div>
          <i data-bs-toggle="modal" data-bs-target="#hEdit50" class="bi bi-pencil-square fa-2x text-dark"></i>
          <div class="mt-2 text-start text-nowrap">
            <a id="facebook" style="display: none" href="" class="me-3 text-reset text-decoration-none">
              <i class="fab fa-facebook-f"></i>
            </a>
             <a id="twitter" style="display: none" href="" class="me-3 text-reset text-decoration-none">
              <i class="fab fa-twitter"></i>
            </a> 
            <a id="instagram" style="display: none" href="" class="me-3 text-reset text-decoration-none">
              <i class="fab fa-instagram"></i>
            </a>
             <a id="linkedin" style="display: none" href="" class="me-3 text-reset text-decoration-none">
              <i class="fab fa-linkedin"></i>
            </a> 
          </div>
        </section>
      </footer>

      <div class="modal fade" id="hEdit50">
        <div class="modal-dialog ">
          <div class="modal-content">
    
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Düzenlemeler</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
    
            <form id="productEditForm" action="{{ route('admin.dashboard.header.update') }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('put')
              <!-- Modal body -->
              <div class="modal-body">
                
                <input id="utelNo" type="text" name="telNo" class="form-control my-2" value="" placeholder="Telefon numarasi">
                <input id="umail" type="email" name="mail" class="form-control my-2" value="" placeholder="E-mail adresi">
                <input id="utime" type="text" name="time" class="form-control my-2" value="" placeholder="Açık/Kapalı saat dilimi">
                <input id="uaddress" type="text" name="address" class="form-control my-2" value="" placeholder="Adres">
                <input id="uwtelNo" type="text" name="wtelNo" class="form-control my-2" value="" placeholder="Whatsapp tel no">
                <input id="ufacebook" type="text" name="facebook" class="form-control my-2" value="" placeholder="Facebook">
                <input id="utwitter" type="text" name="twitter" class="form-control my-2" value="" placeholder="Twitter">
                <input id="uinstagram" type="text" name="instagram" class="form-control my-2" value="" placeholder="Instagram">
                <input id="ulinkedIn" type="text" name="linkedIn" class="form-control my-2" value="" placeholder="LinkedIn">
    
              </div>
    
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                <button type="submit" class="btn btn-primary">Güncelle</button>
              </div>
    
            </form>
    
          </div>
        </div>
      </div>


      <header class="site-header sticky-top">
        <div class="d-flex flex-column flex-md-row d-flex justify-content-evenly bg-light">
          <nav class="navbar navbar-expand-md">

            <a class="navbar-brand" href="{{ route('admin.dashboard.index') }}"><img width="50" height="50" src="/image/serlab-logo-png.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarFilter" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
              <span class="dropdown-hover d-none d-md-inline-block">
                <a class="py-2 mx-4" href="{{ route('admin.dashboard.index') }}">
                  Anasayfa
                </a>
              </span>
              <span class="dropdown-hover d-none d-md-inline-block">
                <a class="py-2 mx-4 dropdown-toggle" href="#">
                  Hizmetlerimiz
                </a>
                <ul id="headerOurServicesId" class="dropdown-hover-menu dropdown-menu">
                  <li style="margin: 0;"><a id="admin-our-services-repairAndMaintenance" style="color: #38c172 !important;" class="text-decoration-none c-h-b" href="{{ route('admin.our-services.get.index') }}">Yeni Hizmet Ekle</a></li>
                </ul>
              </span>
              <span class="dropdown-hover d-none d-md-inline-block">
                <a class="py-2 mx-4 dropdown-toggle" href="{{ route('admin.products.index') }}">
                  Ürünler
                </a>
                <ul id="headerProductsId" class="dropdown-hover-menu dropdown-menu">
                  <li style="margin: 0" class="text-decoration-none c-h-b fw-bold text-reset ps-4">MARKALAR</li>
                </ul>
              </span>
              <span class="dropdown-hover d-none d-md-inline-block">
                <a class="py-2 mx-4 text-nowrap" href="{{ route('admin.products.productList.index', [9]) }}">
                  2.El Cihazlar
                </a>
              </span>
              <span class="dropdown-hover d-none d-md-inline-block">
                <a class="py-2 mx-4 text-nowrap" href="{{ route('admin.serviceLogs.index') }}">
                  Servis Günlükleri
                </a>
              </span>
              <span class="dropdown-hover d-none d-md-inline-block">
                <a class="py-2 mx-4 text-nowrap" href="{{ route('admin.we-learn.index') }}">
                  Bilgi Ediniyoruz
                </a>
              </span>
              <span class="dropdown-hover d-none d-md-inline-block">
                <a class="py-2 mx-4" href="{{ route('admin.corporate.index') }}">
                  Kurumsal
                </a>
              </span>
              <span class="dropdown-hover d-none d-md-inline-block">
                <a class="py-2 mx-4" href="{{ route('admin.contact.index') }}">
                  İletişim
                </a>
              </span>
              <span class="dropdown-hover d-none d-md-inline-block">
                <a class="py-2 mx-4 text-nowrap" href="{{ route('admin.form.index') }}">
                  Talep Formu
                </a>
              </span>
              <span class="d-none d-md-inline-block">
                <a class="py-2 mx-4 text-decoration-none text-nowrap" style="color: #cbaf18" href="{{ route('admin.sales.index') }}">
                  Bize Sat
                </a>
              </span>
              

              @if(session()->has('user'))
                <form action="{{ route('admin.auth.logout') }}" method="POST">
                  @csrf
                  <input class="btn btn-danger" style="color: #fff" type="submit" value="Çıkış">
                </form>
              @endif

            </div>

          </nav>
        </div>

      </header>
      
    </div>
  </div>
</div>

<!--
<div class="offcanvas offcanvas-start w-100" id="navbarFilter">
  <div class="offcanvas-header justify-content-end m-2">
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <div class="col">
      <div class="row">

        <p>
          <a class="link-secondary text-decoration-none" data-bs-toggle="collapse" href="#collapseExample0" role="button" aria-expanded="false" aria-controls="collapseExample0">
            Anasayfa
          </a>
        </p>
        <p>
          <a class="link-secondary text-decoration-none" data-bs-toggle="collapse" href="#collapseExample0" role="button" aria-expanded="false" aria-controls="collapseExample0">
            Kurumsal
          </a>
        </p>

        <p>
          <a class="link-secondary text-decoration-none dropdown-toggle" data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample1">
            Ürünler
          </a>
        </p>
        
        <div class="collapse" id="collapseExample1">
          <ul class="">
            <li class="dropdown-item" style="margin: 0"><a class="text-decoration-none c-h-b" href="#">Action</a></li>
            <li class="dropdown-item" style="margin: 0"><a class="text-decoration-none c-h-b" href="#">Another action</a></li>
            <li class="dropdown-item" style="margin: 0"><a class="text-decoration-none c-h-b" href="#">Something else here</a></li>
          </ul>
        </div>

        <p>
          <a class="link-secondary text-decoration-none dropdown-toggle" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">
            2.El Cihazlar
          </a>
        </p>
        <div class="collapse" id="collapseExample2">
          <ul class="">
            <li class="dropdown-item" style="margin: 0"><a class="text-decoration-none c-h-b" href="#">Action</a></li>
            <li class="dropdown-item" style="margin: 0"><a class="text-decoration-none c-h-b" href="#">Another action</a></li>
            <li class="dropdown-item" style="margin: 0"><a class="text-decoration-none c-h-b" href="#">Something else here</a></li>
          </ul>
        </div>
        <p>
          <a class="link-secondary text-decoration-none" data-bs-toggle="collapse" href="#collapseExample0" role="button" aria-expanded="false" aria-controls="collapseExample0">
            Talep Formu
          </a>
        </p>
        <p>
          <a class="link-secondary text-decoration-none" data-bs-toggle="collapse" href="#collapseExample0" role="button" aria-expanded="false" aria-controls="collapseExample0">
            Servis Günlükleri
          </a>
        </p>
        <p>
          <a class="link-secondary text-decoration-none" data-bs-toggle="collapse" href="#collapseExample0" role="button" aria-expanded="false" aria-controls="collapseExample0">
            İletişim
          </a>
        </p>
        <p>
          <a class="link-secondary text-decoration-none" data-bs-toggle="collapse" href="#collapseExample0" role="button" aria-expanded="false" aria-controls="collapseExample0">
            Kayıt
          </a>
        </p>
        <p>
          <a class="link-danger text-decoration-none" data-bs-toggle="collapse" href="#collapseExample0" role="button" aria-expanded="false" aria-controls="collapseExample0">
            Çıkış
          </a>
        </p>
      </div>
    </div>
  </div>
</div>
-->

<div>

  <!-- edit -->

</div>

<div class="container py-5 mt-3">
  <div class="mx-md-5">


<script>
  $( document ).ready(function() {
    $(".dropdown-hover").hover(function(){
      $(this).find('ul').first().stop().toggle(200);
      $(this).find('a').first().css("color", "#00599c");
    }, function(){
      $(this).find('ul').stop().hide(200);
      $(this).find('a').first().css("color", "rgb(108, 117, 125)");
    });

    
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    
    /*
    $.ajax({
        url: '/admin/our-services/getHeaderName',
        type: 'GET',
        data: {
          _token: CSRF_TOKEN
        },
        dataType: 'JSON',
        success: function (response) {
          if (response.status == true) {
            response.data.forEach(function myFunction(item, ind) {
              if (item.path == "admin.our-services.repair-and-maintenance") {
                $("#admin-our-services-repairAndMaintenance").html(item.title);
              } else if (item.path == "admin.our-services.spare-parts") {
                $("#admin-our-services-spareParts").html(item.title);
              } else if (item.path == "admin.our-services.product-sales") {
                $("#admin-our-services-productSales").html(item.title);
              } else if (item.path == "admin.our-services.guarantee") {
                $("#admin-our-services-guarantee").html(item.title);
              } else if (item.path == "admin.our-services.other-services") {
                $("#admin-our-services-otherServices").html(item.title);
              } else {
                console.log("NOT-HERE");
              }
            });
          }
        }
    }); 
    */

    $.ajax({
      /* the route pointing to the post function */
      url: '/admin/dashboard/header',
      type: 'GET',
      /* send the csrf-token and the input to the controller */
      data: {
        _token: CSRF_TOKEN
      },
      dataType: 'JSON',
      success: function (response) {
        if (response.status == true) {
          if (response.mail != null) {
            $('#mail').html('<i class="bi bi-envelope me-1"></i>' + response.mail);
            $('#umail').val(response.mail);
          }
          if (response.telNo != null) {
            $('#telNo').html('<i class="bi bi-telephone fw-bold me-1"></i>' + response.telNo);
            $('#utelNo').val(response.telNo);
          }
          if (response.time != null) {
            $('#time').html('<i class="bi bi-clock me-1"></i>' + response.time);
            $('#utime').val(response.time);
          }
          if (response.time != null) {
            $('#address').html('<i class="bi bi-clock me-1"></i>' + response.address);
            $('#uaddress').val(response.address);
          }
          if (response.facebook != null) {
            $('#facebook').attr('href', response.facebook);
            $('#ufacebook').val(response.facebook);
            $("#facebook").show();
          }
          if (response.twitter != null) {
            $('#twitter').attr('href', response.twitter);
            $('#utwitter').val(response.twitter);
            $("#twitter").show();
          }
          if (response.instagram != null) {
            $('#instagram').attr('href', response.instagram);
            $('#uinstagram').val(response.instagram);
            $("#instagram").show();
          }
          if (response.linkedIn != null) {
            $('#linkedin').attr('href', response.linkedIn);
            $('#ulinkedIn').val(response.linkedIn);
            $("#linkedin").show();
          }
          if (response.wtelNo != null) {
            $('#wtelNo').attr('href', 'https://api.whatsapp.com/send/?phone=' + response.wtelNo + '&text=Merhaba+bilgi+almak+istiyorum+%3F&type=phone_number&app_absent=0')
            $('#wtelNo').html('<img width="28" height="35" src="/image/whatspp-icon.png" alt="">');
            $("#wtelNoSpan").show();
            // $("#wtelNoSpan").html("WhatsApp " + response.wtelNo);

          }
        }
      }
    });

    $.ajax({
      /* the route pointing to the post function */
      url: '/admin/dashboard/getHeaderProducts',
      type: 'GET',
      /* send the csrf-token and the input to the controller */
      data: {
        _token: CSRF_TOKEN
      },
      dataType: 'JSON',
      success: function (response) {
        if (response.status == true) {
          var domForHeaderProducts = '';
          response.products.forEach((data) => {
            domForHeaderProducts += '<li style="margin: 0;"><a class="text-decoration-none c-h-b" href="/admin/products/subproducts/' + data.id + '">' + data.title.charAt(0).toUpperCase() + data.title.slice(1).toLowerCase() + '</a></li>';
          })
          $("#headerProductsId").append(domForHeaderProducts);
        }
      }
    });

    $.ajax({
      url: '/admin/our-services/getOurServicesHeader',
      type: 'GET',
      data: {
        _token: CSRF_TOKEN
      },
      dataType: 'JSON',
      success: function (response) {
        if (response.status == true) {
          var domForHeaderProducts = '';
          response.ourServices.forEach((data) => {
            domForHeaderProducts += '<li style="margin: 0;"><a class="text-decoration-none c-h-b" href="/admin/our-services/v/' + data.title + '">' + data.title + '</a></li>';
          })
          $("#headerOurServicesId").append(domForHeaderProducts);
        }
      }
    });

  });
</script>

