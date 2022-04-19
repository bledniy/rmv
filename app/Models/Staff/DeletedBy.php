<?php

namespace App\Models\Staff;
/**
 * App\Models\Staff\DeletedBy
 *
 * @property int $id
 * @property string|null $deletable_type
 * @property int|null $deletable_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $deletable
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model active($active = 1)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff\DeletedBy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff\DeletedBy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model orWhereLike($column, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff\DeletedBy query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff\DeletedBy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff\DeletedBy whereDeletableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff\DeletedBy whereDeletableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff\DeletedBy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model whereLike($column, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff\DeletedBy whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Staff\DeletedBy whereUserId($value)
 * @mixin \Eloquent
 */
class DeletedBy extends \App\Models\Model
{

    public $table = 'deleted_by';

    protected $guarded = ['id'];

    public function deletable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo('deletable');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}