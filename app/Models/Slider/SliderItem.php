<?php declare(strict_types=1);

namespace App\Models\Slider;

use App\Contracts\HasLocalized;
use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class SliderItem extends Model implements HasLocalized
{

    protected $hasOneLangArguments = [SliderItemLang::class];

    public const TYPE_IMAGE = 'image';

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public $timestamps = false;

    public function slider(): BelongsTo
    {
        return $this->belongsTo(Slider::class);
    }

    public function isTypeImage(): bool
    {
        return $this->type === self::TYPE_IMAGE;
    }

    public function getSrc(): string
    {
        return (string)$this->src;
    }

    public function setSlider(Slider $slider): self
    {
        $this->slider()->associate($slider);
        $slider->items->push($this);

        return $this;
    }

}
