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
            <p>Last updated: 20 February 2018</p>
            <dl class="govuk-check-your-answers">

            @foreach($question as $q)

            <div>
                <dt class="cya-question">
                    {{ $q->number }}. {{ $q->question }}
                </dt>
                <dd class="cya-answer">
                    Joe King
                </dd>
                <dd class="cya-change">
                    <a href="#">
                        Change<span class="visually-hidden"> name</span>
                    </a>
                </dd>
            </div>
            @endforeach

        </dl>
            <p><a href="#">Mark this section as up to date</a></p>
        </div>
        @endforeach
    </div>
@endsection
