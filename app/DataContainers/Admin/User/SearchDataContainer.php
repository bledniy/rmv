<?php declare(strict_types=1);

namespace App\DataContainers\Admin\User;

class SearchDataContainer
{
    private $search = '';

    /**
     * @return string
     */
    public function getSearch(): string
    {
        return $this->search;
    }

    /**
     * @param string $search
     */
    public function setSearch(string $search): void
    {
        $this->search = $search;
    }

}