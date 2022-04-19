<?php declare(strict_types=1);

namespace App\Enum;

final class FeedbackTypeEnum extends AbstractStrEnum
{
    public const DEFAULT = 'default';
    public const VACANCY = 'vacancy';

    public static $enums = [
        'Обратная связь' => self::DEFAULT,
        'Вакансия' => self::VACANCY,
    ];

    public function isDefault(): bool
    {
        return $this->isEq(self::DEFAULT);
    }

    public function isVacancy(): bool
    {
        return $this->isEq(self::VACANCY);
    }
}