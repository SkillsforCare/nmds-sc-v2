@extends('layouts.app')

@section('pageTitle')
   About
@endsection

@section('content')
    <h1 class="heading-xlarge">Welcome</h1>
    <p><a href="{{ route('auth.login') }}">Login</a> or <a href="{{ route('auth.register') }}">Signup</a></p>
@endsection
