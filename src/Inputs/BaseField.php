<?php

declare(strict_types=1);

namespace InvolveDigital\LaravelLivewireForms\Inputs;

use InvolveDigital\LaravelLivewireForms\Traits\THasHtmlAttributes;
use InvolveDigital\LaravelLivewireForms\Traits\THasLabelHtmlAttributes;
use InvolveDigital\LaravelLivewireForms\Traits\THasView;
use InvolveDigital\LaravelLivewireForms\Traits\THasVisibleIf;
use InvolveDigital\LaravelLivewireForms\Traits\THasWireOptions;
use InvolveDigital\LaravelLivewireForms\Traits\THasWrapperHtmlAttributes;
use Illuminate\Support\Facades\Validator;

abstract class BaseField
{

    use THasHtmlAttributes;
    use THasLabelHtmlAttributes;
    use THasView;
    use THasVisibleIf;
    use THasWireOptions;
    use THasWrapperHtmlAttributes;

    protected ?string $id = null;

    protected string $model;

    protected string $themeType;

    protected array $rules = ['nullable'];

    protected array $customValidationMessages = [];

    protected ?string $customValidationAttribute = null;

    //////////////////////////////////////////////////////// Utils

    public function isRequired(): bool
    {
        $validator = Validator::make([], [$this->model => $this->rules]);

        return $validator->hasRule($this->model, 'Required');
    }

    public function setRequired(bool $required = true, ?string $customValidationMessage = null): static
    {
        if ($required) {
            $this->addRule('required', $customValidationMessage);
        } else {
            $this->removeRule('required');
        }

        return $this;
    }

    //////////////////////////////////////////////////////// Getters / Setters

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getRules(): array
    {
        return $this->rules;
    }

    public function setRules(array $rules): static
    {
        $this->rules = $rules;

        return $this;
    }

    public function addRule(mixed $rule, ?string $customValidationMessage = null): static
    {
        if ($rule) {
            $this->rules[] = $rule;

            if (is_string($rule) && $customValidationMessage) {
                $messageKey = preg_replace('/:.*/', '', $rule);
                $this->customValidationMessages[$messageKey] = $customValidationMessage;
            }
        }

        return $this;
    }

    public function removeRule(string $rule): static
    {
        if (false !== $index = array_search($rule, $this->rules)) {
            unset($this->rules[$index]);
        }

        return $this;
    }

    public function getThemeType(): string
    {
        return $this->themeType;
    }

    public function setThemeType(string $themeType): void
    {
        $this->themeType = $themeType;
    }

    public function getCustomValidationMessages(): array
    {
        return $this->customValidationMessages;
    }

    public function setCustomValidationMessages(array $customValidationMessages): static
    {
        $this->customValidationMessages = $customValidationMessages;

        return $this;
    }

    public function getCustomValidationAttribute(): ?string
    {
        return $this->customValidationAttribute;
    }

    public function setCustomValidationAttribute(?string $customValidationAttribute): static
    {
        $this->customValidationAttribute = $customValidationAttribute;

        return $this;
    }

}
