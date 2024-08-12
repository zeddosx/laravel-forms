<?php

declare(strict_types=1);

namespace InvolveDigital\LaravelForms\Controls;

use InvolveDigital\LaravelForms\Traits\THasHtmlAttributes;
use InvolveDigital\LaravelForms\Traits\THasView;
use InvolveDigital\LaravelForms\Traits\THasVisibleIf;

class Container implements IHasChildren
{

    use THasHtmlAttributes;
    use THasView;
    use THasVisibleIf;

    protected ?string $title = null;

    protected array $children = [];

    public static function make(array $children): static
    {
        $container = new static();
        $container->setChildren($children);
        $container->setView('laravel-livewire-forms::components.container');

        return $container;
    }

    public function getChildren(): array
    {
        return $this->children;
    }

    public function addChild(mixed $child): static
    {
        $this->children[] = $child;

        return $this;
    }

    public function setChildren(array $children): static
    {
        $this->children = $children;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

}
