<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class PlayFriendController extends Controller
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
    	if(isset($friendId) && isset($gameId))
    	{
    		$player1 = User::find($friendId/123);

    		$player2 = User::find($gameId/123);

    		if($player1 == null || $player2 == null)
    		{
    			
    			return redirect('/play-friend')->with('error', 'Invalid game id! No opponent found.');
    		}

    		$opponent = $player1->id == auth()->id() ? $player2 : $player1;

    		$color = $player1->id == auth()->id() ? 'white' : 'black';

    		

    		$refId = $friendId . '-' . $gameId;


    		$gameId =  auth()->user()->id * 123;

    		return view('play.friend', compact('opponent', 'color', 'gameId', 'refId', 'friendId'));

    	}
    	$gameId =  auth()->user()->id * 123;
    	return view('play.friend', compact('gameId'));
    }
}
