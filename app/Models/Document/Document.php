<?php declare(strict_types=1);

namespace App\Models\Document;

use App\Contracts\HasLocalized;
use App\Contracts\Models\HasNextPrevAttributes;
use App\Models\Model;
use App\Traits\Models\FileAttributeTrait;
use App\Traits\Models\Localization\RedirectLangColumn;
use App\Traits\Models\PrevNextAttributes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

class Document extends Model implements HasNextPrevAttributes, HasLocalized
{
    use PrevNextAttributes;
    use RedirectLangColumn;
    use FileAttributeTrait;

    protected $langColumns = [
        'name', 'title', 'description', 'excerpt', 'language_id',
    ];

    protected $hasOneLangArguments = [DocumentLang::class];

    protected $casts = [
        'video' => 'string',
        'is_notified' => 'bool',
        'active' => 'bool',
    ];

    protected $guarded = ['id'];

    public static function getBetweenDates($from, $to)
    {
        return self::whereBetween('published_at', [$from, $to])->get();
    }

    public static function boot()
    {
        parent::boot();
    }

    public function getSlug(): string
    {
        return (string)$this->getAttribute('url');
    }

    public function prevNew(): HasOne
    {
        return $this->hasOne(__CLASS__, 'prev_id')->with('lang');
    }

    public function nextNew(): HasOne
    {
        return $this->hasOne(__CLASS__, 'next_id')->with('lang');
    }

    public function getExcerpt()
    {
        return $this->getAttribute('excerpt');
    }

    public function getDescription(): string
    {
        return (string)$this->getAttribute('description');
    }

    public function getName(): string
    {
        return (string)$this->getAttribute('name');
    }

    public function getIsActive(): bool
    {
        return (bool)$this->getAttribute('active');
    }

    public function getNext(): ?self
    {
        return $this->nextNew;
    }

    public function getPublishedAt(): Carbon
    {
        return getDateCarbon($this->published_at);
    }

    public function getPublishedAtFormatted(): string
    {
        return $this->getPublishedAt()->formatLocalized('%e %B, %R');
    }
}
