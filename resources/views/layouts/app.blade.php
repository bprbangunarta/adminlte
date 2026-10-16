<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>@yield('title', 'Dashboard') | {{ config('app.name') }}</title>

    @include('layouts.partials.styles')
    @stack('styles')
</head>
<body class="hold-transition skin-{{ config('adminlte.skin') }} sidebar-mini">
<div class="wrapper">

    @include('layouts.partials.navbar')
    @include('layouts.partials.sidebar')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                @yield('page_title', 'Dashboard')
                <small>@yield('page_subtitle')</small>
            </h1>
            @hasSection('breadcrumb')
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                    @yield('breadcrumb')
                </ol>
            @endif
        </section>

        <section class="content">
            @include('layouts.partials.alerts')
            @yield('content')
        </section>
    </div>

    @include('layouts.partials.footer')
</div>

@include('layouts.partials.scripts')
@stack('scripts')
</body>
</html>
