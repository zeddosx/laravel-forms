<?php

declare(strict_types=1);

namespace App\Modules\Shared\Lib\Forms\Controls;

interface IHasChildren
{

    public function getChildren(): array;

    public function setChildren(array $children): static;

}
