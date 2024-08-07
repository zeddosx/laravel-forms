<?php

declare(strict_types=1);

namespace App\Modules\Shared\Lib\Forms\Themes;

class UiKitTheme extends BaseFormTheme
{

    public string $labelTooltip = 'label-tooltip uk-form-label__tooltip';

    public string $labelTooltipWithIcon = 'label-tooltip uk-form-label__tooltip uk-icon';

    public string $labelError = 'uk-text-danger';

    public string $button = 'uk-button uk-button-primary';

    public string $buttonGroup = 'form__group uk-margin-bottom form__group--submit';

    public string $buttonsGroup = 'uk-button-group uk-margin-left';

    public string $buttonsDropdown = 'uk-dropdown';

    public string $buttonsDropdownWrapper = 'uk-inline';

    public string $buttonsList = 'uk-nav uk-nav--subnav';

    public string $buttonsListItem = 'uk-text-right';

    public string $buttonsWrapper = 'uk-flex uk-flex-right';

    public string $inputError = 'uk-form-danger';

    public string $inputErrorMessage = 'uk-text-danger uk-text-small';

    public string $imagePreviewWrapper = 'image-preview-wrapper';

    public string $previewImages = 'uk-grid';

    public string $previewImage = 'uk-width-1-4 uk-margin-small-bottom';

    public string $section = 'content rounded uk-background-default';

    public array $inputs = [
        'text' => 'uk-input',
        'textarea' => 'uk-textarea',
        'select' => 'uk-select',
        'checkbox' => 'uk-checkbox',
    ];

    public array $labels = [
        'text' => [
            'label' => 'uk-form-label',
            'span' => 'uk-form-label__text',
        ],
        'textarea' => [
            'label' => 'uk-form-label',
            'span' => 'uk-form-label__text',
        ],
        'select' => [
            'label' => 'uk-form-label',
            'span' => 'uk-form-label__text',
        ],
        'checkbox' => [
            'label' => 'uk-form-label',
            'span' => 'uk-form-label__text',
        ],
        'file' => [
            'label' => 'uk-form-label',
            'span' => 'uk-form-label__text',
        ],
    ];

    public array $inputGroups = [
        'text' => [
            'notRequired' => 'form__group uk-margin-bottom',
            'required' => 'form__group uk-margin-bottom is--required',
        ],
        'textarea' => [
            'notRequired' => 'form__group uk-margin-bottom',
            'required' => 'form__group uk-margin-bottom is--required',
        ],
        'select' => [
            'notRequired' => 'form__group uk-margin-bottom',
            'required' => 'form__group uk-margin-bottom is--required',
        ],
        'checkbox' => [
            'notRequired' => 'form__group uk-margin-bottom form__group--inline',
            'required' => 'form__group uk-margin-bottom form__group--inline is--required',
        ],
        'file' => [
            'notRequired' => 'form__group uk-margin-bottom form__group--upload',
            'required' => 'form__group uk-margin-bottom form__group--upload is--required',
        ],
    ];

    public function getIcon(?string $iconName): string
    {
        if (!$iconName) {
            return '';
        }

        return '<span uk-icon="icon: ' . e($iconName) . '" class="uk-icon"></span>';
    }

    public function getTooltipIcon(?string $iconName): string
    {
        if (!$iconName) {
            return '';
        }

        return 'uk-icon="icon: ' . e($iconName) . '; ratio: 0.8"';
    }

    public function getTooltip(?string $tooltip): string
    {
        if (!$tooltip) {
            return '';
        }

        return 'uk-tooltip="' . e($tooltip) . '" data-pos="top"';
    }

    public function getButtonsDropdown(): string
    {
        return 'uk-dropdown="mode: click; boundary: !.' . $this->buttonsGroup . '; boundary-align: true; pos: bottom-right; offset: 0"';
    }

    public function getInputError(?string $message): string
    {
        return '';
        /* example of flash message
            if (!$message) {
                return '';
            }

            return "<script>UIkit.notification({message: '" . htmlspecialchars($message) . "', status: 'danger' })</script>";
        */
    }

}
