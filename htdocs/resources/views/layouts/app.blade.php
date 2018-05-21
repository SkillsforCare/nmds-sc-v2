
        <!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('pageTitle') | {{ config('app.name') }}</title>

    <!-- Fonts -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<body class="js-enabled">
<div id="app">

    @include('layouts.header')

    <div class="site-wrapper padding-bottom">
    @include('layouts.environment')

    @include('layouts.breadcrumbs')

    <main id="content" role="main">
    @yield('content')
    </main>

    </div>

    @include('layouts.footer')
</div>
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
