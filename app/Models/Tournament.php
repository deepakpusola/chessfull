<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

use App\User;
use App\Models\Match;

class Tournament extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'tournaments';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $guarded = [];
    // protected $hidden = [];
    // protected $dates = [];

    public function players()
    {
        return $this->belongsToMany(User::class)->withPivot('points');
    }


    public function matches()
    {
        return $this->hasMany(Match::class, 'tournament_id');
    }
}
