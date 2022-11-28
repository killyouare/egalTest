<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotteryGameMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('lottery_game_matches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->timestamp('start_date');
            $table->timestamp('start_time');
            $table->unsignedBigInteger('winner_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('lottery_game_matches');
    }
}
