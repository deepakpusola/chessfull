var board,
  game = new Chess(),
  statusEl = $('#status'),
  fenEl = $('#fen'),
  pgnEl = $('#pgn');


   // do not pick up pieces if the game is over
    // only pick up pieces for White
    var onDragStart = function(source, piece, position, orientation) {
        var re = playerColor == 'white' ? /^b/ : /^w/
            if (game.game_over() ||
                piece.search(re) !== -1) {
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
            display += sec & 1 ? ' <--' : ' <-';
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
                    window.location.href = "/play-computer";
                   } else {
                    window.location.href = "/home";
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
                    window.location.href = "/play-computer";
                   } else {
                    window.location.href = "/home";
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


// do not pick up pieces if the game is over
// only pick up pieces for the side to move
var onDragStart = function(source, piece, position, orientation) {
  if (game.game_over() === true ||
      (game.turn() === 'w' && piece.search(/^b/) !== -1) ||
      (game.turn() === 'b' && piece.search(/^w/) !== -1)) {
    return false;
  }
};

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

  var moveColor = 'White';
  if (game.turn() === 'b') {
    moveColor = 'Black';
  }

  // checkmate?
  if (game.in_checkmate() === true) {
    status = 'Game over, ' + moveColor + ' is in checkmate.';
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



var cfg = {
        draggable: true,
        /*boardTheme: "symbol_board_theme,*/
        position: 'start',
        pieceTheme: 'https://chessvicky.com/admin/img/chesspieces/wikipedia/{piece}.png',
        onDragStart: onDragStart,
        onDrop: onDrop,
        onSnapEnd: onSnapEnd,
         orientation: 'black',
       
    };


board = ChessBoard('board', cfg);

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

  function handleMove(from, to) {
    firebase.database().ref('games/' + $('#game_id').val()).push({
       from : from,
       to: to,
    });
  }


    var gameRef = firebase.database().ref('games/' + $('#game_id').val());
    gameRef.on('child_added', function(snapshot) {
        
        console.log(snapshot.val());
        
        source = snapshot.val().from;
        
        target = snapshot.val().to;

        game.move({
          from: source,
          to: target,
        });
        
        board.position(game.fen());
    });



playGame = function() {
  var friendId = $('#friendId').val();
  var gameId = $('#gameId').val();
  if(gameId != '')
  {
    window.location = '/play-friend/' + friendId + '/' + gameId;
  } else {

  }
}