@php use InvolveDigital\LaravelForms\Controls\LivewireComponent;use InvolveDigital\LaravelForms\Inputs\BaseField; @endphp

<{{$field->getType()}}
    {{ $field->getHtmlAttributes() }}
>
    @lang($field->getTitle())

    @if($field->getHtml())
        {!! $field->getHtml() !!}
    @elseif($field->getChildren())
        @foreach($field->getChildren() as $child)
            @continue(!$child)

            @if($child instanceof BaseField)
                @php($baseClass = $theme->inputGroups[$child->getThemeType()][$child->isRequired() ? 'required' : 'notRequired'] ?? '')
                <div
                        @if($child->getVisibleIf())x-show="{!! Str::replace('%toggleState%', 'toggleState', $child->getVisibleIfFormatted()) !!}"
                        @endif
                        {{ $child->getWrapperHtmlAttributes()->merge(['class' => $baseClass]) }}
                        wire:key="{{ $child->getWireKey() ?: \Illuminate\Support\Str::slug($child->getModel()) }}"
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
   @endif
</{{$field->getType()}}>
