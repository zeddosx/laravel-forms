<?php

declare(strict_types=1);

namespace App\Modules\Shared\Lib\Forms\Controls;

use App\Modules\Shared\Lib\Forms\Traits\THasConfirmOptions;

class ConfirmButton extends Button
{

    use THasConfirmOptions;

    public static function make(
        string $title,
        /** onSuccessHandler */
        ?string $handler = 'onSubmit',
        ?string $onCancelHandler = null,
        string $confirmHandler = 'openConfirmModal',
    ): static
    {
        $button = parent::make($title, null);
        $button->setConfirmMessageOk(__('admin.messageOk'));
        $button->setConfirmMessageCancel(__('admin.messageCancel'));
        $button->setConfirmMessageConfirm(__('admin.messageConfirm'));
        $button->setConfirmOnSuccess($handler);
        $button->setConfirmOnCancel($onCancelHandler);
        $button->setConfirmHandler($confirmHandler);

        return $button;
    }

    public function getHandler(): string
    {
        return $this->getConfirmHandler() . '('
            . '"' . $this->getConfirmOnSuccess() . '",'
            . '"' . $this->getConfirmOnCancel() . '",'
            . json_encode($this->getConfirmData()) . ','
            . '"' . $this->getConfirmComponent() . '",'
            . '"' . $this->getConfirmMessageOk() . '",'
            . '"' . $this->getConfirmMessageCancel() . '",'
            . '"' . $this->getConfirmMessageConfirm() . '"'
            . ')';
    }

}
