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
            $table->foreignId('game_id')
                ->constrained('lottery_games')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->date('start_date');
            $table->time('start_time');
            $table->foreignId('winner_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
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
