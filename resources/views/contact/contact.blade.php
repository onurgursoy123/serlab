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

    <div class="container p-5">

        <button type="button" class="btn btn-secondary btn-floating rounded-circle" id="btn-back-to-top">
            <i class="fa-solid fa-angle-up fa-xs"></i>
        </button>

        <div class="row justify-content-center">
            <div class="col-10 col-md-8">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d324597.83199406334!2d28.824637712754196!3d40.89963246185175!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cac408f77a1747%3A0xc296ac77f4609c0f!2sSerlab%20Servis%20Laboratuvar%20Sistemleri%20Analitik%20Cihazlar%20ve%20Bili%C5%9Fim%20San.%20Tic.%20Ltd.%20%C5%9Eti.!5e0!3m2!1str!2str!4v1662209681483!5m2!1str!2str" width="110%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-10 col-md-8">
                <hr class="my-5" style="width: 100%;" >

                {!! $data->contents !!}
                <!--
                <article>
                    <h6 style="color:#00539f;">IKA® Turkey Laboratuvar ve Proses Teknolojileri A.Ş.</h6>
                    <div class="row">
                        <div class="col-4"><p style="color: rgb(108, 117, 125)">Mescit Mah. Fettah Başaran<br> Cad. No: 21/A<br>
                            Turkey</p>
                        </div>
                        <div class="col-4">
                            <span style="color: rgb(108, 117, 125)">Phone:<span style="color:#00539f;"> +90 216 394 43 43</span></span><br>
                            <span style="color: rgb(108, 117, 125)">eMail:<span style="color:#00539f;"> sales.turkey@ika.com</span></span><br>
                        </div>
                    </div>
                </article>
            -->
                <hr class="my-5" style="width: 100%;" >
            </div>
        </div>
       
        <!--
        <div class="row justify-content-center">
            <div class="col-10 col-md-8">
                <article>
                    <h6 style="color:#00539f;">Contact</h6>
                    <p style="color: rgb(108, 117, 125)"><strong>Ibrahim Akbas</strong><br>Managing Director IKA Turkey</p>
                    <div class="row">
                        <div class="col-12">
                            <span style="color: rgb(108, 117, 125)">Phone:<span style="color:#00539f;"> +90 216 394 43 43</span></span><br>
                            <span style="color: rgb(108, 117, 125)">Mobile:<span style="color:#00539f;"> +90 552 744 83 53</span></span><br>
                            <span style="color: rgb(108, 117, 125)">eMail:<span style="color:#00539f;"> sales.turkey@ika.com</span></span><br>
                        </div>
                    </div>
                </article>
                <hr class="my-5" style="width: 100%;" >
            </div>
        </div>
    -->

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