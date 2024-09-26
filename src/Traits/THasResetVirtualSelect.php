<?php

declare(strict_types=1);

namespace InvolveDigital\LaravelForms\Traits;

trait THasResetVirtualSelect
{

    protected function resetVirtualSelect(string $modelToReset, array $options = []): void
    {
        $this->dispatch("resetVirtualSelect:$modelToReset", $options);
    }

}
