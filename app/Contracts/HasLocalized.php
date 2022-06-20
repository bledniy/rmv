<?php declare(strict_types=1);

namespace App\Contracts;

interface HasLocalized
{
    public function lang($language_id = null);
}