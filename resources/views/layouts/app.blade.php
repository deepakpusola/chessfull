<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>


    <link rel="stylesheet" href="/css/chessboard.css">

    <script src="/js/sweetalert.min.js"></script>
      <link rel="stylesheet" type="text/css" href="/css/sweetalert.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   <img src="/img/logo.png" style="width: 190px;margin-top: 13px;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-center m-auto">
                        <li style="margin-top: 13px;"><a href=""></a><img src="/img/rupee.png" alt="logos"></li>
                        <li style="" class="text-list"><a href="#" class="text-style">14.3</a></li>

                        <li> <button type="button" class="btn btn-success btn3d" data-toggle="modal" data-target="#addMoney" > Add Cash</button></li>
                    </ul>
                    <ul class="navbar-nav ml-auto" style="margin-top:12px;">
                        <!-- Authentication Links -->

                        @guest
                            <li class="nav-item pull-left">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item pull-left">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown navbar-button">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <button type="button" class="btn btn-success btn3d" data-toggle="modal" data-target="#addMoney" >My Account</button>
                                   <!--  {{ Auth::user()->name }} <span class="caret"></span> -->
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-5 mt-5">
            @yield('content')
        </main>
    </div>


       @if( session('flash_title') && session('flash_message'))
             <script type="text/javascript">
                 swal({
          title: "{{ session('flash_title') }}",
          html: true,
          text: "<span style='color:#0a0a0a;font-weight:400'>{!! session('flash_message') !!}</span>",
          type: "success",
          confirmButtonColor: "#0048bc",
          confirmButtonText: "Cool"
        });
      </script>
     @endif

      @if( session('error_title') && session('error_message'))
             <script type="text/javascript">
                 swal({
          title: "{{ session('error_title') }}",
          html: true,
          text: "<span style='color:#0a0a0a;font-weight:400'>{!! session('error_message') !!}</span>",
          type: "error",
          confirmButtonColor: "#0048bc",
          confirmButtonText: "Ok"
        });
      </script>
     @endif


    <script src="/js/jquery-plugin-collection.js"></script>
    <script src="/js/chessboard.js"></script>
     <script src="/js/chessboardjs-themes.js"></script>
    @yield('scripts')

</body>
</html>
