<?php

namespace App\Traits\Migrations\ForeignKeys;

use Illuminate\Database\Schema\Blueprint;

trait UsersForeignKey
{
    protected function addForeignUsers(): void
    {
        /** @var  $table Blueprint */
        $table = $this->table();
        $table->unsignedBigInteger('user_id')->index();
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    }

    protected function dropForeignUsers(): void
    {
        /** @var  $table Blueprint */
        $table = $this->table();
        $table->dropForeign('user_id');
    }
}