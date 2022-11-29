<?php

namespace App\Models;

use Carbon\Carbon;
use Egal\Model\Model;
use Egal\Model\Model as EgalModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id {@property-type field} {@primary-key} {@validation-rules integer|filled}
 * @property string $first_name {@property-type field} {@validation-rules required|string}
 * @property string $last_name {@property-type field} {@validation-rules required|string}
 * @property string $email {@property-type field} {@validation-rules bail|required|string|unique:users,email}
 * @property string $password {@property-type field} {@validation-rules required|string}
 * @property bool $is_admin {@property-type field} {@validation-rules boolean|filled}
 * @property integer $points {@property-type field} {@validation-rules integer}
 *
 * @property Collection|LotteryGameMatch[] $winning_matches {@property-type relation}
 * @property Collection|LotteryGameMatchUser[] $matches {@property-type relation}
 *
 * @action getItems {@statuses-access logged} {@roles-access admin}
 * @action create {@statuses-access guest}
 * @action update {@statuses-access logged} {@roles-access user}
 * @action delete {@statuses-access logged} {@roles-access user}
 */
class User extends Model
{

    use HasFactory;
    use HasRelationships;

    protected $fillable = [
        "first_name",
        "last_name",
        "email",
        "password",
        "is_admin"
    ];

    protected $hidden = [
        'is_admin',
    ];

    protected function password(): Attribute
    {
        return Attribute::set(
            fn(string $value): string => password_hash($value, PASSWORD_BCRYPT),
        );
    }

    public function winningMatches(): HasMany
    {
        return $this->hasMany(LotteryGameMatch::class);
    }

    public function matches(): HasMany
    {
        return $this->hasMany(LotteryGameMatchUser::class);
    }

    public static function isExists(string $column, string $value): bool
    {
        return User::query()
            ->firstWhere($column, 'eq', $value)
            ->exists();
    }
}
