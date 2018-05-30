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
        <h1 class="heading-large">Add worker</h1>

        <form action="{{ route('records.workers.store') }}" method="post">
            @include('form.csrf')

            @foreach($questions as $question)
            @include('form.input-'. $question->field_type,
                [
                    'label' => $question->question,
                    'field' => $question->field,
                    'value' => '',
                    'options' => $question->options,
                    'error' => $errors->first($question->field)
                ])
            @endforeach

            <div class="form-group">
                <input class="button button-start" type="submit" value="Add worker">
            </div>
        </form>

    </div>
</div>
@endsection
