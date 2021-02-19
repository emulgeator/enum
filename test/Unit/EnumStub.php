<?php

declare(strict_types=1);

namespace Emul\Enum\Test\Unit;

use Emul\Enum\EnumAbstract;

class EnumStub extends EnumAbstract
{
    const APPLE = 'apple';
    const PEAR = 'pear';

    public static function apple(): EnumStub
    {
        return new self(self::APPLE);
    }

    public static function pear(): EnumStub
    {
        return new self(self::PEAR);
    }

    protected static function getPossibleValues(): array
    {
        return [
            self::APPLE,
            self::PEAR
        ];
    }

}
