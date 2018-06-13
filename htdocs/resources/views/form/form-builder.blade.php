<div>
@include('form.input-'. $field_type,
[
    'label' => $label,
    'field' => $field,
    'help_text' => $help_text,
    'value' => $value,
    'options' => $options,
    'error' => $error
]
)
</div>
