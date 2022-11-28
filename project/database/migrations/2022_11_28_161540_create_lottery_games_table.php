<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotteryGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('lottery_games', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('gamer_count')->default(1);
            $table->bigInteger('reward_points')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('lottery_games');
    }
}
