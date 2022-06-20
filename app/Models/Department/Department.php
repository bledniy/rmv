<?php declare(strict_types=1);

namespace App\Models\Department;

use App\Contracts\HasImagesContract;
use App\Contracts\HasLocalized;
use App\Models\Model;
use App\Traits\Models\HasImages;
use App\Traits\Models\ImageAttributeTrait;
use App\Traits\Models\Localization\RedirectLangColumn;

class Department extends Model implements HasLocalized, HasImagesContract
{
    use HasImages;
    use RedirectLangColumn;
    use ImageAttributeTrait;

    protected $langColumns = [
        'name', 'title', 'description', 'excerpt', 'language_id',
    ];

    protected $hasOneLangArguments = [DepartmentLang::class];

    protected $casts = [
        'active' => 'bool',
    ];

    protected $guarded = ['id'];

    public static function boot(): void
    {
        parent::boot();
    }

    public function getExcerpt()
    {
        return $this->getAttribute('excerpt');
    }

    public function getDescription(): string
    {
        return (string)$this->getAttribute('description');
    }

    public function getTitle(): string
    {
        return (string)$this->getAttribute('name');
    }

    public function getIsActive(): bool
    {
        return (bool)$this->getAttribute('active');
    }
}
