<?php

namespace App\Http\Controllers;

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
    	$live = Tournament::where('starttime', '<=', \Carbon\Carbon::now('Asia/Kolkata'))->get();

    	$upcoming = Tournament::where('starttime', '>', \Carbon\Carbon::now('Asia/Kolkata'))->get();

    	return view('tournaments.index', compact('live', 'upcoming'));
    }



    public function show(Tournament $tournament)
    {
    	$tournament->is_live = $tournament->starttime <= \Carbon\Carbon::now('Asia/Kolkata');
    	$matches = $tournament->matches()->where('player_1', auth()->id())->orWhere('player_2', auth()->id())->get();
    	return view('tournaments.show', compact('tournament', 'matches'));
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
    	return view('tournaments.match', compact('match'));
    }
}
