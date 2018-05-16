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
    <question-index :questions="{{ json_encode($questions) }}"></question-index>
</div>
@endsection
