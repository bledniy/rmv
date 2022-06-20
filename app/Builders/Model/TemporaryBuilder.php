<?php

namespace App\Builders\Model;

use App\Repositories\AbstractRepository;

class TemporaryBuilder
{
    private $value = [];
    private $key;
    private $type;
    private $deletable = true;


    public function setKey($key): self
    {
        $this->key = $key;

        return $this;
    }

    public function setValue($value): self
    {
        $this->value = $value;

        return $this;
    }

    //alias
    public function setData($value): self
    {
        return $this->setValue($value);
    }

    public function setRepository(AbstractRepository $repository): self
    {
        $this->repository = $repository;

        return $this;
    }

    /**
     * @param mixed $type
     * @return TemporaryBuilder
     */
    public function setType($type): self
    {
        $this->type = $type;

        return $this;
    }

    public function notDeletetable(): self
    {
        $this->deletable = false;

        return $this;
    }

    public function build(): array
    {
        return [
            'type' => $this->type,
            'key' => $this->key,
            'value' => $this->value,
            'deletable' => $this->deletable,
        ];
    }

}