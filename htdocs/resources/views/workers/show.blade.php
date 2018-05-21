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
        <div class="column-full">
            <question-index :questions="{{ json_encode($questions) }}"></question-index>
        </div>
    </div>
</div>
<hr>
<div class="grid-row">

</div>
@endsection
