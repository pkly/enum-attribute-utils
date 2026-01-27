<?php

declare(strict_types=1);

namespace Pkly\Tests\EnumAttributeUtils\Unit;

use PHPUnit\Framework\TestCase;
use Pkly\Tests\EnumAttributeUtils\Attribute\CustomStuff;
use Pkly\Tests\EnumAttributeUtils\Attribute\NotAllowed;
use Pkly\Tests\EnumAttributeUtils\Enum\ExposedEnum;

class ExposedEnumTest extends TestCase
{
    public function testFindAttributes(): void
    {
        static::assertEmpty(
            ExposedEnum::tFindAttributes(CustomStuff::class, ExposedEnum::Bar)
        );
        static::assertCount(
            2,
            $found = ExposedEnum::tFindAttributes(CustomStuff::class, ExposedEnum::Foo)
        );
        static::assertInstanceOf(
            CustomStuff::class,
            $found[0]
        );
        static::assertTrue(
            $found[0]->thing
        );
        static::assertFalse(
            $found[1]->thing
        );
    }

    public function testFindAttribute(): void
    {
        static::assertNull(
            ExposedEnum::tFindAttribute(CustomStuff::class, ExposedEnum::Bar)
        );
        static::assertInstanceOf(
            CustomStuff::class,
            $output = ExposedEnum::tFindAttribute(CustomStuff::class, ExposedEnum::Foo)
        );
        static::assertTrue(
            $output->thing
        );
    }

    public function testAttributeExists(): void
    {
        static::assertFalse(
            ExposedEnum::tAttributeExists(CustomStuff::class, ExposedEnum::Bar)
        );
        static::assertTrue(
            ExposedEnum::tAttributeExists(NotAllowed::class, ExposedEnum::Bar)
        );

        static::assertTrue(
            ExposedEnum::tAttributeExists(CustomStuff::class, ExposedEnum::Foo)
        );
        static::assertFalse(
            ExposedEnum::tAttributeExists(NotAllowed::class, ExposedEnum::Foo)
        );
    }

    public function testFindCases(): void
    {
        static::assertEquals(
            [
                ExposedEnum::Foo,
            ],
            ExposedEnum::tFindCases(CustomStuff::class)
        );
    }
}
