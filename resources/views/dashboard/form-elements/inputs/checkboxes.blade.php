@foreach ($options as $possibleValue => $label)
    <label class="form-control">
        <input
            type="checkbox"
            value="{{ $possibleValue }}"
            name="{{ $name }}"
            @if (in_array($possibleValue, $value))
                checked="checked"
            @endif
        > {{ $label }}
    </label>
@endforeach
