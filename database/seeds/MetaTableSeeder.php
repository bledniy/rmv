<?php

namespace Database\Seeders;

use App\Repositories\MetaRepository;
use Illuminate\Database\Seeder;

class MetaTableSeeder extends AbstractSeeder
{
	/**
	 * @var MetaRepository
	 */
	private $repository;

	public function __construct(MetaRepository $repository)
	{
		$this->reguard();
		$this->repository = $repository;
	}


	public function run()
	{
		$metas = [
			['url' => '*', 'active' => 1, 'meta_title' => env('APP_NAME')],
		];
		foreach ($metas as $meta) {
			$this->repository->create($meta);
		}
	}
}
