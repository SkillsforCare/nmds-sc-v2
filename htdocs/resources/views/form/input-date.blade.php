<div class="form-group {{ $error ? 'form-group-error' : '' }}">
    <fieldset class="{{ count($options) < 3 ? 'inline' : '' }}">
        <legend>
            <span class="form-label-bold">{{ $label }}</span>
            @if(!empty($help_text))
            <span class="form-hint">{{ $help_text }}</span>
            @endif
            @if($error)
            <span class="error-message">{{ $error }}</span>
            @endif
        </legend>

        <div class="form-date">
            <div class="form-group form-group-day">
                <label class="form-label" for="{{ $field }}-day">Day</label>
                <input class="form-control" id="{{ $field }}-day" name="{{ $field }}-day" type="number" pattern="[0-9]*">
            </div>
            <div class="form-group form-group-month">
                <label class="form-label" for="{{ $field }}-month">Month</label>
                <input class="form-control" id="{{ $field }}-month" name="{{ $field }}-month" type="number" pattern="[0-9]*">
            </div>
            <div class="form-group form-group-year">
                <label class="form-label" for="{{ $field }}-year">Year</label>
                <input class="form-control" id="{{ $field }}-year" name="{{ $field }}-year" type="number" pattern="[0-9]*">
            </div>
        </div>
    </fieldset>
</div>