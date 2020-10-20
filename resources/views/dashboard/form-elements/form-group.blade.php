<div class="form-group" {{ $errors->has($name)? 'has-error':'' }}>
    <label for="{{ $name }}" class="col-sm-4 control-label">{{ $prettyTitle }}</label>
    <div class="col-sm-8">
        @include('dashboard.form-elements.inputs.' . $type, [
            'name' => $name,
            'value' => $value ?? '',
        ])
    </div>
    @include('site.components.field-error', ['field' => $name])
</div>
