@extends('layouts.app')

@section('pageTitle')
   Records
@endsection

@section('breadcrumbs')
    <ol>
        <li><a href="{{ route('pages.home') }}">NMDS-SC</a></li>
        <li aria-current="page">Our Records</li>
    </ol>
@endsection

@section('content')
    <h1 class="heading-large">Your Records</h1>
    <div class="notice">
        <i class="icon icon-important">
            <span class="visually-hidden">Warning</span>
        </i>
        <strong><a href="{{ route('records.workers') }}">5 worker records</a> and <a href="{{ route('records.establishment.show', null) }}">your establishment record</a> need your attention.
        </strong></div>
    <div class="grid-row">
        <div class="column-one-half">
            <h2 class="heading-medium">Your establishment</h2>
            <p><a href="{{ route('records.establishment.show', null) }}">View and update establishment records</a></p>
        </div>
        <div class="column-one-half">
            <h2 class="heading-medium">Workers</h2>
            <p><a href="{{ route('records.workers') }}">View and update worker records</a></p>
            <p><a href="#">Add a new worker record</a></p>
            <p><a href="#">Bulk upload worker records</a></p>
        </div>
    </div>
@endsection
