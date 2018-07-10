<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class PlayRandomController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index($friendId = null, $gameId = null)
    {
    	if($friendId == null && $gameId == null)
    	{
    		$gameId =  auth()->user()->id * 123;

    		$opponent = User::where('live_status', 1)->where('id', '!=' ,auth()->id())->inRandomOrder()->first();
			
			if($opponent)
			{
				$friendId = $opponent->id * 123;
			} else {
				$friendId = 0;
			}
			
    		auth()->user()->live_status = 1;

    		auth()->user()->save();

			return view('play.random', compact('gameId', 'friendId'));

    	}  else {
    		$player1 = User::find($friendId/123);

    		$player2 = User::find($gameId/123);

    		if($player1 == null || $player2 == null)
    		{
    			
    			return redirect('/play-friend')->with('error', 'Invalid game id! No opponent found.');
    		}

    		$opponent = $player1->id == auth()->id() ? $player2 : $player1;

    		$color = $player1->id == auth()->id() ? 'white' : 'black';

    		

    		$refId = $friendId . '-' . $gameId;

    		$roomId = $friendId . '-' . $gameId;


    		$gameId =  auth()->user()->id * 123;

    		$player1->live_status = 2;
    		$player2->live_status = 2;
    		$player1->save();
    		$player2->save();

    		return view('play.random', compact('opponent', 'color', 'gameId', 'refId', 'friendId', 'roomId'));
    	}
    }


    public function disconnect($friendId, $gameId)
    {

    	$player1 = User::find($friendId/123);

    	$player2 = User::find($gameId/123);

    	auth()->user()->live_status = 0;

    	auth()->user()->save();

    	$opponent = $player1->id == auth()->id() ? $player2 : $player1;

    	$opponent->live_status = 0;
    	$opponent->save();

    	return response(['success'], 200);
    }
}
