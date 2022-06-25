<?php declare(strict_types=1);

namespace App\Enum;

final class ContentTypeEnum extends AbstractStrEnum
{
    public const DEFAULT = '';

    public const COOPERATION = 'cooperation';
    public const MAIN = 'main';

    public static $enums = [
        self::DEFAULT,
        self::COOPERATION,
        self::MAIN,
    ];

}