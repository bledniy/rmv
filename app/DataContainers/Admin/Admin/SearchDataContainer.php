<?php declare(strict_types=1);

namespace App\DataContainers\Admin\Admin;

class SearchDataContainer
{
    private $search = '';

    private $isSuperAdmin = false;

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

    /**
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->isSuperAdmin;
    }

    /**
     * @param bool $isSuperAdmin
     */
    public function setIsSuperAdmin(bool $isSuperAdmin): void
    {
        $this->isSuperAdmin = $isSuperAdmin;
    }

}