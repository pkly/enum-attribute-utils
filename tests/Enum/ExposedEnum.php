<?php

declare(strict_types=1);

namespace Pkly\Tests\EnumAttributeUtils\Enum;

use Pkly\EnumAttributeUtils\AttributeControlTrait;
use Pkly\EnumAttributeUtils\CacheableAttributeInterface;
use Pkly\Tests\EnumAttributeUtils\Attribute\CustomStuff;
use Pkly\Tests\EnumAttributeUtils\Attribute\NotAllowed;

enum ExposedEnum
{
    use AttributeControlTrait;

    #[CustomStuff(true)]
    #[CustomStuff(false)]
    case Foo;

    #[NotAllowed]
    case Bar;

    /**
     * @template T of CacheableAttributeInterface
     *
     * @param class-string<T> $class
     *
     * @return list<T>
     */
    public static function tFindAttributes(
        string $class,
        self $case
    ): array {
        return self::findAttributes($class, $case);
    }

    /**
     * @template T of CacheableAttributeInterface
     *
     * @param class-string<T> $class
     *
     * @return T|null
     */
    public static function tFindAttribute(
        string $class,
        self $case
    ): object|null {
        return self::findAttribute($class, $case);
    }

    /**
     * @template T of CacheableAttributeInterface
     *
     * @param class-string<T> $class
     */
    public static function tAttributeExists(
        string $class,
        self $case
    ): bool {
        return self::attributeExists($class, $case);
    }

    /**
     * @template T of CacheableAttributeInterface
     *
     * @param class-string<T> $class
     *
     * @return list<self>
     */
    public static function tFindCases(
        string $class
    ): array {
        return self::findCases($class);
    }
}
