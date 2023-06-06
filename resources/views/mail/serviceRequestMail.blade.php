<head>
    <meta charset="utf-8">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/v.css') }}" rel="stylesheet">
</head>


<body>
    
    <div class="container-fluid text-center my-3 pb-3" style="text-align: center; border-bottom: 2px solid grey;">
        <img width="150" height="150" src="{{ env("APP_URL").'/image/serlab-logo.jpg' }}" alt="">
    </div>

    <div class="container-fluid row px-5 d-flex justify-content-center" style="border-bottom: 2px solid grey;">
        <span class="text-center">
            <h3>Servis Talebi</h3>
        </span>

        <div class="px-5 col-7">

            <span>
                <h4><b>Ad: </b>{{ $mailData['name'] }}</h4>
            </span>
            <span>
                <h4><b>Soyad: </b>{{ $mailData['surname'] }}</h4>
            </span>
            <span>
                <h4><b>Görev: </b>{{ $mailData['task'] }}</h4>
            </span>
            <span>
                <h4><b>Firma Kurum Adı: </b>{{ $mailData['companyName'] }}</h4>
            </span>
            <span>
                <h4><b>Departman: </b>{{ $mailData['department'] }}</h4>
            </span>
            <span>
                <h4><b>Telefon: </b>{{ $mailData['phone'] }}</h4>
            </span>
            <span>
                <h4><b>E-posta: </b>{{ $mailData['mail'] }}</h4>
            </span>
            <span>
                <h4><b>İstenilen Hizmet: </b>{{ $mailData['desiredService'] }}</h4>
            </span>
            <span>
                <h4><b>Hizmet Detayı: </b>{{ $mailData['serviceDetail'] }}</h4>
            </span>
            <span>
                <h4><b>Cihaz Türü: </b>{{ $mailData['deviceType'] }}</h4>
            </span>
            <span>
                <h4><b>Markası: </b>{{ $mailData['brand'] }}</h4>
            </span>
            <span>
                <h4><b>Model Numarası: </b>{{ $mailData['modelNo'] }}</h4>
            </span>
            <span>
                <h4><b>Seri Numarası: </b>{{ $mailData['serialNo'] }}</h4>
            </span>
            <span>
                <h4><b>Cihaz Oluşturan Üniteler: </b>{{ $mailData['description'] }}</h4>
            </span>
            <span>
                <h4><b>Adres: </b>{{ $mailData['address'] }}</h4>
            </span>
            <span>
                <h4><b>Şehir: </b>{{ $mailData['city'] }}</h4>
            </span>
        </div>
    </div>
</body>