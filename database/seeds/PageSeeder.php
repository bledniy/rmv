<?php

namespace Database\Seeders;

use App\Enum\PageTypeEnum;
use App\Repositories\PageRepository;
use Faker\Generator;
use Illuminate\Support\Collection;

class PageSeeder extends AbstractSeeder
{
	private $existsPages;
	/**
	 * @var PageRepository
	 */
	private $repository;
	/**
	 * @var Generator
	 */
	private $generator;

	public function __construct(PageRepository $repository, Generator $generator)
	{
		$this->reguard();
		$this->setExistsPages($repository->all());
		$this->repository = $repository;
		$this->generator = $generator;
	}

	public function run()
	{
		$pages = [
			[
				'name' => 'О нас',
				'image' => $this->image($this->generator->imageUrl()),
				'description' => $this->generator->realText(),
				'page_type' => PageTypeEnum::ABOUT,
			],
			[
				'name' => 'Политика конфиденциальности',
				'page_type' => PageTypeEnum::PRIVACY,
				'description' => $this->generator->realText(2500),
			],
		];
		$this->loop($pages);
	}

	private function loop(array $pages)
	{
		foreach ($pages as $page) {
			if ($this->pageExists($page['page_type'] ?? '')) {
				continue;
			}
			$this->createPage($page);
		}
	}

	private function createPage(array $pageData): void
	{
		$this->repository->create($pageData);
	}

	private function setExistsPages(Collection $collection): void
	{
		$this->existsPages = $collection->keyBy('page_type');
	}

	private function pageExists(string $url)
	{
		return $this->existsPages->offsetExists($url);
	}
}
