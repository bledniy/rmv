<?php declare(strict_types=1);

namespace App\Contracts\Models;

interface HasDeletedBy
{
    public function getForeignKey();

    public function deletable();

}