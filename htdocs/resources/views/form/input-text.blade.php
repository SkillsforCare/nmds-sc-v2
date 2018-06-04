<div class="form-group {{ $error ? 'form-group-error' : '' }}">
    <label class="form-label" for="{{ $field }}">
        <span class="form-label-bold">{{ $label }}</span>
        @if(!empty($help_text))
        <span class="form-hint">{{ $help_text }}</span>
        @endif
        @if($error)
        <span class="error-message">{{ $error }}</span>
        @endif
    </label>
    <input class="form-control" id="{{ $field }}" type="text" name="{{ $field }}" value="{{ old($field, $value) }}">
</div>