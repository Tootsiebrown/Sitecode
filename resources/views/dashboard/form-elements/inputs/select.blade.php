<select class="select2" name="{{ $name }}">
    @foreach($options as $optionValue => $optionLabel)
        <option value="{{ $optionValue }}" {{ $value === old('usage_restrictions', $optionValue) ? 'selected' : '' }}>
            {{ $optionLabel }}
        </option>
    @endforeach
</select>
