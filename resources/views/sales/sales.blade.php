@extends('layouts.master')



@section('content')

<style>
    #btn-back-to-top {
    position: fixed;
    bottom: 300px;
    right: 180px;
    display: none;
    }
</style>

    <div class="container px-5 py-3">

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

        <div class="row justify-content-center mt-4">

            <div class="col-12 m-3">
                <div class="d-flex justify-content-center">
                    <p style="color:#00539f;">BİZE SAT ÜRÜN DETAY FORMU</p>
                </div>
                <form action="{{ route('sales.sendFormUsingMail') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <article>
                        <div class="form-floating mb-3 border border-0">
                            <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" name="name" style="background-color: white; border-radius:0%" required>
                            <label for="floatingInput" style="color: rgb(108, 117, 125)">Ad</label>
                        </div>
                        <div class="form-floating mb-3 border border-0">
                            <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" name="surname" style="background-color: white; border-radius:0%" required>
                            <label for="floatingInput" style="color: rgb(108, 117, 125)">Soyad</label>
                        </div>
                        <div class="form-floating mb-3 border border-0">
                            <input type="number" class="form-control border border-0 border-bottom" id="floatingInput" name="phone" style="background-color: white; border-radius:0%" required>
                            <label for="floatingInput" style="color: rgb(108, 117, 125)">Telefon</label>
                        </div>
                        <div class="form-floating mb-3 border border-0">
                            <input type="mail" class="form-control border border-0 border-bottom" id="floatingInput" name="mail" style="background-color: white; border-radius:0%" required>
                            <label for="floatingInput" style="color: rgb(108, 117, 125)">E-posta</label>
                        </div>
                        <div class="form-floating mb-3 border border-0">
                            <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" name="deviceType" style="background-color: white; border-radius:0%" required>
                            <label for="floatingInput" style="color: rgb(108, 117, 125)">Cihaz Türü</label>
                        </div>
                        <div class="form-floating mb-3 border border-0">
                            <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" name="brand" style="background-color: white; border-radius:0%" required>
                            <label for="floatingInput" style="color: rgb(108, 117, 125)">Markası</label>
                        </div>
                        <div class="form-floating mb-3 border border-0">
                            <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" name="modelNo" style="background-color: white; border-radius:0%" required>
                            <label for="floatingInput" style="color: rgb(108, 117, 125)">Model Numarası</label>
                        </div>
                        <div class="form-floating mb-3 border border-0">
                            <input type="text" class="form-control border border-0 border-bottom" id="floatingInput" name="serialNo" style="background-color: white; border-radius:0%" required>
                            <label for="floatingInput" style="color: rgb(108, 117, 125)">Seri Numarası</label>
                        </div>
                        <div class="form-floating mb-3 border border-0">
                            <div class="mb-3">
                                <label for="formFileMultiple" class="form-label ms-2" style="color: rgb(108, 117, 125)">Cihaz Fotoğrafları (En fazla 5 tane yükleyin.)</label>
                                <input type="file" id="fileEnd" name="files[]" accept="image/*" multiple class="form-control my-4 files" placeholder="Ekleme istediğiniz fotoğrafları seçin"/>
                            </div>
                        </div>
                        

                        <div class="form-floating mb-3 border border-0">
                            <input type="text" class="form-control border border-0 border-bottom" name="description" id="floatingInput" style="background-color: white; border-radius:0%" required>
                            <label for="floatingInput" style="color: rgb(108, 117, 125)">Cihazı Oluşturan Üniteler (Bir kaç cümleyle açıklayınız.)</label>
                        </div>
                        <div class="form-floating mb-3 border border-0">
                            <input type="text" class="form-control border border-0 border-bottom" name="address" id="floatingInput" style="background-color: white; border-radius:0%" required>
                            <label for="floatingInput" style="color: rgb(108, 117, 125)">Adres</label>
                        </div>
                        <div class="form-floating mb-3 border border-0">
                            <input type="text" class="form-control border border-0 border-bottom" name="city" id="floatingInput" style="background-color: white; border-radius:0%" required>
                            <label for="floatingInput" style="color: rgb(108, 117, 125)">Şehir</label>
                        </div>
                        
                    </article>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="approval" id="flexCheckDefault" required>
                        <label class="form-check-label" for="flexCheckDefault" style="color: #00539f">
                        KVKK İletişim Formu
                        </label>
                    </div>
                    <p style="color: #00539f">KVKK Onay Formu İçin <span><a href="#">Tıklayınız</a></span> </p>
                    <button type="submit" class="btn btn-primary" style="color: white">Gönder</button>
                </form>

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