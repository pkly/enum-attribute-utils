<?php

namespace Pkly\EnumAttributeUtils;

/**
 * @phpstan-type AttributeCache array<class-string<CacheableAttributeInterface>, array<string, list<CacheableAttributeInterface>>>
 *
 * @internal
 */
class AttributeCache
{
    /**
     * Actual attribute cache for all enum cases and all attributes which were loaded.
     *
     * @var array<class-string<\UnitEnum>, AttributeCache>
     */
    private array $cache = [];

    private static self|null $instance = null;

    private function __construct()
    {
    }

    public static function instance(): self
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param class-string<\UnitEnum> $class
     *
     * @return AttributeCache
     */
    public function get(
        string $class
    ): array {
        if (!array_key_exists($class, $this->cache)) {
            $this->cache[$class] = Reflector::reflect($class);
        }

        return $this->cache[$class] ?? [];
    }
}
