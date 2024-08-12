<?php

declare(strict_types=1);

namespace InvolveDigital\LaravelForms\Controls;

use InvolveDigital\LaravelForms\Traits\THasHtmlAttributes;
use InvolveDigital\LaravelForms\Traits\THasView;

class LinkButton
{

    use THasHtmlAttributes;
    use THasView;

    protected string $title;

    protected ?string $url;

    public static function make(string $title, ?string $url = null): static
    {
        $link = new static();
        $link->setTitle($title);
        $link->setUrl($url);
        $link->setView('laravel-livewire-forms::components.link-button');

        return $link;
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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    public function getTarget(): ?string
    {
        return $this->getHtmlAttributes()->get('target');
    }

    public function setTarget(?string $target): static
    {
        $this->setHtmlAttribute('target', $target);

        return $this;
    }

}
