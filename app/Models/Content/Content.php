<?php declare(strict_types=1);

namespace App\Models\Content;

use App\Contents\ContentFieldsTypeInterface as FI;
use App\Contracts\HasLocalized;
use App\Models\Model;
use App\Traits\Models\ImageAttributeTrait;
use App\Traits\Models\Localization\RedirectLangColumn;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Content extends Model implements HasLocalized
{
    use RedirectLangColumn;
    use ImageAttributeTrait;

    protected $langColumns = [FI::NAME, FI::TITLE, FI::EXCERPT, FI::DESCRIPTION, 'language_id'];

    protected $guarded = ['id'];

    protected $hasOneLangArguments = [ContentLang::class];

    public function contentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getName(): ?string
    {
        return $this->getAttribute(FI::NAME);
    }

    public function getTitle(): ?string
    {
        return $this->getAttribute(FI::TITLE);
    }

    public function getExcerpt(): ?string
    {
        return $this->getAttribute(FI::EXCERPT);
    }

    public function getDescription(): ?string
    {
        return $this->getAttribute(FI::DESCRIPTION);
    }

}
