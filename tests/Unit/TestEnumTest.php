<?php

declare(strict_types=1);

namespace Pkly\Tests\EnumAttributeUtils\Unit;

use PHPUnit\Framework\TestCase;
use Pkly\Tests\EnumAttributeUtils\Enum\TestEnum;

class TestEnumTest extends TestCase
{
    public function test(): void
    {
        static::assertEquals(
            [
                TestEnum::Foo,
            ],
            TestEnum::getNotAllowed()
        );

        static::assertTrue(TestEnum::Foo->isNotAllowed());
        static::assertFalse(TestEnum::Bar->isNotAllowed());
    }

    public function testCustom(): void
    {
        static::assertTrue(
            TestEnum::Bar->getCustom()->thing
        );
    }
}
