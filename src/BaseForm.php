<?php

declare(strict_types=1);

namespace InvolveDigital\LaravelLivewireForms;

use InvolveDigital\LaravelLivewireForms\Controls\IHasChildren;
use InvolveDigital\LaravelLivewireForms\Inputs\BaseField;
use InvolveDigital\LaravelLivewireForms\Inputs\FileInput;
use InvolveDigital\LaravelLivewireForms\Themes\BaseFormTheme;
use InvolveDigital\LaravelLivewireForms\Themes\UiKitTheme;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Livewire\Component;

abstract class BaseForm extends Component
{

    protected bool $isLivewire = true;

    /** @return BaseField[] */
    abstract protected function getFields(): array;

    abstract protected function getButtons(): array;

    public function render(): View
    {
        $params = [
            'form' => $this,
            'theme' => $this->getTheme(),
            'fields' => $this->getFields(),
            'buttons' => $this->getButtons(),
        ];

        return view('laravel-livewire-forms::index', $params);
    }

    public function getIsLivewire(): bool
    {
        return $this->isLivewire;
    }

    public function setIsLivewire(bool $isLivewire): void
    {
        $this->isLivewire = $isLivewire;
    }

    public function getFormName(): string
    {
        $namespaceParts = explode('\\', static::class);

        return 'form-' . Str::camel(end($namespaceParts));
    }

    public function getField(string $model): ?BaseField
    {
        static $fields = [];

        if (!$fields) {
            $fields = $this->getFields();
        }

        foreach ($fields as $field) {
            if ($field instanceof IHasChildren) {
                $match = $this->getFieldFromParent($field, $model);

                if ($match) {
                    return $match;
                }
            }

            if ($field instanceof BaseField && $field->getModel() === $model) {
                return $field;
            }
        }

        return null;
    }

    public function getFieldFromParent(IHasChildren $parent, string $model): ?BaseField
    {
        $children = $parent->getChildren();
        $match = null;

        foreach ($children as $field) {
            if ($field instanceof IHasChildren && !$match) {
                $match = $this->getFieldFromParent($field, $model);
            }

            if ($field instanceof BaseField && $field->getModel() === $model) {
                return $field;
            }
        }

        return $match;
    }

    public function formatModelName(BaseField $field): string
    {
        $name = $field->getModel();

        if ($field instanceof FileInput && $field->getIsMultipleFiles()) {
            $name .= '.*';
        }

        return $name;
    }

    public function getDefaultIdForInput(BaseField $field): string
    {
        return $this->getFormName() . '-' . Str::camel(Str::replace('.', '-', $field->getModel()));
    }

    public function getRules(?IHasChildren $container = null)
    {
        $rules = [];

        $fields = $container ? $container->getChildren() : $this->getFields();

        foreach ($fields as $field) {
            if ($field instanceof BaseField) {
                $model = $this->formatModelName($field);

                $rules[$model] = $field->getRules();
            } elseif ($field instanceof IHasChildren) {
                $rules = array_merge($rules, $this->getRules($field));
            }
        }

        return $rules;
    }

    //////////////////////////////////////////////////////// Protected

    protected function getTheme(): BaseFormTheme
    {
        return new UiKitTheme();
    }

    protected function getMessages(?IHasChildren $container = null): array
    {
        $messages = [];

        $fields = $container ? $container->getChildren() : $this->getFields();

        foreach ($fields as $field) {
            if ($field instanceof BaseField) {
                $model = $this->formatModelName($field);

                foreach ($field->getCustomValidationMessages() as $key => $message) {
                    $messages[$model . '.' . $key] = $message;
                }
            } elseif ($field instanceof IHasChildren) {
                $messages = array_merge($messages, $this->getMessages($field));
            }
        }

        return $messages;
    }

    protected function getValidationAttributes(?IHasChildren $container = null): array
    {
        $attributes = [];

        $fields = $container ? $container->getChildren() : $this->getFields();

        foreach ($fields as $field) {
            if ($field instanceof BaseField) {
                $originalModel = $this->formatModelName($field);

                if ($customAttribute = $field->getCustomValidationAttribute()) {
                    $attributes[$originalModel] = $customAttribute;

                    continue;
                }

                if (method_exists($field, 'getLabel') && $label = $field->getLabel()) {
                    $attributes[$originalModel] = __($label);

                    continue;
                }

                /*
                 * "values.tags.159" -> "tag"
                 * "values.videos.new-video-test" -> "video"
                 */
                $parts = str($field->getModel())
                    ->explode('.')
                    ->take(-2)
                    ->values();

                $firstPart = $parts[0] ?? null;
                $secondPart = $parts[1] ?? null;

                if (null === $firstPart && null === $secondPart) {
                    $model = $field->getModel();
                } elseif (!$secondPart || is_numeric($secondPart) || str_starts_with($secondPart, 'new-')) {
                    $model = Str::singular($firstPart);
                } else {
                    $model = $secondPart;
                }

                if (!is_numeric($model) && !str_starts_with($model, 'new-')) {
                    $attributes[$originalModel] = __('validation.attributes.' . $model);
                }
            } elseif ($field instanceof IHasChildren) {
                $attributes = array_merge($attributes, $this->getValidationAttributes($field));
            }
        }

        return $attributes;
    }

    protected function resetVirtualSelect(array|string $modelsToReset, array $options = []): void
    {
        if (!is_array($modelsToReset)) {
            $this->dispatch("resetVirtualSelect:$modelsToReset", $options);
        } else {
            foreach ($modelsToReset as $modelToReset) {
                $this->dispatch("resetVirtualSelect:$modelToReset");
            }
        }
    }

}
