<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Meta dasar -->
    <title>@yield('title') - {{ env('APP_NAME') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}" />
    <meta name="description" content="CODEX adalah platform integrasi data inti untuk monitoring, analisis, dan pertukaran data nasabah BPR Bangunarta." />
    <meta name="author" content="Jendela Kreasi Visual" />

    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="CODEX (Core Data Exchange)" />
    <meta property="og:description" content="CODEX adalah platform integrasi data inti untuk monitoring, analisis, dan pertukaran data nasabah BPR Bangunarta." />
    <meta property="og:image" content="{{ asset('assets/images/codex.webp') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="CODEX (Core Data Exchange)" />
    <meta name="twitter:description" content="CODEX adalah platform integrasi data inti untuk monitoring, analisis, dan pertukaran data nasabah BPR Bangunarta." />
    <meta name="twitter:image" content="{{ asset('assets/images/codex.webp') }}" />

    @include('layouts._css')
</head>

<body class="hold-transition skin-blue sidebar-mini fixed">
    <div class="wrapper">

        @include('layouts.navbar')

        <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-square" alt="User Image" style="border-radius: 3px;">
                    </div>
                    <div class="pull-left info">
                        <p>{{ Str::limit(Auth::user()->name, 20) }}</p>
                        <span class="label label-success">{{ Str::limit(Auth::user()->getRoleNames()->implode(', '), 25) }}</span>
                    </div>
                </div>

                @include('layouts.menu')
            </section>
        </aside>

        <div class="content-wrapper">
            @yield('header')

            @yield('content')
        </div>

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                VERSION 1.0
            </div>

            <strong>&copy;{{ date('Y') }} <a href="https://bprbangunarta.co.id">BPR BANGUNARTA</a>.</strong> All rights reserved.
        </footer>
        <div class="control-sidebar-bg"></div>
    </div>

    <!-- REQUIRED JS SCRIPTS -->
    @include('layouts._js')
</body>

</html>