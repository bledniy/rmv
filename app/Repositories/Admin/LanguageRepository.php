<?php

namespace App\Repositories\Admin;

use App\Models\Language;
use App\Repositories\AbstractRepository;
use Illuminate\Support\Collection;

/**
 * Class LanguageRepository.
 */
class LanguageRepository extends AbstractRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Language::class;
    }

    public function getForCreateEntity(): Collection
    {
        return Language::whereActive(1)->get();
    }

    public function findOneByCode($code)
    {
        $this->model = $this->model->where('active', 1)->where('key', $code);

        return $this->first();
    }

    public function getDefaultLanguage()
    {
        $this->model = $this->model->where('active', 1)->where('default', 1);

        return $this->first();
    }
}
