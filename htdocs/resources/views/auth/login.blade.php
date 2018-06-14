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

<form action="{{ route('login') }}" method="post">
    @include('form.csrf')
    @include('form.input-text', [ 'label' => 'Username', 'field' => 'username', 'value' => '', 'error' => $errors->first('username') ])
    @include('form.input-password', [ 'label' => 'Password', 'field' => 'password', 'error' => $errors->first('password') ])
    <div class="form-group">
        <input class="button" dusk="login-button" type="submit" value="Login">
    </div>
</form>

<p>
    <a href="{{ route('register') }}">Register for an account</a>
</p>



@endsection
