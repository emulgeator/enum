<?php

declare(strict_types=1);

namespace Emul\Enum\Test\Unit;

use InvalidArgumentException;

class EnumAbstractTest extends TestCaseAbstract
{
    public function enumProviderForComparison(): array
    {
        return [
            [EnumStub::apple(), EnumStub::apple(), true],
            [EnumStub::apple(), EnumStub::pear(), false],
        ];
    }

    /**
     * @dataProvider enumProviderForComparison
     */
    public function testIsEqualTo_shouldOnlyReturnTrueIfStoredValueIsTheSame(EnumStub $first, EnumStub $second, bool $isEqual)
    {
        $this->assertSame($isEqual, $first->isEqualTo($second));
        $this->assertSame($isEqual, $second->isEqualTo($first));
    }

    /**
     * @dataProvider enumProviderForComparison
     */
    public function testIsEqualToString_shouldOnlyReturnTrueIfStoredValueIsTheSame(EnumStub $first, EnumStub $second, bool $isEqual)
    {
        $this->assertSame($isEqual, $first->isEqualToString((string)$second));
        $this->assertSame($isEqual, $second->isEqualToString((string)$first));
    }

    public function testToString_shouldReturnStoredStringValue()
    {
        $pear = EnumStub::pear();

        $this->assertSame(EnumStub::PEAR, (string)$pear);
    }

    public function testValidate_shouldReturnTrueOnlyIfAcceptedValueGiven()
    {
        $this->assertTrue(EnumStub::validate(EnumStub::PEAR));
        $this->assertFalse(EnumStub::validate('invalid'));
    }

    public function testCreateFromStringWhenInvalidGiven_shouldThrowException()
    {
        $this->expectException(InvalidArgumentException::class);

        EnumStub::createFromString('invalid');
    }

    public function testCreateFromString_shouldCreate()
    {
        $pear = EnumStub::createFromString(EnumStub::PEAR);

        $this->assertSame(EnumStub::PEAR, (string)$pear);
    }

    public function testJsonSerialize()
    {
        $pear = EnumStub::pear();

        $this->assertSame(json_encode(EnumStub::PEAR), json_encode($pear));
    }
}
