<?php

declare(strict_types=1);

namespace App\Modules\Shared\Lib\Forms\Inputs;

use App\Modules\Shared\Lib\Forms\Traits\THasLabel;
use App\Modules\Shared\Lib\Forms\Traits\THasTooltip;

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
