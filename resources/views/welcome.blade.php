@extends('layouts.app')


@section('content')
    <div class="container chess-type">
        <div class="row text-center">
           <div class="col-md-4 col-sm-12 col-xs-4 text-center">
                <a href="#"><img src="/img/group.png" alt="pictures"></a>
                <a href="/play-random"><h3>Free games</h3></a>
           </div>
           <div class="col-md-4 col-sm-12 col-xs-4 text-center">
                <a href="#"><img src="/img/crown3.png" alt="pictures"></a>
                <a href="/tournaments"><h3>Tournaments</h3></a>
           </div>
           <div class="col-md-4 col-sm-12 col-xs-4 text-center">
                <a href="#"><img src="/img/rook.png" alt="pictures"></a>
                <a href="/play-computer"><h3>Practice</h3></a>
           </div>
        </div>
    </div>


@endsection