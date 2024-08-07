<?php

declare(strict_types=1);

namespace App\Modules\Shared\Lib\Forms\Controls;

use App\Modules\Shared\Lib\Forms\Traits\THasHtmlAttributes;
use App\Modules\Shared\Lib\Forms\Traits\THasView;
use App\Modules\Shared\Lib\Forms\Traits\THasWireOptions;

class Button
{

    use THasHtmlAttributes;
    use THasView;
    use THasWireOptions;

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
