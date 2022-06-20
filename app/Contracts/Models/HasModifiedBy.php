<?php declare(strict_types=1);

namespace App\Contracts\Models;

interface HasModifiedBy
{

    public function getForeignKey();

    public function modifiable();

}