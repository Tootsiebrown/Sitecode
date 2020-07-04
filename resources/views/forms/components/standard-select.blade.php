@component('forms.components.base.base-input', ['input' => $input])
    @slot('control')
        <select
            class="input__field input__field--select"
            id="{{ $input['id'] ?? $input['name'] }}"
            name="{{ $input['name'] }}"
            data-element="field"
            data-pretty-name="{{ $input['label'] }}"
            {{ !empty($input['required']) ? 'required' : '' }}
        >
            @foreach ($input['options'] as $option)
                <option
                    value="{{ $option['value'] }}"
                    @if ($option['isDisabled'])
                        disabled
                    @endif
                    @if ($option['isSelected'])
                        selected
                    @endif
                    @if (!empty($option['extras']['class']))
                        class="{{ $option['extras']['class'] }}"
                    @endif
                >{{ $option['label'] }}</option>
            @endforeach
        </select>
    @endslot
@endcomponent
