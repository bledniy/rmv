<?php

namespace App\Models\Staff;

/**
 * App\Models\Staff\ModifiedBy
 *
 * @property int $id
 * @property string|null $modifiable_type
 * @property int|null $modifiable_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $modifiable
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model active($active = 1)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff\ModifiedBy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff\ModifiedBy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model orWhereLike($column, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff\ModifiedBy query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff\ModifiedBy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff\ModifiedBy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model whereLike($column, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff\ModifiedBy whereModifiableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff\ModifiedBy whereModifiableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff\ModifiedBy whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff\ModifiedBy whereUserId($value)
 * @mixin \Eloquent
 */
class ModifiedBy extends \App\Models\Model
{

    public $table = 'modified_by';

    protected $guarded = ['id'];

    public function modifiable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo('modifiable');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}