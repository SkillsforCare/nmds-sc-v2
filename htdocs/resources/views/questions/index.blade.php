@extends('layouts.app')

@section('pageTitle')
    Questions
@endsection

@section('breadcrumbs')
    <ol>
        <li><a href="{{ route('pages.home') }}">NMDS-SC</a></li>
        <li aria-current="page">{{ $question_type->name }} questions</li>
    </ol>
@endsection

@section('content')
    <h1 class="heading-xlarge">{{ $question_type->name }} questions</h1>
    <question-index :question_type="{{ $question_type }}"></question-index>
@endsection

@push('footerscripts')
    <script src="/js/question-index.js"></script>
@endpush
