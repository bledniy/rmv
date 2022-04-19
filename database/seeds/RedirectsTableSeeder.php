<?php declare(strict_types=1);

namespace Database\Seeders;

use App\Repositories\RedirectRepository;
use Symfony\Component\HttpFoundation\Response;

class RedirectsTableSeeder extends AbstractSeeder
{
	private $repository;

	public function __construct(RedirectRepository $repository)
	{
		$this->reguard();
		$this->repository = $repository;
	}

	public function run(): void
	{
		foreach ($this->getRedirects() as $from => $to) {
			$array = [
				'from' => $from,
				'to' => $to,
				'code' => Response::HTTP_MOVED_PERMANENTLY,
			];
			$this->repository->create($array);
		}
	}

	private function getRedirects(): array
	{
		return [

		];
	}
}