@extends('layouts.app')

@section('pageTitle')
    Workers
@endsection

@section('breadcrumbs')
<ol>
    <li><a href="{{ route('pages.home') }}">NMDS-SC</a></li>
    <li><a href="{{ route('records.index') }}">Records</a></li>
    <li><a href="{{ route('records.workers') }}">Workers</a></li>
    <li aria-current="page">Worker</li>
</ol>
@endsection

@section('content')
<div class="grid-row">
    <div class="column-two-thirds">
        <h1 class="heading-large">{{ $worker->meta_data('UNIQUEWORKERID')['answer'] }}</h1>
        <p class="lede">In this worker record:</p>
        <ul class="list list-contents">
            @foreach($questions as $key => $section)
                <li><a href="#{{ $key }}">{{ $key }}</a></li>
            @endforeach
        </ul>
    </div>
</div>
<hr>
<div class="grid-row">
    <div class="column-full">
        <question-index :questions="{{ json_encode($questions) }}" :show_labels="true"></question-index>
    </div>
</div>
@endsection
