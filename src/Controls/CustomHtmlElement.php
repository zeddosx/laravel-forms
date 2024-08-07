<?php

declare(strict_types=1);

namespace InvolveDigital\LaravelLivewireForms\Controls;

use InvolveDigital\LaravelLivewireForms\Traits\THasHtmlAttributes;
use InvolveDigital\LaravelLivewireForms\Traits\THasView;

class CustomHtmlElement implements IHasChildren
{

    use THasHtmlAttributes;
    use THasView;

    protected string $title;

    protected string $type;

    protected array $children = [];

    protected ?string $html = null;

    protected ?string $tooltip = null;

    public static function make(
        string $title = '',
        string $type = 'span',
        array $children = [],
        ?string $customHtmlClasses = null,
        ?string $html = null,
        ?string $tooltip = null,
    ): static
    {
        $customHtmlElement = new static();
        $customHtmlElement->setTitle($title);
        $customHtmlElement->setView('laravel-livewire-forms::components.custom-html-element');
        $customHtmlElement->setType($type);
        $customHtmlElement->setChildren($children);
        $customHtmlElement->setHtml($html);
        $customHtmlElement->setTooltip($tooltip);

        if ($customHtmlClasses) {
            $customHtmlElement->setHtmlAttribute('class', $customHtmlClasses);
        }

        return $customHtmlElement;
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

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getChildren(): array
    {
        return $this->children;
    }

    public function setChildren(array $children): static
    {
        $this->children = $children;

        return $this;
    }

    public function getHtml(): ?string
    {
        return $this->html;
    }

    public function setHtml(?string $html): static
    {
        $this->html = $html;

        return $this;
    }

    public function getTooltip(): ?string
    {
        return $this->tooltip;
    }

    public function setTooltip(?string $tooltip): static
    {
        $this->tooltip = $tooltip;

        return $this;
    }

}
