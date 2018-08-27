@extends('layouts.app')

@section('content')
@if(!$agent->isMobile())
<div class="container play-game-container">
    <div class="row justify-content-center">


                        <script src="/js/chess.js"></script>

                        <div>

                                               <p class="timer-section computer-timer-section" style="font-weight: bold;font-size: 22px;"><b>Computer</b> <span class="time">(<span class="" id="time1">0:05:00</span>)</span></p>



                                              <div id="board" style="width: 70vh;"></div>


                                                <br>
                                                <p class="timer-section user-timer-section" style="font-weight: bold;font-size: 22px;"><b>{{ Auth::user()->name }}</b> <span class="time">(<span class="" id="time2">0:05:00</span>)</span></p>


                                            <br>



                                            </div>

                                              <i id="source" data-val="0" hidden="true"></i>
                                                <i id="dest" data-val="0" hidden="true"></i>



                </div>
        </div>
        @else

<div class="container-fluid play-game-container-resopnsive" style="display: none;">
  <script src="/js/chess.js"></script>
  <div class="row">
     <div class="col-xs-6">
       <div id="board" style="width: 100vh;">
         </div>
       </div>
         <div class="col-xs-6">
          <p class="timer-section computer-timer-section computer-time-filed" style=""><b>Computer</b> <span class="time">(<span class="" id="time1">0:05:00</span>)</span></p>
            <br>
            <a href="/">
            <div class="board-go-to-home">
              <img src="/img/icon.png" class="go-to-home" alt="user">
              <p>Resign</p>
            </div>
          </a>
             <p class="timer-section user-timer-section" style=""><b>{{ str_limit(Auth::user()->name, 9) }}</b> <span class="time">(<span class="" id="time2">0:05:00</span>)</span></p>
       </div>
       <i id="source" data-val="0" hidden="true"></i>
      <i id="dest" data-val="0" hidden="true"></i>
     </div>
  </div>

@endif
<!-- Modal -->
<div class="modal fade" id="con-close-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form >
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Choose Game Preferences</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="form-group row">
        <label for="timeBase" class="control-label col-xs-4 col-sm-6 col-md-4">Base time (min)</label>
        <div class="col-xs-4 col-sm-6 col-md-4">
          <input type="number" class="form-control" id="timeBase" value="5"></input>
        </div>
      </div>
      <div class="form-group row">
        <label for="timeInc" class="control-label col-xs-4 col-sm-6 col-md-4">Increment (sec)</label>
        <div class="col-xs-4 col-sm-6 col-md-4">
          <input type="number" class="form-control" id="timeInc" value="2"></input>
        </div>
      </div>
      <div class="form-group row">
        <label for="skillLevel" class="control-label col-xs-4 col-sm-6 col-md-4">Skill Level (0-20)</label>
        <div class="col-xs-6 col-sm-6 col-md-4">
          <input type="number" class="form-control" id="skillLevel" value="5"></input>
        </div>
      </div>
      <div class="form-group row">
        <label for="color" class="control-label col-xs-4 col-sm-6 col-md-4">I play</label>
        <div class="col-xs-4 col-sm-6 col-md-4">
          <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-default active" id="color-white"><input type="radio" checked="checked" name="color">White</label>
            <label class="btn btn-inverse" id="color-black"><input type="radio" name="color">Black</label>
          </div>
        </div>
      </div>
      <div class="form-group  row" style="display: none;">
        <label for="showScore" class="control-label col-xs-4 col-sm-6 col-md-4">Show score</label>
        <div class="col-xs-4 col-sm-6 col-md-4 hidden">
          <input type="checkbox" class="form-control" id="showScore" checked></input>
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="newGame()" data-dismiss="modal" class="btn btn-primary">Start Playing</button>
      </div>
    </div>
    </form>
  </div>
</div>





@endsection


@section('scripts')

    <script src="/js/enginegame.js"></script>
    <script src="/js/smartgame.js"></script>

    <script type="text/javascript">
      $('.myLink').on('click', function(e) {
         e.preventDefault();
        var move = $(this).data('move');
        goToMove(move);
    });
    </script>

    <script type="text/javascript">
      $("#con-close-modal").modal()
    </script>

@stop
