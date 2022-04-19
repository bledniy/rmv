<?php declare(strict_types=1);

namespace App\Enum;

final class ContentTypeEnum extends AbstractStrEnum
{
    public const DEFAULT = '';

    public const BRAND = 'brands';
    public const VACANCY = 'vacancies';

    public static $enums = [
        self::DEFAULT,
        self::BRAND,
        self::VACANCY
    ];

}