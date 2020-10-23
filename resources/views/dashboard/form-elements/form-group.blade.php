@if ($type === 'submit')
    <div class="form-group">
        <label class="col-sm-4 control-label">&nbsp;</label>
        <div class="col-sm-8">
            <button type="submit" class="btn btn-primary" name="submit" value="submit">{{ $prettyTitle ?? 'Submit' }}</button>
        </div>
    </div>
@else
    <div class="form-group" {{ $errors->has($name)? 'has-error':'' }}>
        <label for="{{ $name }}" class="col-sm-4 control-label">{{ $prettyTitle }}</label>
        <div class="col-sm-8">
            @include('dashboard.form-elements.inputs.' . $type, [
                'name' => $name,
                'value' => $value ?? '',
            ])
            @include('site.components.field-error', ['field' => $name])
        </div>
    </div>
@endif
