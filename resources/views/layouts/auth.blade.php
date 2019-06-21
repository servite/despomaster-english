<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">

    <style>
        html, body {
        background-color: #e8e8e8;
        color: #636b6f;
        font-family: 'Raleway', sans-serif;
        height: 100vh;
        margin: 0;
        }

        .full-height {
        height: 100vh;
        }

        .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
        }

        .position-ref {
        position: relative;
        }

        .content {
        text-align: center;
        }

        .links > a {
        color: #605ca8;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
        }
        .goog-te-banner-frame.skiptranslate {
            display: none !important;
        }
        #google_translate_element{
            display: none !important;
        }
        .goog-text-highlight {
            background: transparent !important;
            box-shadow: none !important;
            border: none !important;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div>
            <img style="width: 240px; height: auto;" src="{{ '/assets/img/logo_big.png' }}" alt="Servite GmbH">
        </div>

        @yield('content')

    </div>
</div>
<span id="google_translate_element"></span>
<script>
    
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'de', 
                includedLanguages: 'ar,en,gu,hi,pa,ur,de',       
                autoDisplay: false,
                
            }, 'google_translate_element');

            setTimeout(function () {
                var jObj = $('.goog-te-combo');
                var db = jObj.get(0);
                jObj.val('en');
                fireEvent(db, 'change');
           }, 300);
            
        }
        function fireEvent(element,event){
            $("#goog-gt-tt").remove();
            if (document.createEventObject){
                var evt = document.createEventObject();
                return element.fireEvent('on'+event,evt)
            }else{
                var evt = document.createEvent("HTMLEvents");
                evt.initEvent(event, true, true );
                return !element.dispatchEvent(evt);
            }
        }

    </script>
</body>
</html>
