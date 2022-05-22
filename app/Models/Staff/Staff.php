<?php declare(strict_types=1);

namespace App\Models\Staff;

use App\Contracts\HasImagesContract;
use App\Contracts\HasLocalized;
use App\Models\Model;
use App\Traits\Models\HasImages;
use App\Traits\Models\ImageAttributeTrait;
use App\Traits\Models\Localization\RedirectLangColumn;

class Staff extends Model implements HasLocalized, HasImagesContract
{
    use HasImages;
    use RedirectLangColumn;
    use ImageAttributeTrait;

    protected $table = 'staffs';

    protected $langColumns = [
        'name', 'description', 'language_id',
    ];

    protected $hasOneLangArguments = [StaffLang::class];

    protected $casts = [
        'active' => 'bool',
    ];

    protected $guarded = ['id'];

    public static function boot(): void
    {
        parent::boot();
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
}
