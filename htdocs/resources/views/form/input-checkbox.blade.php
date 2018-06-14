<div class="form-group {{ $error ? 'form-group-error' : '' }} {{ isset($class) ? $class : '' }}">
    <div class="multiple-choice">
        <input id="{{ $field }}" name="{{ $field }}" type="checkbox" value="{{ old($field, $value) }}" {{ $checked ? 'checked' : '' }}>
        <label for="{{ $field }}">{{ $label }}</label>
    </div>
</div>