<?php

namespace Database\Seeders;

use App\Builders\Seeder\TranslateBuilder;
use App\Models\Translate\Translate;
use App\Repositories\TranslateRepository;
use Illuminate\Support\Arr;
use Prettus\Validator\Exceptions\ValidatorException;

class TranslateTableSeeder extends AbstractSeeder
{
	private $translates;
	/**
	 * @var TranslateRepository
	 */
	private $repository;

	public function __construct(TranslateRepository $repository)
	{
		$this->reguard();
		$this->translates = $repository->all()->keyBy('key');
		$this->repository = $repository;
	}

	/**
	 * @throws ValidatorException
	 */
	public function run(): void
	{
		/** @var  $translates array<TranslateBuilder> */
		$translates = [
			$this->getBuilder('global.show-more')->setValue('Показать еще'),
			$this->getBuilder('global.back')->setValue('назад'),
			$this->getBuilder('global.yes')->setValue('Да'),
			$this->getBuilder('global.no')->setValue('Нет'),
			$this->getBuilder('global.work-hours')->setValue('График работы'),
			$this->getBuilder('global.404')->setValue('Страница не найдена'),
			$this->getBuilder('global.404-description')->setTypeTextarea()->setValue('Страница не найдена, попробуйте другой адресс'),
//
			$this->getBuilder('forms.fio')->setValue('ФИО'),
			$this->getBuilder('forms.name')->setValue('Имя'),
			$this->getBuilder('forms.phone')->setValue('Номер телефона'),
			$this->getBuilder('forms.email')->setValue('E-mail'),
			$this->getBuilder('forms.message')->setValue('Комментарий'),
			$this->getBuilder('forms.send')->setValue('Отправить заявку'),
			$this->getBuilder('forms.region')->setValue('Область'),
			$this->getBuilder('forms.district')->setValue('Район'),
			$this->getBuilder('forms.city')->setValue('Город'),
			$this->getBuilder('forms.password')->setValue('Пароль'),
//
			$this->getBuilder('users.email')->setValue('E-mail'),
			$this->getBuilder('users.fio')->setValue('ФИО'),
//
			$this->getBuilder('pages.about')->setValue('О нас'),
			$this->getBuilder('pages.contacts')->setValue('Контакты'),
//
			$this->getBuilder('feedback.throttle-message')->setValue('Отправлять заявку можно не чаще 1 раза в минуту.'),
			$this->getBuilder('feedback.send-success')->setValue('Заявка успешно отправлена'),
			$this->getBuilder('feedback.send-failed')->setValue('Заявка не была отправлена, произошла ошибка на сервере, пожалуйста попробуйте позже, или позвоните нам по одному из номеров телефона'),
			$this->getBuilder('feedback.name')->setValue('Имя'),
			$this->getBuilder('feedback.email')->setValue('Почта'),
		];
		foreach ($translates as $item) {
			if ($this->translateExists($item->getKey())) {
				continue;
			}
			$translate = $this->repository->create($item->build());
			if (!$translate || !is_a($translate, Translate::class)) {
				continue;
			}
			$this->addTranslate($translate->getAttribute('key'), $translate);
		}
	}

	private function getTranslateByKey(string $key): ?Translate
	{
		return Arr::get($this->translates, $key);
	}

	private function translateExists(string $key): bool
	{
		return (bool)$this->getTranslateByKey($key);
	}

	private function getBuilder(?string $key = null): TranslateBuilder
	{
		$builder = new TranslateBuilder;
		if ($key) {
			$builder->setKey($key);
		}

		return $builder;
	}

	private function addTranslate(string $key, Translate $translate): void
	{
		$this->translates->offsetSet($key, $translate);
	}
}
