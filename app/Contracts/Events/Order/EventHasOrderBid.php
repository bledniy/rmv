<?php


namespace App\Contracts\Events\Order;


use App\Models\Order\Order;
use App\Models\Order\OrderBid;

interface EventHasOrderBid
{
    public function getOrderBid(): OrderBid;
}