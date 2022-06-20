<?php declare(strict_types=1);

namespace App\View\Traits;

use Illuminate\Support\Facades\Cache;
use Psr\SimpleCache\InvalidArgumentException;

trait CacheableComponent
{
	protected function hasCached(): bool
	{
		return Cache::has($this->cacheKey);
	}

	protected function getCached()
	{
		return Cache::get($this->cacheKey);
	}

	protected function addToCached($view): void
	{
		try {
			Cache::set($this->cacheKey, (string)$view);
		} catch (InvalidArgumentException $e) {
		}
	}
}