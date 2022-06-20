<?php declare(strict_types=1);

namespace Database\Seeders;

use App\Builders\Seeder\SettingsBuilder;
use App\Models\Setting;
use App\Repositories\Admin\SettingsRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Prettus\Validator\Exceptions\ValidatorException;

class SettingsTableSeeder extends AbstractSeeder
{
	private $settings;
	/**
	 * @var SettingsRepository
	 */
	private $repository;

	public function __construct(SettingsRepository $repository)
	{
		$this->reguard();
		$this->settings = $repository->get()->keyBy('key');
		$this->repository = $repository;
	}

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 * @throws ValidatorException
	 */
	public function run(): void
{
		$groups = [
			'global' => [
				$this->getBuilder('sitename')->setValue('UNTP')->setDisplayName('Название сайта')->build(),
//				$this->getBuilder('currency')->setValue('грн')->setDisplayName('Название валюты')->build(),
			],
			'email' => [
				$this->getBuilder('contact-email')->setValue(isLocalEnv() ? 'exceptions.manticore@gmail.com' : 'rmv.onu.edu@gmail.com')->setDisplayName('e-mail Администратора (для уведомлений)')->build(),
			],
			'contacts' => [
                $this->getBuilder('public-email')->setValue('rmv.onu.edu@gmail.com')->setDisplayName('E-mail для контактов')->build(),
                $this->getBuilder('main-phone')->setValue('+38 (048) 330 18 79')->setDisplayName('Основной телефон')->build(),
                $this->getBuilder('phone_two')->setValue('+38 (099) 999 99 99')->setDisplayName('Доп. телефон в контактах')->build(),
                $this->getBuilder('phone_three')->setValue('+38 (099) 777 77 77')->setDisplayName('Доп. телефон в контактах (3)')->build(),
                $this->getBuilder('address')->setValue('Бугаївська 21 Одеса, Україна, 65005')->setDisplayName('Основной офис')->build(),
			],
			'social' => [
                $this->getBuilder('facebook')->setValue('facebook')->setDisplayName('Facebook')->build(),
                $this->getBuilder('instagram')->setValue('instagram')->setDisplayName('Instagram')->build(),
                $this->getBuilder('telegram')->setValue('telegram')->setDisplayName('Telegram')->build(),
			],
            'footer' => [
                $this->getBuilder('main_site')->setValue('http://onu.edu.ua/uk/science/rada-molodykh-vchenykh')->setDisplayName('Подраздел на главном сайте ОНУ')->build(),
                $this->getBuilder('text')->setValue(' © 2022 Офіційний сайт Ради Молодих Вчених Одеського національного університету імені І. І. Мечникова')->setDisplayName('Текст')->build(),
                $this->getBuilder('secure_text')->setValue("При використанні матеріалів посилання на сайт обов'язкове")->setDisplayName('Дополнительный Текст')->build()


            ],
			'_' => [
                $this->getBuilder('languages.show_list')->setValue('1')->setTypeCheckbox()->setDisplayName('Отображать список языков')->build(),
                $this->getBuilder('view.layout.enabled_preloader')->setValue((string)(isLocalEnv() ? 0 : 1))->setTypeCheckbox()->setDisplayName('Отображать прелоадер')->build(),
			],
		];
		$groups = array_reverse($groups);
		foreach ($groups as $groupName => $settings) {
			foreach ($settings as $setting) {
				$setting['group'] = $groupName;
				$setting['key'] = implode('.', [$groupName, $setting['key']]);
				if ($this->settingExists($setting['key'])) {
					continue;
				}
				$this->repository->create($setting);
			}
		}
	}

	private function getSettingByKey(string $key): ?Setting
	{
		return Arr::get($this->settings, $key);
	}

	private function settingExists(string $key): bool
	{
		return (bool)$this->getSettingByKey($key);
	}

	private function getBuilder(?string $key):SettingsBuilder
	{
		$builder = new SettingsBuilder;

		if ($key) {
			$builder->setKey($key);
		}

		return $builder;
	}

}
