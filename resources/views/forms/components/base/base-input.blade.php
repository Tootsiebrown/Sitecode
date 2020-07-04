<div
    class="{{ classnames(
        'input',
        ['input--required' => $input['required'] ?? false],
        $input['classes'] ?? []
    ) }}"
    data-component="input"
>
    <label
        for="{{ $input['id'] ?? $input['name'] }}"
        class="input__label"
    >
        <span class="input__content">{{ $input['label'] }}</span>
    </label>
    {{ $control }}
</div>
