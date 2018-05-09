<template>
    <div class="form-group {{ $error ? 'form-group-error' : '' }}">
        <label class="form-label" for="{{ $field }}">
            <span class="form-label-bold">{{ $label }}</span>
            @if($error)
            <span class="error-message">{{ $error }}</span>
            @endif
        </label>
        <input class="form-control" id="{{ $field }}" type="text" name="{{ $field }}" value="{{ old($field, $value) }}">
    </div>
</template>