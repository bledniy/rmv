<?php declare(strict_types=1);

namespace App\Models\Page;

use App\Contracts\HasLocalized;
use App\Enum\PageTypeEnum;
use App\Models\Content\Content;
use App\Models\Content\HasContentable;
use App\Models\Model;
use App\Traits\Models\ImageAttributeTrait;
use App\Traits\Models\Localization\RedirectLangColumn;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Arr;

class Page extends Model implements HasLocalized, HasContentable
{
    use ImageAttributeTrait;
    use RedirectLangColumn;

    protected $langColumns = [
        'name', 'title', 'description', 'excerpt', 'sub_title', 'sub_description',
    ];

    protected $hasOneLangArguments = [PageLang::class];

    protected $guarded = [];

    public function getUrl()
    {
        $column = 'url';

        return Arr::get($this->attributes, $column);
    }

    public function content(): MorphMany
    {
        return $this->morphMany(Content::class, 'contentable');
    }

    public function getTitle()
    {
        return $this->getAttribute('title') ?: $this->getAttribute('name');
    }

    public function getTypeEnum(): PageTypeEnum
    {
        return new PageTypeEnum((string)$this->getAttribute('page_type'));
    }

}
