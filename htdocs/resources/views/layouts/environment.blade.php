@if(config('app.env') == 'local')
@component('layouts.phase-banner')
    @slot('title')
        ALPHA - Local
    @endslot
    <span>Local development environment</span>
@endcomponent
@endif

@if(config('app.env') == 'development')
@component('layouts.phase-banner')
    @slot('title')
        ALPHA - Development
    @endslot
    <span>This is the development site for ALPHA.</span>
@endcomponent
@endif

@if(config('app.env') == 'uat')
    @component('layouts.phase-banner')
        @slot('title')
            ALPHA - UAT
        @endslot
        <span>This is a new service – your <a href="#">feedback</a> will help us to improve it.</span>
    @endcomponent
@endif

@if(config('app.env') == 'alpha')
@component('layouts.phase-banner')
    @slot('title')
        ALPHA
    @endslot
    <span>This is a new service – your <a href="#">feedback</a> will help us to improve it.</span>
@endcomponent

@endif