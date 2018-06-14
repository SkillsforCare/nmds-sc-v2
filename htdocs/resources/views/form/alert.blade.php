@if (session('status'))
    <f-alert message="{{ session('status') }}"></f-alert>
@endif