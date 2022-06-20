<?php declare(strict_types=1);

namespace App\Models\Slider;


use App\Contracts\HasImagesContract;
use App\Models\Model;
use App\Traits\Models\HasImages;
use App\Traits\Models\ImageAttributeTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;


/**
 * App\Models\Slider\Slider
 *
 * @property int $id
 * @property int $active
 * @property string|null $comment
 * @property string|null $options
 * @property string|null $sliderable_type
 * @property int|null $sliderable_id
 * @property string|null $key
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property mixed $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Slider\SliderItem[] $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $sliderable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model active($active = 1)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider\Slider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider\Slider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model orWhereLike($column, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider\Slider query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider\Slider whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider\Slider whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider\Slider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider\Slider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider\Slider whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model whereLike($column, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider\Slider whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider\Slider whereSliderableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider\Slider whereSliderableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slider\Slider whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Slider extends Model implements HasImagesContract
{
    use ImageAttributeTrait;
    use HasImages;

    protected $table = 'sliders';

    protected $guarded = [
        'id',
    ];
    /**
     * @var mixed
     */
    private $type;

    public function items(): HasMany
    {
        return $this->hasMany(SliderItem::class);
    }

    public function sliderable()
    {
        return $this->morphTo();
    }

    /**
     * @return SliderItem[]|Collection
     */
    public function getSlides(): Collection
    {
        return $this->items;
    }

    /**
     * @return Collection|SliderItem[]
     */
    public function getValidSlides(): Collection
    {
        return $this->getSlides()->filter(function (SliderItem $item) {
            return storageFileExists(imgPathOriginal($item->src)) || isExternalFile($item->src);
        })
            ;
    }

    public function canDelete(): bool
    {
        return null !== $this->type;
    }

}
