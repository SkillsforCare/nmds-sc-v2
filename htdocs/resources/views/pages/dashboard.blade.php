@extends('layouts.app')

@section('pageTitle')
   Dashboard
@endsection

@section('breadcrumbs')
    <ol>
        <li><a href="{{ route('pages.home') }}">NMDS-SC</a></li>
        <li aria-current="page">Dashboard</li>
    </ol>
@endsection

@section('content')
    <h1 class="heading-xlarge">Dashboard</h1>
    <a href="{{ route('questions.index', [ 'question_type' => 'establishment' ]) }}">Your establishment questions</a></p>
@endsection
