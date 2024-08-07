<?php

declare(strict_types=1);

namespace App\Modules\Shared\Lib\Forms\Inputs;

use App\Modules\Shared\Lib\Forms\Traits\THasLabel;
use App\Modules\Shared\Lib\Forms\Traits\THasTooltip;
use App\Modules\Shared\Lib\Forms\Traits\THasType;

class TextInput extends BaseField
{

    use THasLabel;
    use THasTooltip;
    use THasType;

    public ?int $maxLength = null;

    public static function make(string $modelField, ?string $label = null): static
    {
        $input = new static();
        $input->setModel($modelField);
        $input->setLabel($label);
        $input->setType('text');
        $input->setThemeType('text');
        $input->setView('laravel-livewire-forms::components.text-input');

        return $input;
    }

    public function getMaxLength(): ?int
    {
        return $this->maxLength;
    }

    public function setMaxLength(?int $maxLength): static
    {
        $this->maxLength = $maxLength;

        return $this;
    }

}
