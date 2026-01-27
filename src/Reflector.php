<?php

namespace Pkly\EnumAttributeUtils;

/**
 * @phpstan-import-type AttributeCacheArray from AttributeCache
 *
 * @internal
 */
class Reflector
{
    /**
     * @param class-string<\UnitEnum> $class
     *
     * @return AttributeCacheArray
     */
    public static function reflect(
        string $class
    ): array {
        try {
            $reflection = new \ReflectionEnum($class);
        } catch (\ReflectionException) {
            return [];
        }

        $loaded = [];

        // cache all attributes now
        foreach ($reflection->getCases() as $case) {
            foreach ($case->getAttributes() as $attributeReflection) {
                // not marked
                if (!is_subclass_of($attributeType = $attributeReflection->getName(), CacheableAttributeInterface::class)) {
                    continue;
                }

                $instance = $attributeReflection->newInstance();

                if (!array_key_exists($attributeType, $loaded)) {
                    $loaded[$attributeType] = [];
                }

                if (!array_key_exists($case->name, $loaded[$attributeType])) {
                    $loaded[$attributeType][$case->name] = [];
                }

                $loaded[$attributeType][$case->name][] = $instance;
            }
        }

        return $loaded;
    }
}
