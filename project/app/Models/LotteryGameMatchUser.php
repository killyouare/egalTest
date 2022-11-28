<?php

namespace App\Models;

use Egal\Model\Model as EgalModel;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property integer $id {@property-type field} {@primary-key} {@validation-rules integer|filled}
 * @property integer $user_id {@property-type field} {@validation-rules bail|required|integer|exists:users,id}
 * @property integer $lottery_game_match_id {@property-type field} {@validation-rules required|integer|exists:lottery_game_matches,id}
 *
 * @property User $user {@property-type relation}
 * @property LotteryGameMatch $match {@property-type relation}
 *
 * @action create {@statuses-access logged} {@role-access user}
 */
class LotteryGameMatchUser extends EgalModel
{
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function match(): HasOne
    {
        return $this->hasOne(LotteryGameMatch::class);
    }
}
