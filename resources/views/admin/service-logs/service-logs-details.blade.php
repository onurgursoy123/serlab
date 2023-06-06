@extends('admin.layouts.master')



@section('content')

    <div class="container">
        <div class="row mb-3">
            <div class="col-12 col-md-8 me-5">
                <h3 class="text-center my-3">{{ $blog->title }}</h3>
                <div class="row justify-content-center">
                    <!--
                    @php
                        $blog_image = json_decode($blog->img_json);
                        $b_url = [];
                        foreach($blog_image as $b_img) {
                            array_push($b_url, $b_img->path."/".$b_img->name);
                        }
                    @endphp
                    @if (!empty($b_url[0])) 
                        <div class="col-12 col-md-8">
                            <img src="{{ $b_url[0] }}" class="card-img-top" alt="...">
                        </div>
                    @endif
                    -->
                </div>
                <div class="row justify-content-center mt-5">
                    <div class="col">
                        {!! $blog->contents !!}
                    </div>
                </div>
            </div>
            

            <div class="col-12 col-md-2 ms-5">
                <p class="mb-4"><strong class="">SON EKLENEN YAZILAR</strong></p>
                @if (!empty($blogsOther))
                    <ul class="list-group list-group-flush" style="width: 250px">
                        @foreach($blogsOther as $bo)
                            <li class="list-group-item">
                                <a href="{{ route('admin.serviceLogs.details.index', ['id' => $bo->id]) }}" class="" style="text-decoration: none; color:black">{{ $bo->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-8">
                    <div class="row py-5 d-flex justify-content-center">
                        
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