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

    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusantium architecto autem consequuntur deleniti deserunt, distinctio ducimus esse id illum impedit in iste laboriosam quasi quia quod ratione tempora voluptatem.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi, aperiam autem beatae dignissimos distinctio dolorem doloribus eaque earum enim error hic laborum molestias nostrum odio quidem similique sunt totam voluptatem!</p>

    <question-index :question_type="{{ $question_type }}"></question-index>
@endsection

@push('footerscripts')
    <script src="/js/question-index.js"></script>
@endpush
