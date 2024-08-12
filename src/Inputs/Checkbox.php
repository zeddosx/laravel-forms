<?php

declare(strict_types=1);

namespace InvolveDigital\LaravelForms\Inputs;

use InvolveDigital\LaravelForms\Traits\THasLabel;
use InvolveDigital\LaravelForms\Traits\THasTooltip;

class Checkbox extends BaseField
{

    use THasLabel;
    use THasTooltip;

    public static function make(string $modelField, ?string $label = null): static
    {
        $input = new static();
        $input->setModel($modelField);
        $input->setLabel($label);
        $input->setThemeType('checkbox');
        $input->setView('laravel-livewire-forms::components.checkbox');

        return $input;
    }

}
