<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddResultsToTournaments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tournaments', function (Blueprint $table) {
           $table->integer('closed')->default(0);
           $table->integer('first_prize_winner')->default(0);
           $table->integer('second_prize_winner')->default(0);
           $table->integer('third_prize_winner')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tournaments', function (Blueprint $table) {
           $table->dropColumn('closed');
           $table->dropColumn('first_prize_winner');
           $table->dropColumn('second_prize_winner');
           $table->dropColumn('third_prize_winner');
        });
    }
}
