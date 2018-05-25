<div class="form-group {{ $error ? 'form-group-error' : '' }}">
    <label class="form-label" for="{{ $field }}">
        <span class="form-label-bold">{{ $label }}</span>
        @if($error)
        <span class="error-message">{{ $error }}</span>
        @endif
    </label>

    <select class="form-control" name="{{ $field }}" id="{{ $field }}">
        @foreach($options as $option)
        <option value="{{ $option['value'] }}">{{ $option['text'] }}</option>
        @endforeach
    </select>
</div>