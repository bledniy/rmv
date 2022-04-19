<?php declare(strict_types=1);

namespace App\DataContainers\Page;

use Illuminate\Http\Request;

final class PageSearchRequest
{
    private $search = '';

    public function getSearch(): string
    {
        return $this->search;
    }

    public function setSearch(string $search): self
    {
        $this->search = $search;

        return $this;
    }

    public function fillFromRequest(Request $request): self
    {
        if ($request->has('search')) {
            $this->setSearch((string)$request->get('search'));
        }

        return $this;
    }

}