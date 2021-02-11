<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/scripts.js') }}" defer></script>
    <script src="{{ asset('js/JQueryForm.js') }}" defer></script>


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-160442615-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-160442615-1');
    </script>


      <!-- unite-gallery -->
		<script src='{{asset("unitegallery/js/unitegallery.min.js")}}' defer></script> 
		<link rel='stylesheet' href='{{asset("unitegallery/css/unite-gallery.css")}}'> 
    <script src='{{asset("unitegallery/themes/tiles/ug-theme-tiles.js")}}' defer></script>
		<link rel='stylesheet' href='{{asset("unitegallery/themes/default/ug-theme-default.css")}}'> 

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito">

      <!-- Bootstrap para o Spinner --> 

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


    <link rel='shortcut icon' href='favicon.ico' type='image/x-icon' />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilo.css') }}" rel="stylesheet">

</head>
<body>
  <div class="fadeIn">
    <div class="top">
      <div class="container-fluid text-center">
        <div class="row">
            <div class="col-xs-12 col-md-4">
            <a href="/"><h2 id="titulo">David Peixoto</h2></a>
            </div>
            <div class="col-xs-0 col-md-5"></div>
            <div class="col-xs-12 col-md-1 lang text-center">
            <a id="linkLang" href="{{url(trans('conteudo.link-change')."/lang")}}">@lang('conteudo.idioma')</a>
            </div>
            <div class="col-xs-12 col-md-1 text-center">
              <a href="https://www.instagram.com/peixoto_fotografo/" target="_blank"><img id="instagramImg" src="{{asset('/imgs/instagram.png')}}"></a>            
            </div>
            <div class="col-xs-0 col-md-1"></div>
        </div>   
      </div>          
    </div>
    <section class="slideSection">
      @yield('slide')
    </section>
    <section class="sobreSection">
      @yield('sobre')
    </section>
    <section class="albunsSection">
      @yield('albuns')
    </section>
    <section class="contatoSection">
      @yield('contato')
    </section>
    <section class="albumSection">
      @yield('album')
    </section>
    <section class="footerSection">
      @yield('footer')
    </section>
  </div>
</body>
</html>
