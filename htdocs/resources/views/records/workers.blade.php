@extends('layouts.app')

@section('pageTitle')
Workers
@endsection

@section('breadcrumbs')
<ol>
    <li><a href="{{ route('pages.home') }}">NMDS-SC</a></li>
    <li><a href="{{ route('records.index') }}">Records</a></li>
    <li aria-current="page">Workers</li>
</ol>
@endsection

@section('content')
<h1 class="heading-large">Your {{ $workers->count() }} workers</h1>
<div class="grid-row">
    <div class="column-full">
        <table>
            <thead>
            <tr>
                <th scope="row">Name / ID&nbsp;&nbsp;<i class="arrow down"></i></th>
                <th>Job role&nbsp;&nbsp;<i class="arrow down"></i></th>
                <th>Attention required&nbsp;&nbsp;<i class="arrow down"></i></th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            @forelse($workers as $worker)
            <tr>
                <td>{{ $worker->full_name }}</td>
                <td>{{ $worker->job_role }}</td>
                <td></td>
                <td><a href="{{ route('records.workers.show', $worker) }}">View</a></td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No workers found!</td>
            </tr>
            @endforelse
            </tbody>
        </table>
        <p><a href="#">Show more workers</a></p>
    </div>
</div>
@endsection
