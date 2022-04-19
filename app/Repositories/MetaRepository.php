<?php

namespace App\Repositories;

use App\Criteria\ActiveCriteria;
use App\Models\Meta;
use App\Models\MetaLang;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

//use Your Model

/**
 * Class MetaRepository.
 */
class MetaRepository extends AbstractRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model(): string
    {
        return Meta::class;
    }

    public function modelLang(): string
    {
        return MetaLang::class;
    }

    public function getForAdminDisplay(Request $request): LengthAwarePaginator
    {
        $query = Meta::with('lang');
        if ($search = $request->get('search')) {
            $query = $this->joinLang($query);
            $query->where(static function (Builder $builder) use ($search) {
                $builder->where('url', 'like', '%' . $search . '%')
                    ->orWhere('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('keywords', 'like', '%' . $search . '%')
                ;
            });
            $query->orderBy('url');
        }
        $query->latest();

        return $query->paginate();
    }

    public function findOneByUrl(string $url)
    {
        $this->pushCriteria($this->app->make(ActiveCriteria::class))->applyCriteria();
        $this->model->whereUrl($url);
        $this->model = $this->joinLang($this->model);

        return $this->first();
    }
}
