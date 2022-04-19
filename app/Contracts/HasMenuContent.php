<?php
/**
 * Created by PhpStorm.
 * User: aljajazva
 * Date: 2019-05-23
 * Time: 15:12
 */

namespace App\Contracts;


interface HasMenuContent
{
    public function getMenuContent(): string;
}