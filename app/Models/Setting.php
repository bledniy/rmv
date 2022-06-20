<?php

namespace App\Models;

use App\Helpers\Validation\ValidationMaxLengthHelper;
use App\Observers\SettingObserver;
use App\Scopes\SortOrderScope;
use App\Traits\Models\Relations\BelongsToUser;
use App\Traits\Models\Relations\DeletedByUser;
use App\Traits\Models\SetAttributeValueLimited;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * App\Models\Setting
 *
 * @property int $id
 * @property string $key
 * @property string|null $display_name
 * @property string|null $value
 * @property string|null $details
 * @property string|null $type
 * @property int $sort
 * @property string|null $group
 * @property int|null $user_id Last edited by user
 * @property int|null $deleted_by Deleted by user
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $deletedBy
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model active($active = 1)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model orWhereLike($column, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model whereLike($column, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Setting withoutTrashed()
 * @mixin \Eloquent
 */
class Setting extends Model
{
    use DeletedByUser;
    use BelongsToUser;
    use SetAttributeValueLimited;

    public const DEFAULT_GROUP = 'global';

    public const TYPE_CHECKBOX = 'checkbox';

    public const STAFF_GROUP = '_';

    private static $settings = null;
    protected $table = 'settings';
    protected $fillable = [
        'type',
        'key',
        'value',
        'display_name',
        'group',
        'sort',
        'details',
    ];
    protected $guarded = [];
    private $valueDecoded = false;
    private $detailsArray;

    public static function getSetting($key, $field = 'value')
    {
        $setting = self::getSettings($key);
        if ($field) {
            return \Arr::get($setting, $field);
        }

        return $setting;
    }

    public static function getSettings($key = false)
    {
        if (self::$settings === null) {
            /** @var  $query Builder */
            $query = self::query()->withGlobalScope('sort', new SortOrderScope);
            $settings = $query->get();
            self::$settings = $settings->keyBy('key');
        }
        if (!$key) {
            return self::$settings;
        }
        if (\Arr::has(self::$settings, $key)) {
            return \Arr::get(self::$settings, $key);
        }

        return null;
    }

    /**
     * @param $key
     *
     * @return mixed
     * Является ли переданный ключ, служебной настройкой не доступной для публичного редактирования
     */
    public static function isStaff($key)
    {
        return \Str::startsWith($key, '_');
    }

    public static function boot()
    {
        parent::boot();

        if (class_exists(SettingObserver::class)) {
            static::observe(SettingObserver::class);
        }
    }

    public function isFileValid(): bool
    {
        $isFile = $this->isFile();
        $value = \Arr::get($this, 'value');

        return $isFile and $value;
    }

    public function isFile()
    {
        $types = [
            'file_multiple',
            'file',
            'image',
        ];

        return in_array($this->getTypeAttribute(), $types, true);
    }

    public function getTypeAttribute()
    {
        return $this->attributes['type'];
    }

    public function isTypeCheckbox(): bool
    {
        return $this->getTypeAttribute() === self::TYPE_CHECKBOX;
    }

    public function isTypeImage(): bool
    {
        return $this->isFile() and $this->getTypeAttribute() === 'image';
    }

    public function isTypeFile()
    {
        return $this->isFile() and $this->getTypeAttribute() === 'file';
    }

    public function isTypeFileMultiple()
    {
        return $this->isFile() and $this->attributes['type'] === 'file_multiple';
    }

    public function isMultiFile()
    {
        $isFile = $this->isFile();
        $type = $this->getTypeAttribute() === 'file_multiple';

        return $isFile and $type;
    }

    public function getValue($key = false)
    {
        if (!$this->valueDecoded and isJson($this->attributes['value'])) {
            $this->attributes['value'] = \json_decode($this->attributes['value']);
            $this->valueDecoded = true;
        }

        return $key ? \Arr::get($this->attributes['value'], $key) : $this->attributes['value'];
    }

    public function getKeyForSave()
    {
        $replaced = str_replace('.', '_', $this->getAttribute('key'));
        $prefix = $this->getTable() . '_' . $this->getKey() . '_';
        $key = $prefix . $replaced;

        return $key;
    }

    public function getPrepend(): ?string
    {
        $prepend = null;
        switch ($this->getTypeAttribute()) {
            case 'file':
                $prepend = "settingFile('";
                break;
            case 'file_multiple':
                $prepend = "settingFiles('";
                break;
            default:
                $prepend = "getSetting('";
        }

        return $prepend;
    }

    public function getAppend(): string
    {
        return "')";
    }

    public function setValueAttribute(?string $value): self
    {
        $value = Str::limit((string)$value, ValidationMaxLengthHelper::LONGTEXT);
        $this->attributes['value'] = $value;

        return $this;
    }

    public function setDeletedByAttribute($value): void
    {
        $this->attributes['deleted_by'] = $value;
    }

    public function getDetail($key)
    {
        $this->castDetails();

        return \Arr::get($this->detailsArray, $key);
    }

    private function castDetails(): void
    {
        if (!$this->detailsArray) {
            $this->detailsArray = \json_decode($this->details, true);
        }
    }

    public function detailExists($key): bool
    {
        $this->castDetails();

        return \Arr::has($this->detailsArray, $key);
    }

    public function detailsExists(array $keys): bool
    {
        $this->castDetails();

        return \Arr::has($this->detailsArray, $keys);
    }

}
