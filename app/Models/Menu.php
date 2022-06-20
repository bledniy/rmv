<?php declare(strict_types=1);

namespace App\Models;

use App\Contracts\HasLocalized;
use App\Scopes\SortOrderScope;
use App\Scopes\WhereActiveScope;
use App\Traits\Models\ImageAttributeTrait;
use App\Traits\Models\Localization\RedirectLangColumn;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Menu extends Model implements HasLocalized
{
    use RedirectLangColumn, ImageAttributeTrait;

    protected $langColumns = ['name'];

    protected $hasOneLangArguments = [MenuLang::class, 'menu_id'];

    public const PUBLIC_MENUS_CACHE_KEY = 'public.menus';

    protected $guarded = ['id'];

    public function isMainMenu(): bool
    {
        return (int)$this->getAttribute('parent_id') === 0;
    }

    public function menus(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->with('lang');
    }

    public function allMenus(): HasMany
    {
        return $this->menus()
            ->with('lang', 'allMenus')
            ->withGlobalScope('sort', new SortOrderScope)
            ;
    }

    public function getName()
    {
        return $this->getAttribute('name');
    }

    public function getUrlAttribute()
    {
        return $this->attributes['url'];
    }

    public function getMenuName()
    {
        return $this->getAttribute('name');
    }

    public function getFullUrl()
    {
        $url = $this->getUrlAttribute();
        if ($this->isAnchor() || $this->isExternal()) {
            return $url;
        }

        return langUrl($url);
    }

    public function isExternal(): bool
    {
        return isStringUrl($this->getUrlAttribute());
    }

    public function isAnchor(): bool
    {
        return Str::startsWith($this->getUrlAttribute(), '#');
    }

    public function getRel(): string
    {
        return $this->isExternal() ? 'rel="nofollow"' : '';
    }

    public function getTarget(): string
    {
        return $this->isExternal() ? 'target="_blank"' : '';
    }

    public static function getForDisplay($onlyActive = true)
    {
        $query = $onlyActive ? self::active() : self::query();
        $query->with('lang');

        return $query->get();
    }

    public static function getForDisplayEdit()
    {
        return self::getForDisplay(false);
    }

    public function canDelete():bool
    {
        return $this->menus()->count() === 0;
    }

    public static function initScopesPublic()
    {
        if (!self::hasGlobalScope(new WhereActiveScope)) {
            self::addGlobalScope(new WhereActiveScope);
        }
        if (!self::hasGlobalScope(new SortOrderScope)) {
            self::addGlobalScope(new SortOrderScope);
        }
    }
}
