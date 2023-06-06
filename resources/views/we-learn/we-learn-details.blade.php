@extends('layouts.master')



@section('content')

    <div class="container">
        <div class="row mb-3">
            <div class="col-12 col-md-8 me-5">
                <h3 class="text-center my-3">{{ $weLearn->title }}</h3>
                <div class="row justify-content-center">
                    <!--
                    @php
                        $weLearn_image = json_decode($weLearn->img_json);
                        $w_url = [];
                        foreach($weLearn_image as $w_img) {
                            array_push($w_url, $w_img->path."/".$w_img->name);
                        }
                    @endphp
                    @if (!empty($w_url[0])) 
                        <div class="col-12 col-md-8">
                            <img src="{{ $w_url[0] }}" class="card-img-top" alt="...">
                        </div>
                    @endif
                    -->
                </div>
                <div class="row justify-content-center mt-5">
                    <div class="col">
                        <div id="editor" class="ck-content ck-editor__editable ck-rounded-corners ck-editor__editable_inline ck-blurred" lang="en" dir="ltr" role="textbox" aria-label="Rich Text Editor. Editing area: main" >
                        {!! $weLearn->contents !!}
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="col-12 col-md-2 ms-5">
                <p class="mb-4"><strong class="">SON EKLENEN YAZILAR</strong></p>
                @if (!empty($weLearnsOther))
                    <ul class="list-group list-group-flush" style="width: 250px">
                        @foreach($weLearnsOther as $wlo)
                            <li class="list-group-item">
                                <a href="{{ route('admin.we-learn.details.index', ['id' => $wlo->id]) }}" class="" style="text-decoration: none; color:black">{{ $wlo->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-8">
                    
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