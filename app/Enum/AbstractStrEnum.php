<?php declare(strict_types=1);

namespace App\Enum;

use InvalidArgumentException;

abstract class AbstractStrEnum
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var array<string>
     */
    public static $enums = [];

    final public function __construct(string $key)
    {
        if (!in_array($key, static::$enums, true)) {
            throw new InvalidArgumentException;
        }

        $this->key = $key;
    }

    public static function create(string $id)
    {
        return new static($id);
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getTitle(): string
    {
        return array_search($this->key, static::$enums);
    }

    protected function isEq(string $key): bool
    {
        return $this->getKey() === $key;
    }

    /**
     * @return array<static>
     */
    public static function getEnums(): array
    {
        foreach (static::$enums as $key) {
            $result[] = new static($key);
        }

        return $result ?? [];
    }

    public function __toString(): string
    {
        return $this->getKey();
    }
}