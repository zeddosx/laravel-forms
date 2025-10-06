<?php

declare(strict_types=1);

namespace InvolveDigital\LaravelForms\Controls;

use InvolveDigital\LaravelForms\Traits\THasHtmlAttributes;
use InvolveDigital\LaravelForms\Traits\THasView;
use InvolveDigital\LaravelForms\Traits\THasVisibleIf;
use InvolveDigital\LaravelForms\Traits\THasWireOptions;

class Button
{

    use THasHtmlAttributes;
    use THasView;
    use THasWireOptions;
    use THasVisibleIf;

    protected string $title;

    protected ?string $handler = null;

    public static function make(string $title, ?string $handler = 'onSubmit'): static
    {
        $button = new static();
        $button->setTitle($title);
        $button->setHandler($handler);
        $button->setWireType('click');
        $button->setWireMode('prevent');
        $button->setView('laravel-livewire-forms::components.button');

        return $button;
    }

    //////////////////////////////////////////////////////// Getters / Setters

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getHandler(): ?string
    {
        return $this->handler;
    }

    public function setHandler(?string $handler): static
    {
        $this->handler = $handler;

        return $this;
    }

}
