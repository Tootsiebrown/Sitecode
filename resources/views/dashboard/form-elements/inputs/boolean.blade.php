<div class="checkbox">
    <label>
        <input type="checkbox" name="{{ $name }}" value="1" {{ $checked ? 'checked' : '' }}>
        @if (!empty($secondaryLabel))
            {{ $secondaryLabel }}
        @endif
    </label>
</div>
