<?php


namespace App\Builders\Model;


use App\Models\User;
use App\Repositories\AbstractRepository;

class UserMetaBuilder
{
    /** @var AbstractRepository */
    private $repository;
    private $value;
    private $key;
    private $user;

    public function __construct()
    {
    }

    public function setKey(string $key): self
    {
        $this->key = $key;

        return $this;
    }

    public function setValue($value): self
    {
        $this->value = $value;

        return $this;
    }

    public function setRepository(AbstractRepository $repository): self
    {
        $this->repository = $repository;

        return $this;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function build()
    {
        return $this->repository->createRelated(['key' => $this->key, 'value' => $this->value], $this->user);
    }
}