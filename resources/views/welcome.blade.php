<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Chessfull</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:100,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" type="text/css" href="/css/animate.css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #312e2b;
                background: url('img/back.jpg');
                background-size: cover;
                color: #fff;
                font-family: 'Roboto', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .overlay {
                background-color: rgba(0, 0, 0, 0.4);   
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

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
                font-weight: bold;
                color: #e0ab60;
            }

            .links > a {
                color: #e6912c;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .top-right {
                margin-top: 18px;
            }    

            .top-right.links a {
                background-color: #e6912c;
                border-bottom: 1px solid #ad6d21;
                color: #fff;
                padding: 18px;
                 padding-left: 22px;
                 padding-right: 22px;
            }

            .options {
                margin-top: 85px;
            }   

            .options > a{
                font-size: 20px;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height overlay">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}" style="margin-right: 15px;">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md animated bounceInDown">
                   <img src="/img/logo.png">
                </div>

                <div class="links options animated bounceInLeft">
                    <a href="/play-computer">Play with Computer</a>
                    <a href="/play-friend">Play with Friend</a>
                    <a href="/play-random">Live Game</a>
                    <a href="/tournaments">Tournaments</a>
                </div>
            </div>
        </div>
    </body>
</html>
