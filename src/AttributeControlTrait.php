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
     * @param null|callable(T): bool $filter whether to return attribute
     *
     * @return list<T>
     */
    protected static function findAttributes(
        string $class,
        \UnitEnum $case,
        callable|null $filter = null
    ): array {
        /** @var list<T> $attributes */
        $attributes = AttributeCache::instance()->get(static::class)[$class][$case->name] ?? []; // @phpstan-ignore-line

        if (null !== $filter) {
            foreach ($attributes as $index => $attribute) {
                if (!$filter($attribute)) {
                    unset($attributes[$index]);
                }
            }

            $attributes = array_values($attributes);
        }

        return $attributes;
    }

    /**
     * Gets first instance of specified attribute.
     *
     * @template T of CacheableAttributeInterface
     *
     * @param class-string<T> $class
     * @param null|callable(T): bool $filter whether to return attribute
     *
     * @return T|null
     */
    protected static function findAttribute(
        string $class,
        \UnitEnum $case,
        callable|null $filter = null
    ): object|null {
        return self::findAttributes($class, $case, $filter)[0] ?? null;
    }

    /**
     * Checks whether an attribute is set on specified case.
     *
     * @template T of CacheableAttributeInterface
     *
     * @param class-string<T> $class
     * @param null|callable(T): bool $filter whether to return attribute
     */
    protected static function attributeExists(
        string $class,
        \UnitEnum $case,
        callable|null $filter = null
    ): bool {
        return null !== self::findAttribute($class, $case, $filter);
    }

    /**
     * Gets list of cases where an attribute exists.
     *
     * @template T of CacheableAttributeInterface
     *
     * @param class-string<T> $class
     * @param null|callable(T): bool $filter whether to return case
     *
     * @return list<self>
     */
    protected static function findCases(
        string $class,
        callable|null $filter = null
    ): array {
        $results = AttributeCache::instance()->get(static::class)[$class];

        if (null !== $filter) {
            $keys = [];

            foreach ($results as $case => $attributes) {
                /** @var T $attribute */
                foreach ($attributes as $attribute) {
                    if ($filter($attribute)) {
                        $keys[] = $case;
                        break;
                    }
                }
            }
        } else {
            $keys = array_keys($results);
        }

        return array_map(static fn (string $case) => self::{$case}, $keys);
    }
}
