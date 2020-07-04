@component('forms.components.base.base-input', ['input' => $input])
    @slot('control')
        <input
            type="{{ $input['type'] ?? 'text' }}"
            id="{{ $input['id'] ?? $input['name'] }}"
            name="{{ $input['name'] }}"
            data-element="field"
            data-pretty-name="{{ $input['label'] }}"
            class="input__field"
            placeholder="{{ $input['placeholderText'] ?? '' }}"
            {{ !empty($input['required']) ? 'required' : '' }}
        >
    @endslot
@endcomponent
