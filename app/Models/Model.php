<?php declare(strict_types=1);

namespace App\Models;

use App\Models\Slider\SliderItem;
use App\Models\Translate\Translate;
use App\Traits\EloquentExtend;
use App\Traits\EloquentScopes;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Model extends EloquentModel
{
    use EloquentScopes;
    use EloquentExtend;

    /**
     * @var array
     */
    protected $hasOneLangArguments = [];

    /**
     * @param string $table
     * @return Model|null
     */
    public static function getModelByTable(string $table): ?Model
    {
        $className = self::getModelClassNameByTable($table);
        $model = null;
        if ($className) {
            try {
                $model = app()->make($className);
            } catch (\Exception $e) {

            }
        }

        return $model;
    }

    /**
     * @param null $language_id
     * @return HasOne
     */
    public function lang($language_id = null)
    {
        if (!$language_id) {
            $language_id = getCurrentLangId();
        }

        return $this->hasOne(...$this->hasOneLangArguments)->where('language_id', $language_id);
    }

    public function langs()
    {
        return $this->hasMany(...$this->hasOneLangArguments);
    }

    /**
     * @param string $table
     * @return string|null
     */
    public static function getModelClassNameByTable(string $table): ?string
    {
        $model = null;
        switch ($table) {
            case 'translates':
                $model = Translate::class;
                break;
            case 'slider_items':
                $model = SliderItem::class;
                break;
        }

        return $model;
    }

//		public function toArray()
//		{
//			if (!classImplementsInterface($this, HasLocalized::class) || !$this->lang) {
//				return parent::toArray();
//			}
//			return array_merge(parent::toArray(), $this->lang->toArray());
//		}

    public function canDelete()
    {
        return true;
    }


}



