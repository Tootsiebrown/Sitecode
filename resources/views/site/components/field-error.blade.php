@if ($errors->has($field))
    <span class="error-message">
        <strong>{{ ucfirst($errors->first($field)) }}</strong>
    </span>
@endif
