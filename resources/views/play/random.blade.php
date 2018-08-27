@extends('layouts.app')

@section('content')
@if(!$agent->isMobile())
<div class="container">
    <div class="row justify-content-center">
        <div>
            <script src="/js/chess.js"></script>
            <p class="timer-section" style="font-weight: bold;font-size: 22px;"><b>{{ isset($opponent) ? $opponent->name  : 'Waiting For Opponent' }}</b> <span class="time">(<span class="" id="time1">0:05:00</span>)</span></p>
            <div id="board" style="width: 70vh;"></div>
            <br>
            <p class="timer-section" style="font-weight: bold;font-size: 22px;"><b>{{ Auth::user()->name }}</b> <span class="time">(<span class="" id="time2">0:05:00</span>)</span></p>
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
          <p class="timer-section computer-timer-section" style=""><b>{{ isset($opponent) ? str_limit($opponent->name, 9)  : 'Waiting..' }}</b> <span class="time">(<span class="" id="time1">0:05:00</span>)</span></p>
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
        <h5 class="modal-title" id="exampleModalLabel">Live Chess</h5>

      </div>
      <div class="modal-body">
         @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

          <div class="loader"></div>

       <h3 class="text-center"><b>Finding an opponent...</b></h3>

      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-secondary" href="/">Cancel</a>

      </div>
    </div>
    </form>
  </div>
</div>





@endsection


@section('scripts')




    <script src="https://www.gstatic.com/firebasejs/5.0.4/firebase.js"></script>


    <script type="text/javascript">
      $('.myLink').on('click', function(e) {
         e.preventDefault();
        var move = $(this).data('move');
        goToMove(move);
    });
    </script>

    @if(!isset($opponent))
    <script type="text/javascript">
      $("#con-close-modal").modal({backdrop: 'static',
    keyboard: false})
    </script>
    @else

    <script type="text/javascript">
     var board,
  game = new Chess(),
  statusEl = $('#status'),
  fenEl = $('#fen'),
  pgnEl = $('#pgn');


  var time = { wtime: 300000, btime: 300000, winc: 2000, binc: 2000 };
   var clockTimeoutID = null;
    var timeOver = false;

    var playerColor = '{{ $color }}';


   // do not pick up pieces if the game is over
    // only pick up pieces for White
    var onDragStart = function(source, piece, position, orientation) {
        var turn = '{{ $color == 'white' ? 'w' : 'b' }}';

            if (game.game_over() ||
                game.turn() != turn) {
                return false;
            }
    };




    function displayClock(color, t) {
        var isRunning = false;
        if(time.startTime > 0 && color == time.clockColor) {
            t = Math.max(0, t + time.startTime - Date.now());
            isRunning = true;
        }
        var id = color == playerColor ? '#time2' : '#time1';
        var sec = Math.ceil(t / 1000);
        var min = Math.floor(sec / 60);
        sec -= min * 60;
        var hours = Math.floor(min / 60);
        min -= hours * 60;
        var display = hours + ':' + ('0' + min).slice(-2) + ':' + ('0' + sec).slice(-2);
        if(isRunning) {
            display += sec & 1 ? ' *' : ' *';
        }
        $(id).text(display);
    }

    function updateClock() {
        displayClock('white', time.wtime);
        displayClock('black', time.btime);
    }

    function clockTick() {

          var t = (time.clockColor == 'white' ? time.wtime : time.btime) + time.startTime - Date.now();
          console.log(t);
         if(t <= 0 && time.clockColor == 'white')
            {
                timeOver = true;
                 swal({
                  title: "Oops!",
                  html: true,
                  text: "<span style='color:#0a0a0a;font-weight:400'>White ran out of time!</span>",
                  type: "error",
                  confirmButtonColor: "#0048bc",
                  confirmButtonText: "Play Again!",
                  closeOnConfirm: true,
                },
                function(isConfirm){
                   if(isConfirm) {
                    window.location.href = "/play-random";
                   } else {
                    window.location.href = "/";
                   }
                });
            } else if(t <= 0 && time.clockColor == 'black') {
                timeOver = true;
                swal({
                  title: "Oops!",
                  html: true,
                  text: "<span style='color:#0a0a0a;font-weight:400'>Black ran out of time!</span>",
                  type: "error",
                  confirmButtonColor: "#0048bc",
                  confirmButtonText: "Play Again!",
                  closeOnConfirm: true,
                },
                function(isConfirm){
                   if(isConfirm) {
                    window.location.href = "/play-random";
                   } else {
                    window.location.href = "/";
                   }
                });
            } else {
                 updateClock();
        var t = (time.clockColor == 'white' ? time.wtime : time.btime) + time.startTime - Date.now();
        var timeToNextSecond = (t % 1000) + 1;
        clockTimeoutID = setTimeout(clockTick, timeToNextSecond);
       }
    }

    function stopClock() {
        if(clockTimeoutID !== null) {
            clearTimeout(clockTimeoutID);
            clockTimeoutID = null;
        }
        if(time.startTime > 0) {
            var elapsed = Date.now() - time.startTime;
            time.startTime = null;
            if(time.clockColor == 'white') {
                time.wtime = Math.max(0, time.wtime - elapsed);

            } else {
                time.btime = Math.max(0, time.btime - elapsed);
            }
        }
    }

    function startClock() {
        if(game.turn() == 'w') {

            time.wtime += time.winc;
            time.clockColor = 'white';
        } else {
            time.btime += time.binc;
            time.clockColor = 'black';
        }
        time.startTime = Date.now();

        clockTick();
    }

          //used for clickable moves in gametext
    //not used for buttons for efficiency
    function goToMove(ply) {
         /*gameHistory = game.history({verbose: true});
      if (ply > gameHistory.length - 1)
          {
            ply = gameHistory.length - 1;
        }
      game.reset();
      for (var i = 0; i <= ply; i++) {
        game.move(gameHistory[i].san);
      }
      currentPly = i - 1;
      board.position(game.fen());*/
      alert("Hello");
      return false;
    }




    var onChange = function onChange() { //fires when the board position changes
      //highlight the current move
      $("[class^='gameMove']").removeClass('highlight');
      $('.gameMove' + currentPly).addClass('highlight');
    }


    function updatePgn()
    {
        var h = game.header();
        var gameHeaderText = '<h4>' + h.White + ' (' + h.WhiteElo + ') - ' + h.Black + ' (' + h.BlackElo + ')</h4>';
        gameHeaderText += '<h5>' + h.Event + ', ' + h.Site + ' ' + h.EventDate + '</h5>';
        var pgn = game.pgn();
        var gameMoves = pgn.replace(/\[(.*?)\]/gm, '').replace(h.Result, '').trim();

          //format the moves so each one is individually identified, so it can be highlighted
          moveArray = gameMoves.split(/([0-9]+\.\s)/).filter(function(n) {return n;});
          for (var i = 0, l = moveArray.length; i < l; ++i) {
            var s = $.trim(moveArray[i]);
            if (!/^[0-9]+\.$/.test(s)) { //move numbers
              m = s.split(/\s+/);
              for (var j = 0, ll = m.length; j < ll; ++j) {
                m[j] = '<span class="gameMove' + (i + j - 1) + '"><a class="myLink move" data-move="' + (i + j - 1) + '" >' + m[j] + '</a></span>';
              }
              s = m.join(' ');
            }
            moveArray[i] = s;
          }
          $("#game-data").html('<div class="gameMoves">' + moveArray.join(' ') + ' <span class="gameResult">'  + '</span></div>');

          var moveColor = 'White';
        if (game.turn() === 'b') {
          moveColor = 'Black';
        }

        // checkmate?
        if (game.in_checkmate() === true) {
          status = 'chess over, ' + moveColor + ' is in checkmate.';

        }

        // draw?
        else if (game.in_draw() === true) {
          status = 'chess over, drawn position';
        }

        // chess still on
        else {
          status = moveColor + ' to move';

          // check?
          if (game.in_check() === true) {
            status += ', ' + moveColor + ' is in check';
          }
        }

        statusEl.html(status);
    }


    function prepareMove() {
        stopClock();
         startClock();
        updatePgn();
        board.position(game.fen());
        updateClock();
        var turn = game.turn() == 'w' ? 'white' : 'black';
        if(!game.game_over() && !timeOver) {
            if(turn != playerColor) {

            }
            if(game.history().length >= 2 && !time.depth && !time.nodes) {
                startClock();
            }
        } else if(playerColor == turn) {

            var dataString = 'operation=decrement' + '&points='+150;

              $.ajax({
              type: "POST",
              url: '/user/game/stats/',
              data: dataString,
              cache: false,
              beforeSend: function(request){ return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));},
              success: function(html, window)
              {
                  console.log("LOST");


              }
              });

              swal({
                  title: "Check And Mate!",
                  html: true,
                  text: "<span style='color:#0a0a0a;font-weight:400'>You lose the game and lost <b>150</b> skillometer points!</span>",
                  type: "error",
                  showCancelButton: true,
                  confirmButtonColor: "#0048bc",
                  confirmButtonText: "Play Again!",
                  cancelButtonText: "Go Home!",
                  closeOnConfirm: false,
                  closeOnCancel: false,
                },
                function(isConfirm){
                   if(isConfirm) {
                    window.location.href = "/play-computer";
                   } else {
                    window.location.href = "/home";
                   }
                });
        } else {
          var dataString = 'operation=increment' + '&points='+250;

              $.ajax({
              type: "POST",
              url: '/user/game/stats/',
              data: dataString,
              cache: false,
              beforeSend: function(request){ return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));},
              success: function(html, window)
              {

              }
              });

              swal({
                  title: "You Win!",
                  html: true,
                  text: "<span style='color:#0a0a0a;font-weight:400'>You win the game and gain <b>250</b> skillometer points!</span>",
                  type: "success",
                  showCancelButton: true,
                  confirmButtonColor: "#0048bc",
                  confirmButtonText: "Play Again!",
                  cancelButtonText: "Go Home!",
                  closeOnConfirm: false,
                  closeOnCancel: false,
                },
                function(isConfirm){
                    if(isConfirm) {
                    window.location.href = "/play-computer";
                   } else {
                    window.location.href = "/home";
                   }
                });


        }
    }




var onDrop = function(source, target) {
  // see if the move is legal
  var move = game.move({
    from: source,
    to: target,
    promotion: 'q' // NOTE: always promote to a queen for example simplicity
  });

  // illegal move
  if (move === null) return 'snapback';

  handleMove(source, target);

  updateStatus();
};

// update the board position after the piece snap
// for castling, en passant, pawn promotion
var onSnapEnd = function() {
  board.position(game.fen());
};

var updateStatus = function() {
  var status = '';

  var moveColor = 'white';
  if (game.turn() === 'b') {
    moveColor = 'black';
  }

  // checkmate?
  if (game.in_checkmate() === true) {
    status = 'Game over, ' + moveColor + ' is in checkmate.';

    if(moveColor != '{{ $color }}')
    {
    var dataString = 'operation=increment' + '&points='+250;

              $.ajax({
              type: "POST",
              url: '/user/game/stats/',
              data: dataString,
              cache: false,
              beforeSend: function(request){ return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));},
              success: function(html, window)
              {

              }
              });

              swal({
                  title: "You Win!",
                  html: true,
                  text: "<span style='color:#0a0a0a;font-weight:400'>You win the game and gain <b>250</b> skillometer points!</span>",
                  type: "success",
                  showCancelButton: true,
                  confirmButtonColor: "#0048bc",
                  confirmButtonText: "Play Again!",
                  cancelButtonText: "Go Home!",
                  closeOnConfirm: false,
                  closeOnCancel: false,
                },
                function(isConfirm){
                    if(isConfirm) {
                    window.location.href = "/play-random";
                   } else {
                    window.location.href = "/home";
                   }
                });
    } else {
        var dataString = 'operation=decrement' + '&points='+150;

              $.ajax({
              type: "POST",
              url: '/user/game/stats/',
              data: dataString,
              cache: false,
              beforeSend: function(request){ return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));},
              success: function(html, window)
              {
                  console.log("LOST");


              }
              });

              swal({
                  title: "Check And Mate!",
                  html: true,
                  text: "<span style='color:#0a0a0a;font-weight:400'>You lose the game and lost <b>150</b> skillometer points!</span>",
                  type: "error",
                  showCancelButton: true,
                  confirmButtonColor: "#0048bc",
                  confirmButtonText: "Play Again!",
                  cancelButtonText: "Go Home!",
                  closeOnConfirm: false,
                  closeOnCancel: false,
                },
                function(isConfirm){
                   if(isConfirm) {
                    window.location.href = "/play-random";
                   } else {
                    window.location.href = "/home";
                   }
                });
    }
  }

  // draw?
  else if (game.in_draw() === true) {
    status = 'Game over, drawn position';
  }

  // game still on
  else {
    status = moveColor + ' to move';

    // check?
    if (game.in_check() === true) {
      status += ', ' + moveColor + ' is in check';
    }
  }

  statusEl.html(status);
  fenEl.html(game.fen());
  pgnEl.html(game.pgn());

};


var playAudio = function() {
    var audio = new Audio('/audio/mov.wav');
    audio.play();
};


var cfg = {
        draggable: false,
        /*boardTheme: "symbol_board_theme,*/
        position: 'start',
        pieceTheme: 'https://chessvicky.com/admin/img/chesspieces/wikipedia/{piece}.png',
        onDragStart: onDragStart,
        onDrop: onDrop,
        onSnapEnd: onSnapEnd,
         orientation: '{{ $color }}',

    };


board = ChessBoard('board', cfg);

function clickOnSquare(evt) {

  stopClock()

   if (game.game_over() ) {
                return false;
            }
    var turn = game.turn() == 'w' ? 'white' : 'black';
    if(turn == '{{ $color }}')
   {
            var square = $(this).data("square");
             var squareEl = $('#board .square-' + square);

               $('#board .square-55d63').css('background', '');
                 // highlight the square they clicked over
            var background = '#a9a9a9';
            if (squareEl.hasClass('black-3c85d') === true) {
              background = '#696969';
            }

              squareEl.css('background', background);


              var source = $('#source').data('val');

              if(source == 0)
              {
                $('#source').data('val', square);

              } else {


                  var destination = square;

               console.log(source+destination);


            var move = game.move({
              from: source.toString(),
              to: destination.toString(),
              promotion: 'q' // NOTE: always promote to a queen for example simplicity
            });


            // illegal move
            if (move != null) {
               board.position(game.fen());
                playAudio();
               squareEl.css('background', background);
                  var background = '#a9a9a9';
                    if ($('#board .square-' + source).hasClass('black-3c85d') === true) {
                      background = '#696969';
                    }
                     $('#board .square-' + source).css('background', background);

               handleMove(source, destination);
                updateClock();
               // startClock();
                updatePgn();
                updateStatus();


            } else {


                  $('#board .square-55d63').css('background', '');
                 }

                  $('#source').data('val', 0);

              }



            updateStatus();

            console.log("You clicked on square: " + square);
      }
}

$("#board").on("click", ".square-55d63", clickOnSquare);

updateStatus();

  // Initialize Firebase
  // TODO: Replace with your project's customized code snippet
  var config = {
    apiKey: "AIzaSyBl2wpX0f-Rl0aCMcD2kJceLWlm9P7JqHM",
    authDomain: "chessfull-f48d6.firebaseapp.com",
    databaseURL: "https://chessfull-f48d6.firebaseio.com/",
    projectId: "chessfull-f48d6",
    };
  firebase.initializeApp(config);

  var database = firebase.database();

   var $refId = {{ $refId }};

   var gameRef = firebase.database().ref('games/' + $refId + '/moves');
   gameRef.set(null);

  function handleMove(from, to) {
    firebase.database().ref('games/' + $refId + '/moves').push({
       from : from,
       to: to,
    });

    updateStatus();
  }



  window.onbeforeunload = function (e) {

     $.ajax({
              type: "POST",
              url: '/play-random/disconnect/{{$friendId}}/{{$gameId}}',
              data: '',
              cache: false,
              beforeSend: function(request){ return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));},
              success: function(html, window)
              {
                     console.log('disconnected');
              }
              });

      console.log('triggered');
      var $refId = {{ $roomId }};
      var gameRef = firebase.database().ref('random-start/' + '{{ $roomId }}' );
      gameRef.set(null);
      var gameRef = firebase.database().ref('random-opponent/' + {{$friendId }} );
      gameRef.set(null);

      var gameRef = firebase.database().ref('random-opponent/' + {{ $gameId }} );
      gameRef.set(null);
    };




    var gameStartRef = firebase.database().ref('random-start/' + '{{ $roomId }}');
        gameStartRef.on('value', function(snapshot){
         var val = snapshot.val();

         if(val == null)
         {
            window.location = '/play-random';
         }
    });


    var gameRef = firebase.database().ref('games/' + $refId + '/moves');
    gameRef.on('child_added', function(snapshot) {

        stopClock();

        console.log(snapshot.val());

        source = snapshot.val().from;

        target = snapshot.val().to;

        var move = game.move({
          from: source,
          to: target,
        });



        board.position(game.fen());

         $('#board .square-55d63').css('background', '');

                var background = '#a9a9a9';
              if ($('#board .square-' + target).hasClass('black-3c85d') === true) {
                background = '#696969';
              }
               $('#board .square-' + target).css('background', background);

               var background = '#a9a9a9';
              if ($('#board .square-' + source).hasClass('black-3c85d') === true) {
                background = '#696969';
              }
               $('#board .square-' + source).css('background', background);
                playAudio();

                updateClock();

         startClock();

         updatePgn();

        updateStatus();
    });






    </script>

    @endif


    <script type="text/javascript">


      @if(!isset($opponent))
       // Initialize Firebase
  // TODO: Replace with your project's customized code snippet
  var config = {
    apiKey: "AIzaSyBl2wpX0f-Rl0aCMcD2kJceLWlm9P7JqHM",
    authDomain: "chessfull-f48d6.firebaseapp.com",
    databaseURL: "https://chessfull-f48d6.firebaseio.com/",
    projectId: "chessfull-f48d6",
    };
  firebase.initializeApp(config);

  var database = firebase.database();

    var gameStartRef = firebase.database().ref('random-opponent/' + {{ auth()->id() * 123 }});
        gameStartRef.on('value', function(snapshot){
           var val = snapshot.val();

         if(val != null)
         {
            var fId = {{ auth()->id() * 123 }};
            var gId = val;

            var friendId = Math.max(fId, gId);
            var gameId = Math.min(fId, gId);

            var refId = friendId + '-' + gameId;

            var gameRef = firebase.database().ref('games/' + refId);
            gameRef.set(null);

            window.location = '/play-random/' + friendId + '/' + gameId;
         }
    });


  setTimeout(function(){
    console.log('connecting..');
    var fId = {{ $friendId  }};
    var gId = {{ $gameId }};



      if(fId != 0)
      {

          var aid = {{ auth()->id() * 123 }};

    var friendId = Math.max(fId, gId);
    var gameId = Math.min(fId, gId);

    var refId = friendId + '-' + gameId;

    var opponentId =  aid ==  friendId ? gameId : friendId;

    console.log(friendId);

        var gameRef = firebase.database().ref('games/' + refId);
        gameRef.set(null);

        var gameStartRef = firebase.database().ref('random-start/' + refId );
        gameStartRef.set(gameId);

        var gameStartRef = firebase.database().ref('random-opponent/' + opponentId );
        gameStartRef.set(aid);

        window.location = '/play-random/' + friendId + '/' + gameId;

      } else {

      }
  }, 3000 );



  @endif





      playGame = function() {
  var friendId = $('#friendId').val();
  var gameId = $('#gameId').val();

  var refId = friendId + '-' + gameId;

  console.log(friendId);

  if(gameId != '')
  {
    var gameRef = firebase.database().ref('games/' + refId);
    gameRef.set(null);
    var gameStartRef = firebase.database().ref('random-start/' + friendId );
    gameStartRef.set(gameId);
    window.location = '/play-random/' + friendId + '/' + gameId;
  } else {

  }
}



    </script>



@stop
