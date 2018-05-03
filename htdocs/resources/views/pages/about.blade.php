@extends('layouts.app')

@section('pageTitle')
   About
@endsection

@section('breadcrumbs')
    <ol>
        <li><a href="{{ route('pages.home') }}">NMDS-SC</a></li>
        <li aria-current="page">About</li>
    </ol>
@endsection

@section('content')
    <h1 class="heading-large">Help</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto commodi consequatur debitis deleniti dicta distinctio dolore ea excepturi libero nisi non quae, quibusdam quidem quos recusandae reiciendis sapiente sint voluptatum.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus doloremque doloribus eaque eius error eum, facere harum labore minima nam obcaecati odio quaerat quia quos repellat reprehenderit sapiente similique temporibus?</p>
@endsection
