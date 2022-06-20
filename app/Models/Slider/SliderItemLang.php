<?php

namespace App\Models\Slider;

use App\Models\ModelLang;
use App\Traits\Models\NameAttributeTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Slider\SliderItemLang
 *
 * @property int $slider_item_id
 * @property int $language_id
 * @property mixed $name
 * @property string|null $description
 * @property string|null $excerpt
 * @property-read \App\Models\Language $language
 * @property-read \App\Models\Slider\SliderItem $sliderItem
 * @mixin \Eloquent
 */
class SliderItemLang extends ModelLang
{
    use NameAttributeTrait;

    public $table = 'slider_item_lang';

    protected $guarded = [];

    protected $primaryKey = ['slider_item_id', 'language_id'];

    public function sliderItem(): BelongsTo
    {
        return $this->belongsTo(SliderItem::class);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return (string)$this->name;
    }

    /**
     * @return string
     */
    public function getExcerpt(): string
    {
        return (string)$this->excerpt;
    }

}