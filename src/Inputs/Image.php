<?php

declare(strict_types=1);

namespace InvolveDigital\LaravelForms\Inputs;

class Image extends FileInput
{

    public static function make(
        string $modelField,
        ?string $label = null,
        array $mimeTypes = ['image/webp', 'image/jpeg', 'image/jpg', 'image/png'],
        int $maxFileSize = 4 * 1024,
        bool $isPreviewEnabled = true
    ): static
    {
        $input = new static();
        $input->setModel($modelField);
        $input->setLabel($label);
        $input->setType('file');
        $input->setThemeType('file');
        $input->setView('laravel-livewire-forms::components.file-input');
        $input->setAllowedMimeTypes($mimeTypes);
        $input->setMaxFileSize($maxFileSize);
        $input->setIsPreviewEnabled($isPreviewEnabled);

        return $input;
    }

}
