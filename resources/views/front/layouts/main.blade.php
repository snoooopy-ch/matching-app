<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | マチアプ</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('admin-assets/custom/img/favicon-96x96.png') }}">
</head>
<body>
    <div id="app">
        <div class="page-wrapper">
            <header-component></header-component>
            @yield('content')
            <footer-component></footer-component>
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
