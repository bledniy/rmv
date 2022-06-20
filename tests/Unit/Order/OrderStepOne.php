<?php

namespace Tests\Unit\Order;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderStepOne extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
	public function testExample()
	{
		$response = $this->post(route('submit.step-one'), [

		]);
	}
}
