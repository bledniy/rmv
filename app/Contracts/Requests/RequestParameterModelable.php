<?php


namespace App\Contracts\Requests;


interface RequestParameterModelable
{
    function getRequestKey(): string;
}
