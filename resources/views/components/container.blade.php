@php use App\Modules\Shared\Lib\Forms\Controls\LivewireComponent;use App\Modules\Shared\Lib\Forms\Inputs\BaseField;use Illuminate\Support\Str; @endphp
<div
        @if($field->getVisibleIf())x-show="{!! Str::replace('%toggleState%', 'toggleState', $field->getVisibleIfFormatted()) !!}" @endif
        {{ $field->getHtmlAttributes() }}
>
    @if($title = $field->getTitle())
        <h4>@lang($title)</h4>
    @endif

    @foreach($field->getChildren() as $child)
        @continue(!$child)

        @if($child instanceof BaseField)
            @php($baseClass = $theme->inputGroups[$child->getThemeType()][$child->isRequired() ? 'required' : 'notRequired'] ?? '')
            <div
                    @if($child->getVisibleIf())x-show="{!! Str::replace('%toggleState%', 'toggleState', $child->getVisibleIfFormatted()) !!}"
                    @endif
                    {{ $child->getWrapperHtmlAttributes()->merge(['class' => $baseClass]) }}
                    wire:key="{{ $child->getWireKey() ?: Str::slug($child->getModel()) }}"
            >
                @include($child->getView(), ['field' => $child])
            </div>
        @elseif($child instanceof LivewireComponent)
            <div>
                @livewire($child->getName(), ['myWireKey' => $child->getWireKey()] + $child->getParams(), key($child->getWireKey()))
            </div>
        @elseif(method_exists($child, 'getView'))
            @include($child->getView(), ['field' => $child])
        @endif
    @endforeach
</div>
