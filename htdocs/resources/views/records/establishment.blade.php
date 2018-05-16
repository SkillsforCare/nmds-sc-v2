@extends('layouts.app')

@section('pageTitle')
   Records
@endsection

@section('breadcrumbs')
    <ol>
        <li><a href="{{ route('pages.home') }}">NMDS-SC</a></li>
        <li><a href="{{ route('records.index') }}">Records</a></li>
        <li aria-current="page">Workers</li>
    </ol>
@endsection

@section('content')
    <h1 class="heading-large">Your establishment</h1>
@endsection
