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
     * @param null|callable(T): bool $filter
     *
     * @return list<T>
     */
    public static function tFindAttributes(
        string $class,
        self $case,
        callable|null $filter = null
    ): array {
        return self::findAttributes($class, $case, $filter);
    }

    /**
     * @template T of CacheableAttributeInterface
     *
     * @param class-string<T> $class
     * @param null|callable(T): bool $filter
     *
     * @return T|null
     */
    public static function tFindAttribute(
        string $class,
        self $case,
        callable|null $filter = null
    ): object|null {
        return self::findAttribute($class, $case, $filter);
    }

    /**
     * @template T of CacheableAttributeInterface
     *
     * @param class-string<T> $class
     * @param null|callable(T): bool $filter
     */
    public static function tAttributeExists(
        string $class,
        self $case,
        callable|null $filter = null
    ): bool {
        return self::attributeExists($class, $case, $filter);
    }

    /**
     * @template T of CacheableAttributeInterface
     *
     * @param class-string<T> $class
     * @param null|callable(T): bool $filter
     *
     * @return list<self>
     */
    public static function tFindCases(
        string $class,
        callable|null $filter = null
    ): array {
        return self::findCases($class, $filter);
    }
}
