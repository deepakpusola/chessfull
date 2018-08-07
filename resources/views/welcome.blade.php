@extends('layouts.app')


@section('content')
    <div class="container chess-type">
        <div class="row text-center">
           <div class="col-md-4 col-sm-4  col-xs-12 text-center">
                <a href="/play-random"><img src="/img/game1.png" alt="pictures"></a>
                <a href="/play-random"><h3>Free games</h3></a>
           </div>
           <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                <a href="/tournaments"><img src="/img/tournment 2.png" alt="pictures"></a>
                <a href="/tournaments"><h3>Tournaments</h3></a>
           </div>
           <div class="col-md-4 col-sm-4 col-xs-4 text-center">
                <a href="/play-computer"><img src="/img/project.png" alt="pictures"></a>
                <a href="/play-computer"><h3>Practice</h3></a>
           </div>
        </div>
    </div>


@endsection