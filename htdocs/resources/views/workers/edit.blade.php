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
        <h1 class="heading-large">Adding worker: {{ $worker->meta_data['UNIQUEWORKERID'] }}</h1>

        <div class="f-wizard">
            <div class="f-navigation">
                @foreach($categories->sections as $section)
                <div class="f-section">
                    <h2>{{ $section->name }}</h2>
                    <ul>
                        @foreach($section->groups as $group)
                        <li>
                            @if($group->slug !== $groupQuestion->slug)
                            <span><a href="{{ route('records.workers.edit', [ 'worker' => $worker, 'group' => $group->slug] ) }}">{{ $group->name }}</a></span>
                            @else
                            <span><strong>{{ $group->name }}</strong></span>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
                <div class="f-section">
                    <h2><a href="#">Summary</a></h2>
                </div>
            </div>
            <div class="f-content">
                @include('form.alert')
                <form id="question-form" action="{{ route('question_answer_bulk_update', $worker) }}" method="post">
                    @include('form.put')
                    @include('form.csrf')
                    <div class="f-header">
                        <h3 class="heading-medium">{{ $groupQuestion->section->name }}</h3>
                        @if($groupQuestion->name !== $groupQuestion->section->name)
                        <small>{{ $groupQuestion->name }}</small>
                        @endif
                    </div>
                    <div class="f-form">
                        @foreach($groupQuestion->questions as $question)
                            @include('form.form-builder', [
                              'label' => $question->question,
                              'field' => $question->field,
                              'field_type' => $question->field_type,
                              'help_text' => $question->help_text,
                              'options' => $question->options,
                              'error' => $errors->first($question->field),
                              'value' => $question->answer ? $question->answer->answer : ''
                            ])
                        @endforeach
                    </div>
                    <div class="f-footer">
                        @if($groupQuestion->prev_group)
                        <a href="{{ route('records.workers.edit', [ 'worker' => $worker, 'group' => $groupQuestion->prev_group->slug] ) }}">Back</a>
                        @else
                        <a>Back</a>
                        @endif
                        <a href="#" onclick="event.preventDefault();
                                 document.getElementById('question-form').submit();">
                            Save progress
                        </a>
                        @if($groupQuestion->next_group)
                        <input type="submit" name="saveNext" class="button" value="Next" />
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
