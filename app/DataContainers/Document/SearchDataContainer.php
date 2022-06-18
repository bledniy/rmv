<?php

namespace App\DataContainers\News;

use Illuminate\Http\Request;

class SearchDataContainer
{
	private $search = '';
	private $categories = [];
	private $onPage = 10;

	public function getSearch(): string
	{
		return $this->search;
	}

	public function setSearch(string $search): self
	{
		$this->search = $search;

		return $this;
	}

	public function getCategories(): array
	{
		return $this->categories;
	}

	public function setCategories(array $categories): self
	{
		$this->categories = $categories;

		return $this;
	}

	public function getOnPage(): int
	{
		return $this->onPage > 60 ? 60 : $this->onPage;
	}

	public function setOnPage(int $onPage): self
	{
		$this->onPage = $onPage;

		return $this;
	}

	public function fillFromRequest(Request $request)
	{
		if ($request->get('category_id')) {
			$this->setCategories([(int)$request->get('category_id')]);
		}
		if ($request->get('limit')) {
			$this->setOnPage((int)$request->get('limit'));
		}
		if ($request->get('search')) {
			$this->setSearch($request->get('search'));
		}
	}

}