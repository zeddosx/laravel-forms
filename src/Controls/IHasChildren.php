<?php

declare(strict_types=1);

namespace InvolveDigital\LaravelLivewireForms\Controls;

interface IHasChildren
{

    public function getChildren(): array;

    public function setChildren(array $children): static;

}
