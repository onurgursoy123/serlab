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
            <div class="col-12">
                <article>
                    <p style="color: rgb(108, 117, 125)"><strong> SERLAB SERVİS</strong> Laboratuvar Sistemleri, üreticisine bakmaksızın tüm laboratuvar ekipmanlarına uzman, eğitimli kadrosu ve geniş tecrübesi ile kurulum, bakım, onarım, kalibrasyon, IQOQ, sözleşme desteği içeren hizmet sunmaktadır. </p>

                    <p style="color: rgb(108, 117, 125)">Geniş tedarikçi ağı ile, firmanız için en uygun cihaz ve sarf malzeme seçeneklerini araştırıp filtreliyor doğru bütçe ve doğru cihaz seçimine yardımcı oluyoruz.</p>
                    
                </article>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-12 m-3 col-md-5">
                
                <form action="{{ route('admin.form.mailAddress') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" value="{{ $serviceRequestMail }}" name="mail" placeholder="Mail Adresi" aria-label="Mail Adresi" aria-describedby="button-addon2">
                        <input type="hidden" name="type" value="0">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Değiştir</button>
                    </div>
                </form>

                <p style="color:#00539f;">SERVİS TALEP FORMU</p>
                <article>
                    
                    <div class="form-floating mb-3 border border-0">
                        <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" placeholder="name@example.com" style="background-color: white; border-radius:0%">
                        <label for="floatingInput" style="color: rgb(108, 117, 125)">Ad</label>
                    </div>
                    <div class="form-floating mb-3 border border-0">
                        <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" placeholder="name@example.com" style="background-color: white; border-radius:0%">
                        <label for="floatingInput" style="color: rgb(108, 117, 125)">Soyad</label>
                    </div>
                    <div class="form-floating mb-3 border border-0">
                        <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" placeholder="name@example.com" style="background-color: white; border-radius:0%">
                        <label for="floatingInput" style="color: rgb(108, 117, 125)">Görev</label>
                    </div>
                    <div class="form-floating mb-3 border border-0">
                        <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" placeholder="name@example.com" style="background-color: white; border-radius:0%">
                        <label for="floatingInput" style="color: rgb(108, 117, 125)">Firma Kurum Adı</label>
                    </div>
                    <div class="form-floating mb-3 border border-0">
                        <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" placeholder="name@example.com" style="background-color: white; border-radius:0%">
                        <label for="floatingInput" style="color: rgb(108, 117, 125)">Departman</label>
                    </div>
                    <div class="form-floating mb-3 border border-0">
                        <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" placeholder="name@example.com" style="background-color: white; border-radius:0%">
                        <label for="floatingInput" style="color: rgb(108, 117, 125)">Telefon</label>
                    </div>
                    <div class="form-floating mb-3 border border-0">
                        <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" placeholder="name@example.com" style="background-color: white; border-radius:0%">
                        <label for="floatingInput" style="color: rgb(108, 117, 125)">E-posta</label>
                    </div>
                    <div class="form-floating mb-3 border border-0">
                        <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" placeholder="name@example.com" style="background-color: white; border-radius:0%">
                        <label for="floatingInput" style="color: rgb(108, 117, 125)">İstenilen Hizmet</label>
                    </div>
                    <div class="form-floating mb-3 border border-0">
                        <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" placeholder="name@example.com" style="background-color: white; border-radius:0%">
                        <label for="floatingInput" style="color: rgb(108, 117, 125)">Hizmet Detay</label>
                    </div>
                    <div class="form-floating mb-3 border border-0">
                        <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" placeholder="name@example.com" style="background-color: white; border-radius:0%">
                        <label for="floatingInput" style="color: rgb(108, 117, 125)">Cihaz Türü</label>
                    </div>
                    <div class="form-floating mb-3 border border-0">
                        <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" placeholder="name@example.com" style="background-color: white; border-radius:0%">
                        <label for="floatingInput" style="color: rgb(108, 117, 125)">Markası</label>
                    </div>
                    <div class="form-floating mb-3 border border-0">
                        <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" placeholder="name@example.com" style="background-color: white; border-radius:0%">
                        <label for="floatingInput" style="color: rgb(108, 117, 125)">Model Numarası</label>
                    </div>
                    <div class="form-floating mb-3 border border-0">
                        <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" placeholder="name@example.com" style="background-color: white; border-radius:0%">
                        <label for="floatingInput" style="color: rgb(108, 117, 125)">Seri Numarası</label>
                    </div>
                    <div class="form-floating mb-3 border border-0">
                        <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" placeholder="name@example.com" style="background-color: white; border-radius:0%">
                        <label for="floatingInput" style="color: rgb(108, 117, 125)">Cihazı Oluşturan Üniteler</label>
                    </div>
                    <div class="form-floating mb-3 border border-0">
                        <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" placeholder="name@example.com" style="background-color: white; border-radius:0%">
                        <label for="floatingInput" style="color: rgb(108, 117, 125)">Adresi</label>
                    </div>
                    <div class="form-floating mb-3 border border-0">
                        <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" placeholder="name@example.com" style="background-color: white; border-radius:0%">
                        <label for="floatingInput" style="color: rgb(108, 117, 125)">Şehir</label>
                    </div>
                </article>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault" style="color: #00539f">
                      KVKK İletişim Formu
                    </label>
                </div>
                <p style="color: #00539f">KVKK Onay Formu İçin <span><a href="#">Tıklayınız</a></span> </p>
                <button type="button" class="btn btn-primary" style="color: white">Gönder</button>
            </div>

            <div class="col-12 m-3 col-md-5">
                
                <form action="{{ route('admin.form.mailAddress') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" value="{{ $deviceOfferMail }}" name="mail" placeholder="Mail Adresi" aria-label="Mail Adresi" aria-describedby="button-addon2">
                        <input type="hidden" name="type" value="1">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Değiştir</button>
                    </div>
                </form>

                <p style="color:#00539f;">CİHAZ TEKLİF FORMU</p>
                <article>
                    <div class="form-floating mb-3 border border-0">
                        <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" placeholder="name@example.com" style="background-color: white; border-radius:0%">
                        <label for="floatingInput" style="color: rgb(108, 117, 125)">Ad</label>
                    </div>
                    <div class="form-floating mb-3 border border-0">
                        <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" placeholder="name@example.com" style="background-color: white; border-radius:0%">
                        <label for="floatingInput" style="color: rgb(108, 117, 125)">Soyad</label>
                    </div>
                    <div class="form-floating mb-3 border border-0">
                        <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" placeholder="name@example.com" style="background-color: white; border-radius:0%">
                        <label for="floatingInput" style="color: rgb(108, 117, 125)">Telefon</label>
                    </div>
                    <div class="form-floating mb-3 border border-0">
                        <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" placeholder="name@example.com" style="background-color: white; border-radius:0%">
                        <label for="floatingInput" style="color: rgb(108, 117, 125)">E-posta</label>
                    </div>
                    <div class="form-floating mb-3 border border-0">
                        <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" placeholder="name@example.com" style="background-color: white; border-radius:0%">
                        <label for="floatingInput" style="color: rgb(108, 117, 125)">Şehir</label>
                    </div>
                    <div class="form-floating mb-3 border border-0">
                        <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" placeholder="name@example.com" style="background-color: white; border-radius:0%">
                        <label for="floatingInput" style="color: rgb(108, 117, 125)">Firma Kurum Adı</label>
                    </div>
                    <div class="form-floating mb-3 border border-0">
                        <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" placeholder="name@example.com" style="background-color: white; border-radius:0%">
                        <label for="floatingInput" style="color: rgb(108, 117, 125)">Departman</label>
                    </div>
                    <div class="form-floating mb-3 border border-0">
                        <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" placeholder="name@example.com" style="background-color: white; border-radius:0%">
                        <label for="floatingInput" style="color: rgb(108, 117, 125)">Görev</label>
                    </div>
                    <div class="form-floating mb-3 border border-0">
                        <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" placeholder="name@example.com" style="background-color: white; border-radius:0%">
                        <label for="floatingInput" style="color: rgb(108, 117, 125)">İstenilen Cihaz</label>
                    </div>
                    
                </article>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault" style="color: #00539f">
                      KVKK İletişim Formu
                    </label>
                </div>
                <p style="color: #00539f">KVKK Onay Formu İçin <span><a href="#">Tıklayınız</a></span> </p>
                <button type="button" class="btn btn-primary" style="color: white">Gönder</button>
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
</script>


@endsection