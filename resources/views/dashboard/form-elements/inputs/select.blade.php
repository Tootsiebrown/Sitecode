<select class="select2" name="{{ $name }}" @if (isset($inputAttributes)) {!! $inputAttributes !!} @endif>
    @foreach($options as $optionValue => $optionLabel)
        <option value="{{ $optionValue }}" @if ($optionValue == old($name, $value)) {{ 'selected' }} @endif>
            {{ $optionLabel }}
        </option>
    @endforeach
</select>
