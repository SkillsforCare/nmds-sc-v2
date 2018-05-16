@extends('layouts.app')

@section('pageTitle')
    Workers
@endsection

@section('breadcrumbs')
    <ol>
        <li><a href="{{ route('pages.home') }}">NMDS-SC</a></li>
        <li><a href="{{ route('records.index') }}">Records</a></li>
        <li><a href="{{ route('records.workers') }}">Workers</a></li>
        <li aria-current="page">{{ $worker->full_name }}</li>
    </ol>
@endsection

@section('content')
    <div class="grid-row">
        <div class="column-two-thirds">
            <h1 class="heading-large">{{ $worker->full_name }}</h1>
            <p class="lede">In this worker record:</p>
            <ul class="list list-contents">
                @foreach($questions as $key => $section)
                <li><a href="#{{ str_slug($key) }}">{{ $key }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <hr>
    <div class="grid-row">

        @foreach($questions as $key => $question)
        <div class="column-full">
            <h2 class="heading-large" id="{{ str_slug($key) }}">{{ $key }}</h2>

            <dl class="govuk-check-your-answers">
                <question-index section="{{ $key }}" key="json_encode($key)" :questions="{{ json_encode($question) }}"></question-index>
            </dl>

        </div>
        @endforeach
    </div>

@endsection
