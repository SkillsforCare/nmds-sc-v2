@extends('layouts.app')

@section('pageTitle')
    Add Worker
@endsection

@section('breadcrumbs')
    <ol>
        <li><a href="{{ route('pages.landing') }}">NMDS-SC</a></li>
        <li aria-current="page">Reports</li>
    </ol>
@endsection

@section('content')
    <div class="grid-row">
        <div class="column-full">
            <h1 class="heading-large">Reports</h1>
        </div>
    </div>
@endsection
