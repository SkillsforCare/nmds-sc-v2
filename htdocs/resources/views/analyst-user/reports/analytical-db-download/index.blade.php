@extends('layouts.app')

@section('pageTitle')
    Analytical DB Download
@endsection

@section('breadcrumbs')
    <ol>
        <li><a href="{{ route('pages.landing') }}">NMDS-SC</a></li>
        <li><a href="{{ route('reports.index') }}">Reports</a></li>
        <li aria-current="page">Analytical DB Download</li>
    </ol>
@endsection

@section('content')
    <div class="grid-row">
        <div class="column-full">
            <h1 class="heading-large">Analytical DB Download</h1>
            <h2 class="heading-medium">Worker Historic Data</h2>
            <div class="s-margin-bottom">
                <form action="" method="post" >
                    @include('form.csrf')
                    <div class="s-flex s-items-end">
                        <div class="s-flex-1">@include('form.input-select', [
                            'label' => 'Month',
                            'field' => 'month',
                            'options' => config('lookups.helpers.monthlist'),
                            'error' => null,
                            'value' => null,
                            'class' => 's-no-margin'])</div>
                        <div class="s-flex-1">@include('form.input-select', [
                            'label' => 'Year',
                            'field' => 'year',
                            'options' => $years,
                            'error' => null,
                            'value' => null,
                            'class' => 's-no-margin'])</div>
                        <div>
                            <button type="submit" class="button button-start">Download (CSV, Zip)</button>
                        </div>
                    </div>
                </form>
            </div>
            <hr>
            <p>
                <form action="{{ route('reports.analytical-db-download.store') }}" method="post">
                    @include('form.csrf')
                    <button type="submit"class="button button-start">Download Live Data (CSV, Zip)</button>
                </form>
            </p>
            <h2 class="heading-medium">Establishment Historic Data</h2>
        </div>
    </div>
@endsection
