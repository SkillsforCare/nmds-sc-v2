@extends('layouts.app')

@section('pageTitle')
    Login
@endsection

@section('breadcrumbs')
<ol>
    <li><a href="{{ route('pages.home') }}">NMDS-SC</a></li>
    <li aria-current="page">Login</li>
</ol>
@endsection

@section('content')
<h1 class="heading-medium">Login</h1>
<div action="/home">
    <div class="form-group">
        <label class="form-label" for="form-control-1-3">
            Email
        </label>
        <input class="form-control form-control-1-3" id="email" type="text" name="email">
    </div>
    <div class="form-group">
        <label class="form-label" for="form-control-1-3">
            Password
        </label>
        <input class="form-control form-control-1-3" id="password" type="password" name="password">
    </div>
    <div class="form-group">
        <input class="button" type="submit" value="Login">
    </div>
</div>
@endsection
