<?php

declare(strict_types=1);

namespace Pkly\Tests\EnumAttributeUtils\Enum;

use Pkly\EnumAttributeUtils\AttributeControlTrait;
use Pkly\Tests\EnumAttributeUtils\Attribute\CustomStuff;
use Pkly\Tests\EnumAttributeUtils\Attribute\NotAllowed;

enum TestEnum
{
    use AttributeControlTrait;

    #[NotAllowed]
    case Foo;

    #[CustomStuff(true)]
    case Bar;

    /**
     * @return list<self>
     */
    public static function getNotAllowed(): array
    {
        return self::findCases(NotAllowed::class);
    }

    public function isNotAllowed(): bool
    {
        return self::attributeExists(NotAllowed::class, $this);
    }

    public function getCustom(): CustomStuff|null
    {
        return self::findAttribute(CustomStuff::class, $this);
    }
}
