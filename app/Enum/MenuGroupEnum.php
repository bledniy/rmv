<?php declare(strict_types=1);

namespace App\Enum;

final class MenuGroupEnum extends AbstractIntEnum
{
    public const DEFAULT = self::MAIN_MENU;
    public const MAIN_MENU = 0;

    public static $enums = [
        'Основное меню' => self::MAIN_MENU,
    ];

    public function isMainMenu(): bool
    {
        return $this->isEq(self::MAIN_MENU);
    }

}