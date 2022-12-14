<?php

namespace App\Models;

use App\Events\CreatingLotteryGameMatchEvent;
use App\Events\UpdatingLotteryGameMatchEvent;
use App\Helpers\TimeHelper;
use Carbon\Carbon;
use Egal\Model\Exceptions\ObjectNotFoundException;
use Egal\Model\Exceptions\UpdateException;
use Egal\Model\Exceptions\ValidateException;
use Egal\Model\Model as EgalModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property integer $id {@property-type field} {@primary-key} {@validation-rules integer|filled}
 * @property integer $game_id {@property-type field} {@validation-rules bail|required|integer|exists:lottery_games,id}
 * @property Carbon $start_date {@property-type field} {@validation-rules bail|required|date|after_or_equal:today|date_format:Y-m-d}
 * @property Carbon $start_time {@property-type field} {@validation-rules bail|required|date_format:H:i:s}
 * @property integer $winner_id {@property-type field} {@validation-rules bail|integer|exists:users,id}
 * @property Carbon $created_at {@property-type field}
 * @property Carbon $updated_at {@property-type field}
 *
 * @property LotteryGame $game {@property-type relation}
 * @property Collection|LotteryGameMatchUser[] $players {@property-type relation}
 *
 * @action getItems {@statuses-access logged|guest}
 * @action create {@statuses-access logged} {@roles-access admin}
 * @action close {@statuses-access logged} {@roles-access admin}
 */
class LotteryGameMatch extends EgalModel
{
    use HasRelationships;

    protected $dispatchesEvents = [
        "creating" => CreatingLotteryGameMatchEvent::class,
    ];

    protected $fillable = [
        'game_id',
        'start_date',
        'start_time'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * @throws ValidateException
     * @throws UpdateException
     * @throws ObjectNotFoundException
     */
    public static function actionClose(array $attributes): string
    {
        $instance = new static();

        if (!isset($attributes[$instance->getKeyName()])) {
            throw new UpdateException('The identifier of the entity being updated is not specified!');
        }

        $id = $attributes[$instance->getKeyName()];

        $instance->validateKey($id);

        /** @var LotteryGameMatch|null $item */
        $item = $instance->query()
            ->find($id);

        if (is_null($item)) {
            throw ObjectNotFoundException::make($id);
        }

        event(new UpdatingLotteryGameMatchEvent($item));

        return "Game closed. Winner id: {$item->getAttribute('winner_id')}";
    }

    public function game(): HasOne
    {
        return $this->hasOne(LotteryGame::class, 'id', 'game_id');
    }

    public function players(): HasMany
    {
        return $this->hasMany(LotteryGameMatchUser::class, 'lottery_game_match_id', 'id');
    }

    public function winner(): HasOne
    {
        return $this->hasOne(User::class, "id", "winner_id");
    }

    public function isGameStarted(): bool
    {
        $startDate = $this->getAttribute("start_date");
        $startTime = $this->getAttribute("start_time");

        return TimeHelper::isLaterThenNow("$startDate $startTime");
    }
}
