<?php declare(strict_types=1);

namespace App\Enum;

use InvalidArgumentException;

abstract class AbstractIntEnum
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var array<string>
     */
    public static $enums = [];

    final public function __construct(int $key)
    {
        if (!in_array($key, static::$enums, true)) {
            throw new InvalidArgumentException;
        }

        $this->key = $key;
    }

    public function getKey(): int
    {
        return $this->key;
    }

    public function getTitle(): string
    {
        return array_search($this->key, static::$enums, true);
    }

    protected function isEq(int $key): bool
    {
        return $this->getKey() === $key;
    }

    /**
     * @return array<static>
     */
    public static function getEnums(): array
    {
        foreach (static::$enums as $key) {
            $result[] = new static((int)$key);
        }

        return $result ?? [];
    }

    public function __toString(): string
    {
        return (string)$this->getKey();
    }
}