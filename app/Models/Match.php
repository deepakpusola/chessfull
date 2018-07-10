<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $guarded = [];


    public function player1()
    {
    	return $this->belongsTo(User::class, 'player_1');
    }

     public function player2()
    {
    	return $this->belongsTo(User::class, 'player_2');
    }


    public function opponent()
    {
    	return $this->player1->id == auth()->id() ? $this->player2 : $this->player1;
    }
}
