<?php

declare(strict_types=1);

namespace Pkly\Tests\EnumAttributeUtils\Attribute;

use Pkly\EnumAttributeUtils\CacheableAttributeInterface;

#[\Attribute(\Attribute::TARGET_CLASS_CONSTANT | \Attribute::IS_REPEATABLE)]
readonly class CustomStuff implements CacheableAttributeInterface
{
    public function __construct(
        public bool $thing
    ) {
    }
}
