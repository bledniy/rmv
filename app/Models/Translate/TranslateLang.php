<?php

namespace App\Models\Translate;


use App\Helpers\Validation\ValidationMaxLengthHelper;
use App\Models\Model;
use App\Traits\EloquentMultipleForeignKeyUpdate;
use App\Traits\Models\BelongsToLanguage;
use App\Traits\Models\SetAttributeValueLimited;
use Illuminate\Support\Str;


/**
 * App\Models\Translate\TranslateLang
 *
 * @property int $translate_id
 * @property string|null $value
 * @property int $language_id
 * @property-read \App\Models\Language $language
 * @property-read \App\Models\Translate\Translate $translate
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model active($active = 1)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate\TranslateLang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate\TranslateLang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model orWhereLike($column, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate\TranslateLang query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model whereLike($column, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate\TranslateLang whereTranslateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Translate\TranslateLang whereValue($value)
 * @mixin \Eloquent
 */
class TranslateLang extends Model
{
    use BelongsToLanguage;
    use EloquentMultipleForeignKeyUpdate;
    use SetAttributeValueLimited;

    public $timestamps = false;
    public $incrementing = false;
    protected $table = 'translate_lang';
    protected $guarded = [];

    protected $primaryKey = ['translate_id', 'language_id'];

    public function translate()
    {
        return $this->belongsTo(Translate::class);
    }

    public function setValueAttribute(?string $value)
    {
        $value = Str::limit((string)$value, ValidationMaxLengthHelper::TEXT);
        $this->attributes['value'] = $value;

        return $this;
    }
}
