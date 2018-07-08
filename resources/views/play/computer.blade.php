@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Play with Computer <a href="#"  data-toggle="modal" style="margin: 4px;" data-target="#con-close-modal" class="btn btn-social">
                                      <i class="fa fa-refresh"></i> Start New Game
                                   </a></div>

                <div class="card-body">
                    <div class="row">
                        <script src="/js/chess.js"></script>

                                            <div class="col-sm-8" style="padding: 14px;">

                                               <p><b>Computer</b> (<span class="text-primary" id="time1">0:05:00</span>)</p>
                                                <br>
                                                
                                              <div id="board" style="width: 100%;"></div> 

                                               
                                                <br>
                                                <p><b>{{ Auth::user()->name }}</b> (<span class=" text-primary" id="time2">0:05:00</span>)</p>
       

                                            <br>

                                            </div>

                                            <div class="col-sm-4" id="puzzle-detail">

                                            <h3>Moves:</h3>
                                            <div id="game-data">
                                              </div>
                                            <hr>
                                            <p style="color: #000;font-weight: bold;"><strong>Status: </strong><span id="status"></span></p>
                                            
                                            <hr>                        
                                            <p>
                                             
                                              <i id="source" data-val="0" hidden="true"></i>
                                                <i id="dest" data-val="0" hidden="true"></i>
                                                

                                                
                                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
       <div class="form-group">
        <label for="timeBase" class="control-label col-xs-4 col-sm-6 col-md-4">Base time (min)</label>
        <div class="col-xs-4 col-sm-6 col-md-4">
          <input type="number" class="form-control" id="timeBase" value="5"></input>
        </div>
      </div>
      <div class="form-group">
        <label for="timeInc" class="control-label col-xs-4 col-sm-6 col-md-4">Increment (sec)</label>
        <div class="col-xs-4 col-sm-6 col-md-4">
          <input type="number" class="form-control" id="timeInc" value="2"></input>
        </div>
      </div>
      <div class="form-group">
        <label for="skillLevel" class="control-label col-xs-4 col-sm-6 col-md-4">Skill Level (0-20)</label>
        <div class="col-xs-6 col-sm-6 col-md-4">
          <input type="number" class="form-control" id="skillLevel" value="5"></input>
        </div>
      </div>
      <div class="form-group">
        <label for="color" class="control-label col-xs-4 col-sm-6 col-md-4">I play</label>
        <div class="col-xs-4 col-sm-6 col-md-4">
          <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-default active" id="color-white"><input type="radio" checked="checked" name="color">White</label>
            <label class="btn btn-inverse" id="color-black"><input type="radio" name="color">Black</label>
          </div>
        </div>
      </div>
      <div class="form-group hidden">
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
