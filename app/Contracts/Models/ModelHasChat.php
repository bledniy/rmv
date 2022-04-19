<?php


namespace App\Contracts\Models;


use Illuminate\Database\Eloquent\Relations\MorphMany;

interface ModelHasChat
{
    public function chat(): MorphMany;

    public function getChatName();
}