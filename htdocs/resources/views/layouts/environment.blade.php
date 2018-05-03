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
<div class="phase-banner">
    <p>
        <strong class="phase-tag">ALPHA - Development</strong>
        <span>This is a new service – your <a href="#">feedback</a> will help us to improve it.</span>
    </p>
</div>
@endif

@if(config('app.env') == 'alpha')
<div class="phase-banner">
    <p>
        <strong class="phase-tag">ALPHA</strong>
        <span>This is a new service – your <a href="#">feedback</a> will help us to improve it.</span>
    </p>
</div>
@endif