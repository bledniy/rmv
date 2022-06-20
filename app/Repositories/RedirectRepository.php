<?php

namespace App\Repositories;

use App\Criteria\ActiveCriteria;
use App\Models\Redirect;
use App\Scopes\WhereActiveScope;

/**
 * Class RedirectRepository.
 */
class RedirectRepository extends AbstractRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Redirect::class;
    }

    public function findByUrl(string $url)
    {
        $data = $this->makeModel()->where('from', $url)->withGlobalScope('active', new WhereActiveScope)->first();
        if ($data === null) {
            return null;
        }

        return $data->from === $url ? $data : null;
    }

    public function findRedirectByUrl(string $url)
    {
        $this->pushCriteria($this->app->make(ActiveCriteria::class))->applyCriteria();
        $this->model->whereFrom($url);

        return $this->first();
    }
}
