<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Tournament;
use App\Models\Match;
use Illuminate\Http\Request;

class TournamentsController extends Controller
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

    public function index()
    {
    	$live = Tournament::where('starttime', '<=', \Carbon\Carbon::now('Asia/Kolkata'))->where('closed', 0)->get();

    	$upcoming = Tournament::where('starttime', '>', \Carbon\Carbon::now('Asia/Kolkata'))->where('closed', 0)->get();

        $closed = Tournament::where('closed', 1)->get();

    	return view('tournaments.index', compact('live', 'upcoming', 'closed'));
    }



    public function show(Tournament $tournament)
    {
        
    	$tournament->is_live = $tournament->starttime <= \Carbon\Carbon::now('Asia/Kolkata') && !$tournament->closed;
    	$matches = $tournament->matches;

        $playerMatches = [];

        foreach ($matches as $key => $match) {
            if($match->player1->id == auth()->id() || $match->player2->id == auth()->id())
            {
                $playerMatches[] = $match;
            }
        }

        $matches = $playerMatches;

        $winners = [];
        if($tournament->closed)
        {
             $winners = \DB::table('tournament_user')->where('tournament_id', $tournament->id)
                     ->orderBy('points', 'DESC')->limit(3)->get();

             foreach ($winners as $key => $winner) {
                         $winner->user =  User::find($winner->user_id);
                     }        
        }
    	
        return view('tournaments.show', compact('tournament', 'matches', 'winners'));
    }

    public function join(Tournament $tournament)
    {
    	$tournament->players()->attach(auth()->user());

    	$number_of_teams = count($tournament->players);
		// Shuffle the teams
		$tournament->players->shuffle();// You get a shuffled array

		$players = $tournament->players->toArray();

		$tournament->matches()->delete();

		if(count($tournament->players) >= 2)
		{

			  $pairs = array_chunk($players, 2);


			  foreach ($pairs as $key => $pair) {
			  	
			  	 if(count($pair) > 1)
			  	 {

			  		  $tournament->matches()->create(['player_1' => $pair[0]['id'], 
			    	                            'player_2' => $pair[1]['id'],
			    	                            'starttime'=> $tournament->starttime]);
			  	 } else {
			  	 	$minutes_to_add = 15;

					$time = new \DateTime($tournament->starttime);
					$time->add(new \DateInterval('PT' . $minutes_to_add . 'M'));

					$stamp = $time->format('Y-m-d H:i');

			  	 	$tournament->matches()->create(['player_1' => $pair[0]['id'], 
			    	                            'player_2' => $players[0]['id'],
			    	                            'starttime'=> $stamp]);
			  	 }
			  	}	
				
			  
			
			
		}

	

    	return redirect('/tournaments/' . $tournament->id);
    }


    public function match(Match $match)
    {
    	$player1 = $match->player1;

    	$player2 = $match->player2;

    	if($player1 == null || $player2 == null)
    	{
    			
    		return redirect('/tournaments/' . $match->tournament_id)->with('error', 'Invalid game! No opponent found.');
    	}

    	$opponent = $player1->id == auth()->id() ? $player2 : $player1;

    	return view('tournaments.match', compact('match', 'opponent'));
    }

    public function play(Match $match)
    {
    	$player1 = $match->player1;

    	$player2 = $match->player2;

    	if($player1 == null || $player2 == null)
    	{
    			
    		return redirect('/tournaments/' . $match->tournament_id)->with('error', 'Invalid game! No opponent found.');
    	}

    	$opponent = $player1->id == auth()->id() ? $player2 : $player1;

    	$color = $player1->id == auth()->id() ? 'white' : 'black';

    	$play = true;	

    	return view('tournaments.match', compact('match', 'play', 'color', 'opponent'));
    }

    public function updateStatus(Match $match, $status)
    {
    	$opponent = $match->player1->id == auth()->id() ? $match->player2 : $match->player1;

    	if($status == 'won')
    	{
    		$match->result = auth()->id();

            //$match->tournament->players()->where('user_id', auth()->id())->pivot->points += 1;
            
            \DB::table('tournament_user')
            ->where('user_id', auth()->id())
            ->increment('points', 1);

            $lost = \DB::table('tournament_user')
            ->where('user_id', $opponent->id)->get();
            if($lost->points > 0)
            {
                \DB::table('tournament_user')
                ->where('user_id', $opponent->id)
                ->decrement('points', 1); 
            } else {

            }

               


    	} elseif($status == 'lose')
    	{
    		$match->result = $opponent->id;

            

    	} else {
    		$match->result = 0;

             \DB::table('tournament_user')
            ->where('user_id', auth()->id())
            ->increment('points', 0.5);

            \DB::table('tournament_user')
            ->where('user_id', $opponent->id)
            ->increment('points', 0.5);    

    	} 

    	$match->save();

    	return response(['success'], 200);
    }
}
