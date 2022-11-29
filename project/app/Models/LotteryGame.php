<?php

namespace App\Models;

use Egal\Model\Model as EgalModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id {@property-type field} {@primary-key} {@validation-rules integer|filled}
 * @property string $name {@property-type field} {@validation-rules required|string}
 * @property integer $gamer_count {@property-type field} {@validation-rules required|integer|gte:1}
 * @property integer $reward_points {@property-type field} {@validation-rules required|integer|gte:0}
 *
 * @property Collection|LotteryGameMatch[] $matches {@property-type relation}
 *
 */
class LotteryGame extends EgalModel
{

    use HasFactory;
    use HasRelationships;

    public function matches(): HasMany
    {
        return $this->hasMany(LotteryGameMatch::class);
    }
}
