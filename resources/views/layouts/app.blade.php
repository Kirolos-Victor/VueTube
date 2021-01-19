<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Main CSS -->
   <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <!--Site -->
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- bootstrap -->
    <link href="{{asset("assets/site/css/bootstrap.min.css")}}" rel='stylesheet' type='text/css' media="all" />
    <!-- //bootstrap -->
    <link href="{{asset("assets/site/css/dashboard.css")}}" rel="stylesheet">
    <!--Font Awesome -->

    <link href="{{asset("assets/site/css/all.css")}}" rel="stylesheet">


    <!-- Custom Theme files -->
    <link href="{{asset("assets/site/css/style.css")}}" rel='stylesheet' type='text/css' media="all" />
    <!-- My Custom CSS File -->
    <link href="{{asset("assets/site/css/customized.css")}}" rel='stylesheet' type='text/css' media="all" />
  @yield('styles')
</head>
<body>
<div id="app">

@include('web.includes.header')
@include('web.includes.sidebar')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" >
        @yield('content')
        @include('web.includes.footer')
    </div>
</div>
<div class="clearfix"> </div>
<div class="drop-menu">
    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu4">
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Regular link</a></li>
        <li role="presentation" class="disabled"><a role="menuitem" tabindex="-1" href="#">Disabled link</a></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another link</a></li>
    </ul>
</div>
<!--Auth user in vue components -->
<script>
    window.AuthUser='{!! Auth()->user() !!}'
    window.__auth= function (){
        try{
            return JSON.parse(AuthUser)
        }catch (error){
            return null
        }
    }
</script>
<!-- Main Scripts Vuejs included -->
<script src="{{ asset('js/app.js') }}" defer></script>
@yield('scripts')
</body>
</html>
