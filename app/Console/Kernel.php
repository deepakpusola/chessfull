<?php

namespace App\Console;

use App\Models\Tournament;
use App\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->call(function () {
            $live = Tournament::where('starttime', '<=', \Carbon\Carbon::now('Asia/Kolkata'))->get();
            foreach ($live as $key => $tournament) {

                if($tournament->endtime <= \Carbon\Carbon::now('Asia/Kolkata'))
                {
                      $tournament->closed = 1;

                      $winners = \DB::table('tournament_user')->where('tournament_id', $tournament->id)->select('id', 'user_id')
                     ->orderBy('points')->limit(3)->get();

                      $tournament->first_prize_winner = isset($winners[0]) ? $winners[0]->user_id : 0; 
                      $tournament->second_prize_winner = isset($winners[1]) ? $winners[1]->user_id : 0;   
                      $tournament->third_prize_winner = isset($winners[1]) ? $winners[2]->user_id : 0;  

                      $tournament->save();

                      if($tournament->first_prize_winner)
                      {
                           $user = User::find($tournament->first_prize_winner);
                           $user->wallet_balance += $tournament->first_prize;
                           $user->save(); 
                      }

                      if($tournament->second_prize_winner)
                      {
                          $user = User::find($tournament->second_prize_winner);
                          $user->wallet_balance += $tournament->second_prize; 
                          $user->save();
                      }

                      if($tournament->third_prize_winner)
                      {
                          $user = User::find($tournament->third_prize_winner);
                          $user->wallet_balance += $tournament->third_prize;
                          $user->save(); 
                      }
                     
                      // notify winners 
                }
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
