<?php

namespace App\Repositories;

use App\Models\Translate\Translate;
use App\Models\Translate\TranslateLang;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class TranslateRepository extends AbstractRepository
{

    public function model(): string { return Translate::class; }

    public function modelLang(): string { return TranslateLang::class; }

    /**
     * @param Request $request
     * @return Collection
     */
    public function getForAdminDisplay(Request $request): Collection
    {
        $query = Translate::with('lang')->latest();
        if ($search = $request->get('search')) {
            $query->join('translate_lang', 'translate_id', 'id')
                ->where(static function (Builder $builder) use ($search) {
                    $builder->where('key', 'like', '%' . $search . '%')
                        ->orWhere('value', 'like', '%' . $search . '%')
                        ->orWhere('group', 'like', '%' . $search . '%')
                    ;
                })
                ->where('translate_lang.language_id', getCurrentLangId())
            ;
        }

        /** @var  $translates */
        return $query->get();
    }

    public function getGroups(): Collection
    {
        return Translate::distinct()->get('group')->pluck('group');
    }
}
