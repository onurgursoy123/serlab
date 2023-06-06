</div>
</div>

<footer class="mt-auto text-center text-lg-start bg-light text-muted">
  <section class="d-flex justify-content-center  px-4 pt-2 mx-3 border-top">
    <p id="footerContents" class="fw-bold text-center"></p>
    
    {{-- 
    <div class="d-flex flex-row bd-highlight mb-3">
      <a href="#" class="py-2 d-none d-md-inline-block me-4 fw-bold ms-5" style="text-decoration: none; color:#3467ef";><i class="bi bi-telephone fw-bold"><span class="ms-2">0 (216) 606 44 21</span></i></a>
      <a class="py-2 d-none d-md-inline-block me-4 ms-5" style="color: rgb(108, 117, 125); text-decoration: none;" href="#"> <i class="bi bi-envelope"></i> servis@ser-lab.com</a>
      <a class="py-2 d-none d-md-inline-block me-4 ms-5" style="color: rgb(108, 117, 125); text-decoration: none;" href="#"><i class="bi bi-clock me-1"></i>Pazartesi - Cumartesi 9:00 - 6:00 / Pazar - KAPALI</a>
      <a class="py-2 d-none d-md-inline-block me-4 ms-5" style="color: rgb(108, 117, 125); text-decoration: none;" href="#"><i class="bi bi-clock me-1"></i>Cevizli Mah. Tansel Cad. Bulut Plaza A Blok No:12/18 Kat :5 Daire: 40-41-42</a>
    </div>
    <div class="mt-2 text-start">
      <a href="" class="me-3 text-reset">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="" class="me-3 text-reset">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="" class="me-3 text-reset">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="" class="me-3 text-reset">
        <i class="fab fa-linkedin"></i>
      </a>
    </div> --}}
  </section>
</footer>

@php
if($errors->any()) {
  foreach ($errors->all() as $err) {
    toast($err, 'error')->position('bottom-end')->autoClose(5000)->hideCloseButton()->timerProgressBar();
  }
}
@endphp

</body>


@php \Session::has('success') ? toast(\Session::get('success'), 'success')->position('bottom-end')->autoClose(3000)->hideCloseButton()->timerProgressBar() : ""; @endphp
@php \Session::has('error') ? toast(\Session::get('error'), 'error')->position('bottom-end')->autoClose(3000)->hideCloseButton()->timerProgressBar() : ""; @endphp
@include('sweetalert::alert')

<script>

  $( document ).ready(function() {

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

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

    $.ajax({
      url: '/admin/dashboard/footer',
      type: 'GET',
      data: {
        _token: CSRF_TOKEN
      },
      dataType: 'JSON',
      success: function (response) {
        if (response.status == true) {
          $("#footerContents").append(response.data.contents);
        }
      }
    });

  });

</script>

</html>
