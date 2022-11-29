<?php

namespace App\Models;

use Carbon\Carbon;
use Egal\Model\Model as EgalModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property integer $id {@property-type field} {@primary-key} {@validation-rules integer|filled}
 * @property integer $game_id {@property-type field} {@validation-rules bail|required|integer|exists:lottery_games,id}
 * @property Carbon $start_date {@property-type field} {@validation-rules bail|required|date|after_or_equal:today|date_format:Y-m-d}
 * @property Carbon $start_time {@property-type field} {@validation-rules bail|required|date|date_format:H:i:s|after:now}
 * @property integer $winner_id {@property-type field} {@validation-rules bail|required|integer|exists:users,id}
 *
 * @property LotteryGame $game {@property-type relation}
 * @property Collection|LotteryGameMatchUser[] $players {@property-type relation}
 * @property User $winner {@property-type relation}
 *
 * @action create {@statuses-access logged} {@roles-access admin}
 * @action update {@statuses-access logged} {@roles-access admin}
 */
class LotteryGameMatch extends EgalModel
{

    use HasRelationships;

    public function game(): HasOne
    {
        return $this->hasOne(LotteryGame::class);
    }

    public function players(): HasMany
    {
        return $this->hasMany(LotteryGameMatchUser::class);
    }

    public function winner(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
