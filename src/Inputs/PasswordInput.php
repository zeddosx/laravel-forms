<?php

declare(strict_types=1);

namespace App\Modules\Shared\Lib\Forms\Inputs;

class PasswordInput extends TextInput
{

    public static function make(string $modelField, ?string $label = null): static
    {
        $input = parent::make($modelField, $label);
        $input->setType('password');
        $input->setThemeType('text');

        return $input;
    }

}
