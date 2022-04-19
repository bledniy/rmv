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
				$this->getBuilder('contact-email')->setValue(isLocalEnv() ? 'exceptions.manticore@gmail.com' : 'info@untp.com.ua')->setDisplayName('e-mail Администратора (для уведомлений)')->build(),
			],
			'contacts' => [
                $this->getBuilder('public-email')->setValue('info@untp.com.ua')->setDisplayName('E-mail для контактов')->build(),
                $this->getBuilder('main-phone')->setValue('+38 (048) 330 18 79')->setDisplayName('Основной телефон')->build(),
                $this->getBuilder('phone_two')->setValue('+38 (099) 999 99 99')->setDisplayName('Доп. телефон в контактах')->build(),
                $this->getBuilder('phone_three')->setValue('+38 (099) 777 77 77')->setDisplayName('Доп. телефон в контактах (3)')->build(),
                $this->getBuilder('schedule')->setValue('Ежедневно с 8:00 до 20:00')->setDisplayName('График работы')->build(),
                $this->getBuilder('address')->setValue('Бугаївська 21 Одеса, Україна, 65005')->setDisplayName('Основной офис')->build(),
			],
			'vacancy' => [
                $this->getBuilder('hr_name')->setValue('Клачкова Крістіна Олександрівна HR- менеджер')->setDisplayName('Имя HR')->build(),
                $this->getBuilder('hr_phone')->setValue('063-804-40-70')->setDisplayName('Телефон HR')->build(),
                $this->getBuilder('hr_email')->setValue('k.klachkova@untp.com.ua')->setDisplayName('Почта HR')->build(),
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
