<?php

namespace App\Models;

use Carbon\Carbon;
use Egal\Model\Model as EgalModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id {@property-type field} {@primary-key} {@validation-rules integer|filled}
 * @property string $name {@property-type field} {@validation-rules bail|required|string|max:255|unique:lottery_games,name}
 * @property integer $gamer_count {@property-type field} {@validation-rules required|integer|gte:1}
 * @property integer $reward_points {@property-type field} {@validation-rules required|integer|gte:0}
 * @property Carbon $created_at {@property-type field}
 * @property Carbon $updated_at {@property-type field}
 *
 * @property Collection|LotteryGameMatch[] $matches {@property-type relation}
 *
 * @action getItems {@statuses-access logged|guest}
 */
class LotteryGame extends EgalModel
{

    use HasFactory;
    use HasRelationships;

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function matches(): HasMany
    {
        return $this->hasMany(LotteryGameMatch::class);
    }
}
