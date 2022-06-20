<?php declare(strict_types=1);

namespace App\Enum;

final class SliderTypeEnum extends AbstractStrEnum
{
    public const MAIN_PAGE = 'MAIN_PAGE';

    public static $enums = [
        self::MAIN_PAGE,
    ];

    public function isMainPage(): bool
    {
        return $this->isEq(self::MAIN_PAGE);
    }

}