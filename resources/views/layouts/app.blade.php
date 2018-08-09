<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="/img/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="/img/favicon-16x16.png" sizes="16x16" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

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

       @if(!request()->is('play-*'))
        <nav class="navbar navbar-expand-md navbar-dark navbar-laravel">
            <div class="container">
                <a class="navbar-brand-logo-visible" href="{{ url('/') }}">
                   <img src="/img/logo.png" style="width: 190px;margin-top: 13px;">
                </a>
                <a class="navbar-brand-logo-hide" href="{{ url('/') }}">
                   <img src="/img/crown.png">
                </a>
               <!--  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button> -->

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    @auth
                    <ul class="nav navbar-nav navbar-center navbar-add-cash-responsive" style="display: inline-block;">
                        <li class="logo-nav" style="margin-top: 13px;display: inline-block;"><a href=""></a><img src="/img/rupee.png" alt="logos"></li>
                        <li style="display: inline-block;" class="text-list"><a href="#" class="text-style">{{ auth()->user()->wallet_balance }}</a></li>

                        <li style="display: inline-block;"> <button type="button" class="btn btn-success btn3d" data-toggle="modal" data-target="#addMoney" > Add Cash</button></li>
                    </ul>
                    @endauth
                    <ul class="navbar-nav ml-auto login-navbar" style="margin-top:12px;">
                        <!-- Authentication Links -->

                        @guest
                            <li class="nav-item pull-left login-register">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item pull-left">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <!-- <li class="nav-item  navbar-button">
                                <a id="navbarDropdown" class="nav-link" href="/profile" role="button"  aria-haspopup="true" aria-expanded="false" v-pre>
                                    <button type="button" class="btn  btn3d" >My Profile</button> -->
                                   <!--  {{ Auth::user()->name }} <span class="caret"></span> -->
                                <!-- </a>
                            </li> -->
                            <li class="navbar-button register-button-section" style="display: inline-block;">
                                <a class="nav-link" href="/profile" >
                                    <!-- <button type="button" class="btn btn3d">My Profile</button> -->
                                    <img src="/img/man.png" alt="user">
                                   <!--  {{ Auth::user()->name }} <span class="caret"></span> -->
                                </a>
                                <li class="user-logout-section">
                                <a class="nav-link" href="{{ route('logout') }}"   onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();" id="settings"><i class="fa fa-sign-out"></i></a>
                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                          </form>
                        </li>

                                <!-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div> -->
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
       @endif

        <main class="py-5 mt-5">
            @yield('content')
        </main>
    </div>


    <div class="modal fade" id="addMoney" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form method="POST" action="/wallet/add">
             @csrf
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Cash</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <h3>Enter amount to add</h3>

                <input type="number" name="amount" class="form-control">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Continue</button>
              </div>
        </form>
    </div>
  </div>
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
