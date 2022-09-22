[![Latest Version on Packagist](https://img.shields.io/packagist/v/uccellolabs/filament-recurrence-input.svg?style=flat-square)](https://packagist.org/packages/uccellolabs/filament-recurrence-input)
[![Semantic Release](https://github.com/uccellolabs/filament-recurrence-input/actions/workflows/release.yml/badge.svg)](https://github.com/uccellolabs/filament-recurrence-input/actions/workflows/release.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/uccellolabs/filament-recurrence-input.svg?style=flat-square)](https://packagist.org/packages/uccellolabs/filament-recurrence-input)

# Filament Recurrence Input

Reccurence input that allows create recurring events

## Installation

You can install the package via composer:

```bash
composer require uccellolabs/filament-recurrence-input
```

## Usage

```php
ReccurrenceInput::make('repeat_every')
->options([
    'd' => 'Days',
    'w' => 'Week',
    'm' => 'Month',
    'y' => 'Year',
])
->...
```

## Credits

- [Uccellolabs](https://github.com/uccellolabs)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
