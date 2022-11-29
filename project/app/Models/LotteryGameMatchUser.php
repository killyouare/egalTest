<?php

namespace App\Models;

use App\Events\ValidatedLotteryGameMatchUserEvent;
use Carbon\Carbon;
use Egal\Model\Model as EgalModel;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property integer $id {@property-type field} {@primary-key} {@validation-rules integer|filled}
 * @property integer $user_id {@property-type field} {@validation-rules integer}
 * @property integer $lottery_game_match_id {@property-type field} {@validation-rules bail|required|integer|exists:lottery_game_matches,id}
 * @property Carbon $created_at {@property-type field}
 * @property Carbon $updated_at {@property-type field}
 *
 * @property User $user {@property-type relation}
 * @property LotteryGameMatch $match {@property-type relation}
 *
 * @action create {@statuses-access logged} {@role-access user}
 */
class LotteryGameMatchUser extends EgalModel
{

    use HasRelationships;

    protected $dispatchesEvents = [
        "validated" => ValidatedLotteryGameMatchUserEvent::class
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function match(): HasOne
    {
        return $this->hasOne(LotteryGameMatch::class);
    }
}
