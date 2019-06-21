<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('/css/all.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">

    <style>
        [v-cloak] {display: none;}
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

<body class="skin-purple sidebar-mini">
    <div id="app" class="wrapper" v-cloak>

        <header class="main-header">
            <a href="{{ url('/dashboard') }}" class="logo">
                <span class="logo-mini"></span>
                <span class="logo-lg"><b>DispoM@ster</b></span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <message></message>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-gears"></i><span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li {{ set_active('settings/account*') }}><a href="{{ url('/settings/account/credentials') }}">Konto</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i></a>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>

        @include('layouts.partials.client.sidebar')

        <div class="content-wrapper">
            <section class="content" style="overflow: hidden;">

                @yield('content')

            </section>

        </div>

        <footer class="main-footer">
            <strong>© Servite GmbH - 2019</strong>
        </footer>


        <flash message="{{ session('message') }}" level="{{ session('level') }}"></flash>
        <modal></modal>

    </div>


    <script>

        if (Boolean(localStorage.getItem('sidebar-collapsed'))) {
            document.body.className += ' sidebar-collapse';
        }

    </script>

    <script src="{{ asset('/js/clients.js') }}"></script>

    <script>
        $(document).ready(function () {

            $('.sidebar-toggle').click(() => {
                if (Boolean(localStorage.getItem('sidebar-collapsed'))) {
                    localStorage.setItem('sidebar-collapsed', '');
                } else {
                    localStorage.setItem('sidebar-collapsed', '1');
                }
            });
        });
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
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script type="text/javascript">
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

    @yield('scripts')
</body>

</html>
