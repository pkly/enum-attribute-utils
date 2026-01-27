<?php

namespace Pkly\EnumAttributeUtils;

trait AttributeControlTrait
{
    /**
     * Gets list of instances of specified attribute.
     *
     * @template T of CacheableAttributeInterface
     *
     * @param class-string<T> $class
     *
     * @return list<T>
     */
    protected static function findAttributes(
        string $class,
        \UnitEnum $case
    ): array {
        return AttributeCache::instance()->get(static::class)[$class][$case->name] ?? [];
    }

    /**
     * Gets first instance of specified attribute.
     *
     * @template T of CacheableAttributeInterface
     *
     * @param class-string<T> $class
     *
     * @return T|null
     */
    protected static function findAttribute(
        string $class,
        \UnitEnum $case
    ): object|null {
        return self::findAttributes($class, $case)[0] ?? null;
    }

    /**
     * Checks whether an attribute is set on specified case.
     *
     * @template T of CacheableAttributeInterface
     *
     * @param class-string<T> $class
     */
    protected static function attributeExists(
        string $class,
        \UnitEnum $case
    ): bool {
        return null !== self::findAttribute($class, $case);
    }

    /**
     * Gets list of cases where an attribute exists.
     *
     * @template T of CacheableAttributeInterface
     *
     * @param class-string<T> $class
     *
     * @return list<self>
     */
    protected static function findCases(
        string $class
    ): array {
        return array_map(
            static fn (string $case) => self::{$case},
            array_keys(AttributeCache::instance()->get(static::class)[$class])
        );
    }
}
