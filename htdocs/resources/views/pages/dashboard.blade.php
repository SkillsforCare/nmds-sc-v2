@extends('layouts.app')

@section('pageTitle')
   About
@endsection

@section('breadcrumbs')
    <ol>
        <li><a href="{{ route('pages.home') }}">NMDS-SC</a></li>
        <li aria-current="page">Dashboard</li>
    </ol>
@endsection

@section('content')
    <h1 class="heading-xlarge">Dashboard</h1>
@endsection
