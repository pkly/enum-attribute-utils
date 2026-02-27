# Enum Attribute Utils
Helper for easy attribute load/cache/fetch etc. in PHP Enums

[![Packagist Downloads](https://img.shields.io/packagist/dt/pkly/enum-attribute-utils)](https://packagist.org/packages/pkly/enum-attribute-utils)

## Installation

Simply run

```
composer require pkly/enum-attribute-utils
```

## Usage

Example use on an enum.

```php
use Pkly\EnumAttributeUtils\AttributeControlTrait;

enum ExampleEnum
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
    
    public function getCustomWithTrue(): CustomStuff|null
    {
        return self::findAttribute(CustomStuff::class, $this, static fn (CustomStuff $s) => $s->thing);    
    }
}
```

See the trait for more methods.
You can use the `$filter` parameter to better revise results, so that you don't have to create multiple classes to gain the same functionality.

Attributes are preloaded once per enum and stored in AttributeCache.

It's not suggested to touch said class, it's required as enums cannot contain properties.