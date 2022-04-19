<?php

namespace App\Repositories\Admin;

use App\Models\Setting;
use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SettingsRepository extends AbstractRepository
{

    public function model(): string
    {
        return Setting::class;
    }

    public function getSettings(Request $request, $replace = false)
    {
        $query = Setting::with(['user', 'deletedBy']);

        if ($request->has('with_trashed')) {
            $query->withTrashed();
        }
        if ($search = $request->get('search')) {
            $query->where(function (Builder $query) use ($search) {
                $query->where('key', 'like', '%' . $search . '%')
                    ->orWhere('value', 'like', '%' . $search . '%')
                    ->orWhere('details', 'like', '%' . $search . '%')
                    ->orWhere('group', 'like', '%' . $search . '%')
                    ->orWhere('value', 'display_name', '%' . $search . '%')
                ;
            });
        }

        if (!isSuperAdmin()) {
            $query = $query->where('key', 'NOT LIKE', '_.%');
        }
        $settings = $query->get();
        if (!$replace && $settings->isEmpty()) {
            $request->merge(['search' => replaceLettersSearchRuEn($request->get('search'))]);

            return $this->getSettings($request, true);
        }

        return $settings;
    }

    public function getListPublic(array $keys = []): Collection
    {
        return $this->whereIn('key', $keys)->get(['key', 'value', 'id', 'display_name']);
    }

}
