@component('forms.components.base.base-input', ['input' => $input])
    @slot('control')
        <textarea
            id="{{ $input['id'] ?? $input['name'] }}"
            name="{{ $input['name'] }}"
            data-element="field"
            data-pretty-name="{{ $input['label'] }}"
            class="input__field input__field--textarea"
            placeholder="{{ $input['placeholderText'] ?? '' }}"
            {{ !empty($input['required']) ? 'required' : '' }}
        ></textarea>
    @endslot
@endcomponent
