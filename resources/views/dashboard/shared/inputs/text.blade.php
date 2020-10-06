<div class="form-group {{ $errors->has($name)? 'has-error':'' }}">
    <label for="{{ $name }}" class="col-sm-3 control-label">
        {{ $label }}
    </label>
    <div class="col-sm-8">
        <input
            class="form-control"
            type="text"
            name="{{ $name }}"
            value="{{ old($name) ?? $defaultValue }}"
        >
        {!! $errors->has($name)? '<p class="help-block">'.$errors->first($name).'</p>':'' !!}
    </div>
</div>
