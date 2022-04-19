<?php


namespace App\Models\Staff\Setters;


use Illuminate\Database\Eloquent\Model;

trait EntityTrait
{
    /**
     * @return Model
     */
    public function getEntity()
    {
        return $this->entity;
    }

    protected function setAttribute($key, $value): self
    {
        $this->getEntity()->setAttribute($key, $value);

        return $this;
    }
}