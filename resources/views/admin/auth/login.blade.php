<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/v.css') }}" rel="stylesheet">

</head>

<body>
  <div id="app">
    <main class="py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">Giriş</div>

              <div class="card-body">
                <form method="POST" action="{{ route('admin.auth.login') }}">
                  @csrf

                  <div class="mb-3 row">
                    <label for="email" class="col-md-4 col-form-label text-end">
                      {{ __('Kullanıcı Adı') }} :
                    </label>

                    <div class="col-md-6">
                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror @if(Session::has('error')) is-invalid @endif"
                          name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                      @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="password" class="col-md-4 col-form-label text-end">
                      {{ __('Şifre') }} :
                    </label>

                    <div class="col-md-6">
                      <input id="password" type="password"
                          class="form-control @error('password') is-invalid @enderror @if(Session::has('error')) is-invalid @endif" name="password"
                          required autocomplete="current-password">

                      @error('password')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror

                      @if(Session::has('error'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{Session::get('error')}}</strong>
                        </span>
                      @endif

                    </div>
                  </div>

                  <div class="mb-3 row">
                    <div class="col-md-6 offset-md-4">
                      <button type="submit" class="btn btn-primary">
                        {{ __('Giriş Yap') }}
                      </button>

                      @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                      @endif
                    </div>
                  </div>

                  
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

</html>
