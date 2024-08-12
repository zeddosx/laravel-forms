<?php

declare(strict_types=1);

namespace InvolveDigital\LaravelForms\Traits;

use InvolveDigital\LaravelForms\Inputs\VirtualSelect;
use ReflectionMethod;

trait THasServerSearchVirtualSelect
{

    protected function sendNewVirtualSelectOptions(array $options): void
    {
        $calledFromData = debug_backtrace(~DEBUG_BACKTRACE_PROVIDE_OBJECT & ~DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1];

        $serverSearchArguments = [];

        $calledFromFunction = new ReflectionMethod($calledFromData['class'], $calledFromData['function']);
        foreach ($calledFromFunction->getParameters() as $parameter) {
            if ($parameter->getName() === 'searchTerm') {
                unset($calledFromData['args'][$parameter->getPosition()]);
            } else {
                $serverSearchArguments[$parameter->getName()] = $calledFromData['args'][$parameter->getPosition()];
            }
        }

        $onServerSearchHandler = $calledFromData['function'];

        $eventId = VirtualSelect::generateEventIdForServerSearch($onServerSearchHandler, $serverSearchArguments);

        $this->dispatch("serverOptions:$eventId", $options);
    }

}
