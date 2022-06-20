<?php

namespace App\Models\Translate;

use App\Contracts\HasLocalized;
use App\Models\Model;
use App\Models\Translate\Traits\TranslateAsStorageTrait;
use App\Models\Translate\Traits\TranslateHelpersTrait;
use App\Traits\Models\Localization\RedirectLangColumn;


/**
 * App\Models\Translate\Translate
 *
 * @property int $id
 * @property string|null $key
 * @property string|null $comment
 * @property int $module_id
 * @property string|null $group
 * @property string $type
 * @property array|null $variables
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $user_id Last edited by user
 * @property int|null $deleted_by User id deleted translate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $deletedBy
 * @property-read mixed $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model active($active = 1)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate\Translate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate\Translate newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Translate\Translate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model orWhereLike($column, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate\Translate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate\Translate whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate\Translate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate\Translate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate\Translate whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate\Translate whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate\Translate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate\Translate whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model whereLike($column, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate\Translate whereModuleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate\Translate whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate\Translate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate\Translate whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate\Translate whereVariables($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Translate\Translate withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Translate\Translate withoutTrashed()
 * @mixin \Eloquent
 */
class Translate extends Model implements HasLocalized
{
    use TranslateHelpersTrait, TranslateAsStorageTrait;
    use RedirectLangColumn;

    protected $langColumns = ['value', 'language_id'];


    public const TYPE_TEXT = 'text';
    //
    public const TYPE_TEXTAREA = 'textarea';

    public const TYPE_EDITOR = 'editor';


    protected $guarded = ['id'];

    protected $casts = [
        'variables' => 'array',
    ];

    protected $hasOneLangArguments = [TranslateLang::class];

    public function getValue()
    {
        return $this->getAttribute('value');
    }
}
