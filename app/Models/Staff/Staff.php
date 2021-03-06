<?php declare(strict_types=1);

namespace App\Models\Staff;

use App\Contracts\HasImagesContract;
use App\Contracts\HasLocalized;
use App\Models\Department\Department;
use App\Models\Faculty\Faculty;
use App\Models\Model;
use App\Traits\Models\HasImages;
use App\Traits\Models\ImageAttributeTrait;
use App\Traits\Models\Localization\RedirectLangColumn;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'sort' => 'int',
        'is_head' => 'bool',
    ];

    protected $guarded = ['id'];

    public static function boot(): void
    {
        parent::boot();
    }

    public function faculty(): HasOne
    {
        return $this->hasOne(Faculty::class, 'id')->with('lang');
    }
    public function department(): HasMany
    {
        return $this->hasMany(Department::class, 'id', 'department_id')->with('lang');
    }

    public function getDescription(): string
    {
        return (string)$this->getAttribute('description');
    }

    public function getName(): string
    {
        return (string)$this->getAttribute('name');
    }

    public function getEmail(): string
    {
        return (string)$this->getAttribute('email');
    }

    public function getPhone(): string
    {
        return (string)$this->getAttribute('phone');
    }

    public function getIsActive(): bool
    {
        return (bool)$this->getAttribute('active');
    }
}
