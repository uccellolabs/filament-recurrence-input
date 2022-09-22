<?php

namespace Uccellolabs\FilamentRecurrenceInput;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

class FilamentRecurrenceInputProvider extends PluginServiceProvider
{
    public static string $name = 'filament-recurrence-input';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)->hasViews();
    }
}
