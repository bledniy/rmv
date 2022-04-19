<?php declare(strict_types=1);

namespace App\Models;

use App\Models\Staff\Setters\UserSetter;
use App\Observers\UserObserver;
use App\Traits\EloquentExtend;
use App\Traits\EloquentScopes;
use App\Traits\Models\ModelHasChatTrait;
use App\Traits\Models\User\UserAccessorsTrait;
use App\Traits\Models\User\UserGetterTrait;
use App\Traits\Models\User\UserHelpersTrait;
use App\Traits\Models\User\UserRelationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use UserAccessorsTrait, UserGetterTrait, UserHelpersTrait, UserRelationTrait;

    use EloquentExtend, EloquentScopes;

    use HasApiTokens, Notifiable, HasFactory;
    use ModelHasChatTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded = [
        'id',
    ];

    protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        if (class_exists(UserObserver::class)) {
            static::observe(UserObserver::class);
        }
    }

    public function getSetter()
    {
        return app(UserSetter::class, ['user' => $this]);
    }

    public function getType()
    {
        return $this->type;
    }

}
