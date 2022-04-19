<?php

namespace App\DataContainers\Admin\Feedback;


use Illuminate\Http\Request;

class SearchDataContainer
{
    private $search = '';

    private $type;

    public function getSearch(): string
    {
        return $this->search;
    }

    public function setSearch(?string $search): self
    {
        $this->search = (string)$search;

        return $this;
    }


    public function getType()
    {
        return $this->type;
    }

    public function setType($type): self
    {
        $this->type = $type;

        return $this;
    }

    public function fillFromRequest(Request $request)
    {
        if ($request->get('search')) {
            $this->setSearch($request->get('search'));
        }
        if ($request->get('type')) {
            $this->setType($request->get('type'));
        }
    }

}