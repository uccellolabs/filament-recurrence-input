<?php

namespace Uccellolabs\FilamentRecurrenceInput;

use Closure;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Str;
use Phpsa\FilamentPasswordReveal\Traits\CanCopy;
use Phpsa\FilamentPasswordReveal\Traits\CanGenerate;

class RecurrenceInput extends Select
{
    protected string $view = 'filament-recurrence-input::recurrence-input';

    public function multiple(bool | Closure $condition = true): static
    {
        $this->isMultiple = false; // Force false

        return $this;
    }
}
