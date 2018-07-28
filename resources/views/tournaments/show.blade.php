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

                    @if(!auth()->user()->isEnrolled($tournament) && !$tournament->closed && !$tournament->is_live)
                     <a href="/tournaments/{{$tournament->id}}/join" class="btn btn-primary btn-lg" style="width: 100%;">Join</a>
                    @elseif(auth()->user()->isEnrolled($tournament) && !$tournament->closed)
                       <a href="#" class="btn btn-primary btn-lg disabled" style="width: 100%;">Enrolled</a>
                    @else
                        <a href="#" class="btn btn-danger btn-lg disabled" style="width: 100%;">Closed</a>
                    @endif

                </div>
            </div>
        </div>

        <div class="col-md-8">



            <p class="badge badge-warning" style="font-size: 22px;
            display:{{ $tournament->is_live ? 'block' : 'none' }}">{{ !$tournament->closed ? 'Ends in :' : '' }}<span id="endtimer"></span></p>




          @if(auth()->user()->isEnrolled($tournament) && !$tournament->closed)
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
                      @if($match->result == -1 && $match->starttime <= \Carbon\Carbon::now('Asia/Kolkata'))
                      <td><a href="/matches/{{$match->id}}" class="btn btn-primary">Play</a></td>
                      @else
                        @if($match->result == 0)
                         <td><span class="badge badge-warning">Draw</span></td>
                        @elseif($match->result == auth()->id())
                        <td><span class="badge badge-success">Won</span></td>
                        @elseif($match->result == -1)
                        <td><span class="badge badge-primary">Pending</span></td>
                        @else
                          <td><span class="badge badge-danger">Lost</span></td>
                        @endif
                      @endif
                    </tr>
                   @endforeach
                  </tbody>
                </table>


                </div>
            </div>

            @endif

            @if($tournament->closed)

                <div class="card mb-4">
                <div class="card-header" style="font-size: 22px;">Winners</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                      <table class="table table-striped">
                    <thead>
                        <tr  style="background: #ccc;color: #000;font-weight: 500;font-size: 17px;">
                            <th>Player Name</th>
                            <th>Rating</th>
                            <th>Points</th>


                        </tr>
                    </thead>
                  <tbody>

                   @foreach($winners as $winner)
                    <tr style="background: #fff;
                    color: #000;
                    font-size: 22px;
                    font-weight: 700;">
                      <td><a href="/players/{{$winner->user->id}}" style="color: #000;">{{ $winner->user->name }}</a></td>
                      <td>{{ $winner->user->rating }}</td>
                      <td>{{ $winner->points }}</td>
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
                            <th>Points</th>

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
                      <td>{{ $player->pivot->points }}</td>

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


@section('scripts')


 <script>
// Set the date we're counting down to
var countDownDate = new Date("{{ $tournament->endtime }}").getTime();
var startDownDate = new Date("{{ $tournament->starttime }}").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get todays date and time
  var now = new Date().getTime();

  // Find the distance between now an the count down date
  var distance = countDownDate - now;
  var startDistance = startDownDate - now;

  @if(!$tournament->is_live && !$tournament->closed)
    if(startDistance < 0)
    {
      console.log('refresshing');
      window.location.reload( );
    }
  @endif

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("endtimer").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("endtimer").innerHTML = "EXPIRED";
  }

  @if(!$tournament->closed)
    if(distance < 0)
    {
       window.location.reload();
    }
  @endif
}, 1000);
</script>


@endsection

