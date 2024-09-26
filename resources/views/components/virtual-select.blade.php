@php
    /**
    * @var \InvolveDigital\LaravelForms\Inputs\VirtualSelect $field
    */

    $id = $field->getId() ?: $form->getDefaultIdForInput($field);
@endphp

@if($field->getShowLabel())
    @php
        $labelClass = $theme->labels[$field->getThemeType()]['label'] ?? '';

        if ($errors->has($form->formatModelName($field))) {
            $labelClass .= ' ' . $theme->labelError;
        }
    @endphp

    <label for="{{ $id }}" {{ $field->getLabelHtmlAttributes()->merge(['class' => $labelClass]) }}>
        <span class="{{ $theme->labels[$field->getThemeType()]['span'] ?? '' }}">@lang($field->getLabel())</span>

        @if($tooltip = $field->getTooltip())
            <span
                    class="{{ $field->getTooltipIcon() ? $theme->labelTooltipWithIcon : $theme->labelTooltip }}"
                    @if($tooltipIcon = $field->getTooltipIcon())
                        {!! $theme->getTooltipIcon($tooltipIcon) !!}
                    @endif
                    {!! $theme->getTooltip($tooltip) !!}
                    tabindex="0"
            >
        @endif
    </label>
@endif

@php
    $inputClass = $theme->inputs[$field->getThemeType()] ?? '';

    if ($errors->has($form->formatModelName($field))) {
       $inputClass .= ' ' . $theme->inputError;
    }

    $options = [];

    foreach ($field->getOptions() as $optionValue => $title) {
        $options[] = [
            'value' => $optionValue,
            'label' => $field->getTranslateOptions() ? __($title) : $title,
        ];
    }

    $selectedValue = data_get($this, $field->getModel());

    if (is_array($selectedValue)) {
        $selectedValue = json_encode($selectedValue);
    }
@endphp

<div
        wire:ignore
        id="{{ $id }}"
        @change="toggleState[$event.target.id] = $el.value || null; $wire.{{ $field->getModel() }} = $el.value || null"
        x-init="toggleState[$el.id] = $el.value || null; $wire.{{ $field->getModel() }} = $el.value || null"
        data-input-name="{{ $field->getModel() }}"
>
</div>

<script>
  {
    const initVirtualSelect = function () {
      let options = {
        ele: '#{!! $id !!}',
        placeholder: {!! $field->getPrompt() ? "'" . $field->getPrompt() . "'" : "''" !!},
        options: {!! json_encode($options) !!},
        multiple: {!! $field->getIsMultiOptions() ? 'true' : 'false' !!},
        search: true,
        searchNormalize: true,
        selectedValue: {!! $selectedValue ?: 'null' !!},
        noOptionsText: '{{ __($field->getNoOptionsText()) }}',
        noSearchResultsText: '{{ __($field->getNoSearchResultsText()) }}',
        selectAllText: '{{ __($field->getSelectAllText()) }}',
        searchPlaceholderText: '{{ __($field->getSearchPlaceholderText()) }}',
        optionsSelectedText: '{{ __($field->getOptionsSelectedText()) }}',
        optionSelectedText: '{{ __($field->getOptionSelectedText()) }}',
        allOptionsSelectedText: '{{ __($field->getAllOptionsSelectedText()) }}',
        clearButtonText: '{{ __($field->getClearButtonText()) }}',
        moreText: '{{ __($field->getMoreText()) }}',
      };

      @if($onServerSearch = $field->getOnServerSearch())
      options['searchPlaceholderText'] = '{{ trans_choice('admin.virtualSelect.serverSearchPlaceholderText', $field->getMinSearchTermLength()) }}';

      options['onServerSearch'] = function (searchValue, virtualSelect) {
        if (searchValue && searchValue.length >= {{ $field->getMinSearchTermLength() }}) {
          const eventArguments = Object.values({!! json_encode($field->getOnServerSearchArguments()) !!});

          Livewire.dispatchTo(
            '{{ $this->getComponentName() }}',
            '{{ $onServerSearch }}',
            { searchTerm: searchValue, ...eventArguments }
          )
        } else {
          virtualSelect.setServerOptions(options.options);
        }
      };
      @endif

      VirtualSelect.init(options)
    };

    if (typeof VirtualSelect !== 'undefined') {
      initVirtualSelect()
    } else {
      document.addEventListener('DOMContentLoaded', initVirtualSelect)
    }
  }
</script>

@if($onServerSearch = $field->getOnServerSearch())
    <script>
      document.addEventListener('livewire:initialized', function () {
        @this.on('serverOptions:{{ $field->getEventIdForServerSearch() }}', function (options) {
          const select = document.getElementById('{!! $id !!}');

          if (select && select.virtualSelect) {
            const newOptions = Object.entries(options[0])
              .map(([key, value]) => ({ value: key, label: value }));

            select.virtualSelect.setServerOptions(newOptions);

            if (!newOptions.length) {
              select.virtualSelect.reset();
            }
          }
        });
      })
    </script>
@endif

<script>
  document.addEventListener('livewire:initialized', function () {
      @this.on('resetVirtualSelect:{{ $field->getModel() }}', function (options) {
      const select = document.getElementById('{!! $id !!}');

      if (select && select.virtualSelect) {
        if (options) {
          const newOptions = Object.entries(options[0])
            .map(([key, value]) => ({
              value: key,
              label: value
            }));

          select.virtualSelect.setServerOptions(newOptions);
        }

        select.virtualSelect.reset();
      }
    });
  });
</script>

@error($form->formatModelName($field))
<span class="{{ $theme->inputErrorMessage }}">{{ $message }}</span>
{!! $theme->getInputError($message) !!}
@enderror
