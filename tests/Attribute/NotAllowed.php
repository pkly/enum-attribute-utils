<?php

declare(strict_types=1);

namespace Pkly\Tests\EnumAttributeUtils\Attribute;

use Pkly\EnumAttributeUtils\CacheableAttributeInterface;

#[\Attribute(\Attribute::TARGET_CLASS_CONSTANT)]
class NotAllowed implements CacheableAttributeInterface
{
}
