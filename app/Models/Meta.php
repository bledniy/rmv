<?php

namespace App\Models;

use App\Contracts\HasLocalized;
use App\Traits\Models\Localization\RedirectLangColumn;
use Illuminate\Support\Arr;


/**
 * App\Models\Meta
 *
 * @property int $id
 * @property string $url
 * @property int $type
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $header html/js etc code for header
 * @property string|null $footer html/js etc code for footer
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model active($active = 1)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model orWhereLike($column, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta whereFooter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta whereHeader($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model whereLike($column, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta whereUrl($value)
 * @mixin \Eloquent
 */
class Meta extends Model implements HasLocalized
{
    use RedirectLangColumn;

    protected static $results = [];

    protected static $defaultMeta;

    protected $langColumns = ['h1', 'title', 'keywords', 'description', 'text_top', 'text_bottom',];

    protected $hasOneLangArguments = [MetaLang::class];

    protected $table = 'meta';

    protected $guarded = ['id'];

    public static function getMetaData($url = null, $fromCache = true)
    {
        if ($url === null) {
            $url = getUrlWithoutHost(getNonLocaledUrl());
        }
        if (!$fromCache || !Arr::has(static::$results, $url)) {
            $meta = static::whereUrl($url)->where('active',1)->with('lang')->first();
            Arr::set(static::$results, $url, $meta);
        }

        return Arr::get(static::$results, $url);
    }

    public static function getDefaultMeta(): ?self
    {
        static $default;
        if (null === $default) {
            $default = Meta::whereUrl('*')->where('active',1)->with('lang')->first();
        }

        return $default;
    }

    public static function makeUrlClear(?string $url = ''): string
    {
        return (string)getUrlWithoutHost(getNonLocaledUrl($url));
    }

    public function isNotDefault()
    {
        return !$this->isDefault();
    }

    public function isDefault()
    {
        return $this->url === '*';
    }

}
