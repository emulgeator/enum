<?php

namespace Emul\Enum;

use InvalidArgumentException;
use JsonSerializable;

abstract class EnumAbstract implements JsonSerializable
{
    private $value;

    abstract protected static function getPossibleValues(): array;

    protected function __construct(string $value)
    {
        $this->value = $value;
    }

    public function isEqualTo(self $object): bool
    {
        return (string)$this === (string)$object;
    }

    public function isEqualToString(string $string): bool
    {
        return (string)$this === $string;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

    public static function validate(string $string): bool
    {
        return in_array($string, static::getPossibleValues());
    }

    /**
     * @param string $string
     *
     * @return static
     *
     * @throws InvalidArgumentException
     */
    public static function createFromString(string $string): self
    {
        if (static::validate($string)) {
            return new static($string);
        }

        throw new InvalidArgumentException('Invalid string given: ' . $string);
    }
}
