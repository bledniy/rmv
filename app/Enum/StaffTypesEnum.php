<?php declare(strict_types=1);

namespace App\Enum;

final class StaffTypesEnum extends AbstractStrEnum
{
    public const DEFAULT = '';

    public const HEAD = 'head';
    public const SECY = 'secy';

    public static $enums = [
        self::HEAD => 'Глава',
        self::SECY => 'Секретарь',
    ];

}