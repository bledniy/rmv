<?php


namespace App\Contracts\Events\Order;


use App\Models\Order\Review;

interface EventHasReview
{
    public function getReview(): Review;
}