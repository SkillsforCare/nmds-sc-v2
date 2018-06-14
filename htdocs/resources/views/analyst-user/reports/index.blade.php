@extends('layouts.app')

@section('pageTitle')
    Reports
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
            <p><a href="{{ route('reports.analytical-db-download') }}">Analytical DB Download</a></p>
        </div>
    </div>
@endsection
