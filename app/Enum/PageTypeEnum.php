<?php declare(strict_types=1);

namespace App\Enum;

final class PageTypeEnum extends AbstractStrEnum
{
    public const WITHOUT_TYPE = '';
    public const ABOUT = 'about';
    public const PRIVACY = 'privacy';

    public static $enums = [
        'Без типа' => self::WITHOUT_TYPE,
        'О нас' => self::ABOUT,
        'Политика конфиденциальности' => self::PRIVACY,
    ];

    public function isWithoutType(): bool
    {
        return $this->isEq(self::WITHOUT_TYPE);
    }

    public function isAbout(): bool
    {
        return $this->isEq(self::ABOUT);
    }

    public function isPrivacy(): bool
    {
        return $this->isEq(self::PRIVACY);
    }

}