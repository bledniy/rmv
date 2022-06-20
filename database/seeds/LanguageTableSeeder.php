<?php

namespace Database\Seeders;

use App\Repositories\Admin\LanguageRepository;
use LaravelLocalization;

class LanguageTableSeeder extends AbstractSeeder
{
	private $languageRepository;

	public function __construct(LanguageRepository $languageRepository)
	{
		$this->languageRepository = $languageRepository;
	}

	public function run()
	{
		$supported = array_keys(LaravelLocalization::getSupportedLocales());
		$languages = [
			[
				'name' => 'Українська',
				'key' => 'uk',
				'active' => 1,
				'default' => 0,
			],
			[
				'name' => 'Русский',
				'key' => 'ru',
				'active' => 1,
				'default' => 1,
			],
			[
				'name' => 'English',
				'key' => 'en',
				'active' => 1,
				'default' => 0,
			],
		];
		$languages = array_filter($languages, static function ($data) use ($supported) {
			return in_array($data['key'], $supported, true);
		});
		foreach ($languages as $language) {
			$this->languageRepository->create($language);
		}

	}
}
