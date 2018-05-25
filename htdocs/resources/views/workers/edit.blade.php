@extends('layouts.app')

@section('pageTitle')
    Add Worker
@endsection

@section('breadcrumbs')
<ol>
    <li><a href="{{ route('pages.home') }}">NMDS-SC</a></li>
    <li><a href="{{ route('records.index') }}">Records</a></li>
    <li><a href="{{ route('records.workers') }}">Workers</a></li>
    <li aria-current="page">Add Worker</li>
</ol>
@endsection

@section('content')
<div class="grid-row">
    <div class="column-full">
        <h1 class="heading-large">Adding worker: {{ $worker->meta_data['UNIQUEWORKERID'] }}</h1>
        <f-wizard :questions="{{ json_encode($questions) }}" worker_id="{{ $worker->id }}" ></f-wizard>
    </div>
</div>
@endsection
