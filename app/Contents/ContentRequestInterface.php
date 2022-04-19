<?php declare(strict_types=1);

namespace App\Contents;

use App\Http\Requests\AbstractRequest;

interface ContentRequestInterface
{
    public function getRequest(): AbstractRequest;
}