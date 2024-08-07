<?php

declare(strict_types=1);

namespace InvolveDigital\LaravelLivewireForms\Inputs;

use InvolveDigital\LaravelLivewireForms\Traits\THasLabel;
use InvolveDigital\LaravelLivewireForms\Traits\THasTooltip;

class TextArea extends BaseField
{

    use THasLabel;
    use THasTooltip;

    public ?int $rows = null;

    public ?int $cols = null;

    public ?int $maxLength = null;

    public static function make(string $modelField, ?string $label = null): static
    {
        $input = new static();
        $input->setModel($modelField);
        $input->setLabel($label);
        $input->setThemeType('textarea');
        $input->setView('laravel-livewire-forms::components.text-area');

        return $input;
    }

    //////////////////////////////////////////////////////// Getters / Setters

    public function getRows(): ?int
    {
        return $this->rows;
    }

    public function setRows(?int $rows): static
    {
        $this->rows = $rows;

        return $this;
    }

    public function getCols(): ?int
    {
        return $this->cols;
    }

    public function setCols(?int $cols): static
    {
        $this->cols = $cols;

        return $this;
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
