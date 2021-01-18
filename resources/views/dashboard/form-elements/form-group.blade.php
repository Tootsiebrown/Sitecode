<div
    class="
        form-group
        @if (isset($name)) {{$errors->has($name)? 'has-error':'' }} @endif
        @if (isset($groupClass)) {{ $groupClass }} @endif
    "
    @if (isset($groupAttributes)) {!! $groupAttributes !!} @endif
>
    <label class="col-sm-4 control-label" @if (isset($name)) for="{{ $name }}" @endif>{{ $prettyTitle ?? ' ' }}</label>
    <div class="col-sm-8 form-group__input-container @if (isset($columns) && $columns) columns @endif">
        @switch($type)
            @case ('submit')
                <button type="submit" class="btn btn-primary" name="submit" value="submit">{{ $prettyTitle ?? 'Submit' }}</button>
                @break
            @case ('boolean')
            @case ('select')
            @case ('date')
            @case ('datetime')
            @case ('text')
            @case ('email')
            @case ('note')
                @include('dashboard.form-elements.inputs.' . $type, [
                    'name' => $name,
                    'value' => $value ?? '',
                ])
                @break
            @case ('image')
                @include('dashboard.form-elements.inputs.' . $type, [
                    'name' => $name,
                    'value' => $value ?? '',
                    'imageMata' => $imageMeta,
                    'path' => $path
                ])
                @break
            @case ('checkboxes')
                @include('dashboard.form-elements.inputs.' . $type, [
                    'oldDotLocation' => $oldDotLocation ?? $name,
                    'name' => $name,
                    'options' => $options,
                    'value' => $value
                ])
                @break
        @endswitch

        @if (isset($name))
            @include('site.components.field-error', ['field' => $name])
        @endif
        @if (isset($note))
            <p class="note">{{ $note }}</p>
        @endif
    </div>
</div>
