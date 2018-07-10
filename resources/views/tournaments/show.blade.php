@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header" style="font-size: 22px;">Tournament Info 
                  @if($tournament->is_live)
                    <span class="badge badge-warning" style="margin-left: 7px;">Live</span>
                  @endif
                </div>

                <div class="card-body">
                    <h4 style="margin-bottom: 18px;"><b>Tournament Fees :</b> &#8377; {{ $tournament->fees }}</h4>
                    <hr style="background: #fff;">
                    <h4 style="margin-bottom: 18px;"><b>First Prize :</b> &#8377; {{ $tournament->first_prize }}</h4>
                    <h4 style="margin-bottom: 18px;"><b>Second Prize :</b> &#8377; {{ $tournament->second_prize }}</h4>
                    <h4 style="margin-bottom: 18px;"><b>Third Prize :</b> &#8377; {{ $tournament->third_prize }}</h4>
                  
                    <br>

                    @if(!auth()->user()->isEnrolled($tournament))
                     <a href="/tournaments/{{$tournament->id}}/join" class="btn btn-primary btn-lg" style="width: 100%;">Join</a>
                    @else
                       <a href="#" class="btn btn-primary btn-lg disabled" style="width: 100%;">Enrolled</a>
                    @endif
                    
                </div>
            </div>
        </div>

        <div class="col-md-8">

          @if(auth()->user()->isEnrolled($tournament))
            <div class="card mb-4">
                <div class="card-header" style="font-size: 22px;">My Matches</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                      <table class="table table-striped">
                    <thead>
                        <tr  style="background: #ccc;color: #000;font-weight: 500;font-size: 17px;">
                            <th>Opponent Name</th>
                            <th>Rating</th>
                            <th>Time</th>
                            <th></th>
                             
                        </tr>
                    </thead>
                  <tbody>

                   @foreach($matches as $match) 
                    <tr style="background: #fff;
    color: #000;
    font-size: 22px;
    font-weight: 700;">
                      <td><a href="/players/{{$match->opponent()->id}}" style="color: #000;">{{ $match->opponent()->name }}</a></td>
                      <td>{{ $match->opponent()->rating }}</td>
                      <td>{{ $match->starttime }}</td>
                      @if($match->starttime <= \Carbon\Carbon::now('Asia/Kolkata'))
                      <td><a href="/matches/{{$match->id}}" class="btn btn-primary">Play</a></td>
                      @endif
                    </tr>
                   @endforeach
                  </tbody>
                </table>

                   
                </div>
            </div>

            @endif
            <div class="card">
                <div class="card-header" style="font-size: 22px;">Members Enrolled</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                      <table class="table table-striped">
                    <thead>
                        <tr  style="background: #ccc;color: #000;font-weight: 500;font-size: 17px;">
                            <th>Name</th>
                            <th>Rating</th>
                             
                        </tr>
                    </thead>
                  <tbody>

                   @foreach($tournament->players as $player) 
                    <tr style="background: #fff;
    color: #000;
    font-size: 22px;
    font-weight: 700;">
                      <td><a href="/players/{{$player->id}}" style="color: #000;">{{ $player->name }}</a></td>
                      <td>{{ $player->rating }}</td>
                       
                    </tr>
                   @endforeach
                  </tbody>
                </table>

                   
                </div>
            </div>
        </div>

        
    </div>
</div>
@endsection
