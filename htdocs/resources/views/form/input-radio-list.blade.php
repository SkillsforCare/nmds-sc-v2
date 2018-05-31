<div class="form-group {{ $error ? 'form-group-error' : '' }}">
    <fieldset class="{{ count($options) < 4 ? 'inline' : '' }}">
        <legend>
            <span class="form-label-bold">{{ $label }}</span>
        </legend>

        @if(!empty($help_text))
            <span class="form-hint">{{ $help_text }}</span>
        @endif
        @if($error)
            <span class="error-message">{{ $error }}</span>
        @endif

        @foreach($options as $option)
        <div class="multiple-choice">
            <input id="{{ $field }}-{{ $option['value'] }}" type="radio"
                   name="{{ $field }}"
                   value="{{ $option['value'] }}"
            >
            <label for="{{ $field }}">{{ $option['text'] }}</label>
        </div>
        @endforeach
    </fieldset>
</div>