@extends('layouts.master')

@section('content')

<body>

    <div class="row mt-3">
      <div class="row d-flex justify-content-center mt-3">
        <div class="col-8 text-end">
            
            {!! $data->contents !!}

        </div>
      </div>
    </div>

</body>


@endsection
