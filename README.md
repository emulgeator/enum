# enum
A very simple library allowing you to define enums in PHP

## Getting Started

### Installing
Run `composer require emulgeator/enum` to add this library as a dependency to your project

## Usage

Just extend the class, define the possible values, and crate your own `constructors`:
```php
use Emul\Enum\EnumAbstract;

class Status extends EnumAbstract
{
    const ENABLED  = 'enabled';
    const DISABLED = 'disabled';
    const DELETED  = 'deleted';

    public static function enabled(): self
    {
        return new self(self::ENABLED);
    }

    public static function disabled(): self
    {
        return new self(self::DISABLED);
    }

    public static function deleted(): self
    {
        return new self(self::DELETED);
    }

    protected static function getPossibleValues(): array
    {
        return [
            self::ENABLED,
            self::DISABLED,
            self::DELETED,
        ];
    }
}

$enabled  = Status::enabled();
$disabled = Status::disabled();
$deleted  = Status::createFromString('invalid'); // Throws exception

$enabled->isEqualToString('disabled'); // false
$enabled->isEqualTo($disabled); // false

```

