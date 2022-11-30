<?php

namespace App\Models;

use Carbon\Carbon;
use Egal\Auth\Tokens\UserServiceToken;
use Egal\AuthServiceDependencies\Exceptions\LoginException;
use Egal\AuthServiceDependencies\Models\User as BaseUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id {@property-type field} {@primary-key} {@validation-rules integer|filled|owner}
 * @property string $first_name {@property-type field} {@validation-rules required|string|max:255}
 * @property string $last_name {@property-type field} {@validation-rules required|string|max:255}
 * @property string $email {@property-type field} {@validation-rules bail|required|string|max:255|unique:users,email|email}
 * @property string $password {@property-type field} {@validation-rules required|string}
 * @property bool $is_admin {@property-type field} {@validation-rules boolean|filled}
 * @property integer $points {@property-type field} {@validation-rules integer}
 * @property Carbon $created_at {@property-type field}
 * @property Carbon $updated_at {@property-type field}
 *
 * @property Collection|LotteryGameMatch[] $winning_matches {@property-type relation}
 * @property Collection|LotteryGameMatchUser[] $matches {@property-type relation}
 *
 * @action getItems {@statuses-access logged} {@roles-access admin}
 * @action create {@statuses-access guest}
 * @action update {@statuses-access logged} {@roles-access user}
 * @action delete {@statuses-access logged} {@roles-access user}
 * @action login {@statuses-access guest}
 */
class User extends BaseUser
{

    use HasFactory;
    use HasRelationships;

    protected $fillable = [
        "first_name",
        "last_name",
        "email",
        "is_admin",
        "password"
    ];

    protected $hidden = [
        "password",
        "is_admin",
        "created_at",
        "updated_at",
    ];

    /**
     * @throws LoginException
     */
    public static function actionLogin(string $email, string $password): string
    {
        /** @var BaseUser $user */
        $user = self::query()
            ->firstWhere('email', '=', $email);

        if (!$user || !password_verify($password, $user->getAttribute('password'))) {
            throw new LoginException('Incorrect Email or password!');
        }

        return $user->generateUST();
    }

    protected function password(): Attribute
    {
        return Attribute::set(
            fn(string $value): string => password_hash($value, PASSWORD_BCRYPT),
        );
    }

    protected function getRoles(): array
    {
        return [
            $this->is_admin
                ? 'admin'
                : 'user'
        ];
    }

    protected function getPermissions(): array
    {
        return [];
    }

    public function winningMatches(): HasMany
    {
        return $this->hasMany(LotteryGameMatch::class);
    }

    public function matches(): HasMany
    {
        return $this->hasMany(LotteryGameMatchUser::class);
    }

    protected function generateUST(): string
    {
        $ust = new UserServiceToken();

        $ust->setSigningKey(config('app.service_key'));
        $ust->setAuthInformation($this->generateAuthInformation());
        $ust->setTargetServiceName(config('app.service_name'));

        return $ust->generateJWT();
    }
}
