<?php


namespace App\Contracts\Events\Order;


use App\Models\Order\Order;

interface EventHasOrder
{
    public function getOrder(): Order;
}