<!DOCTYPE html>
<html lang="{{ getCurrentLocaleCode() }}">
<head>
    <meta charset="utf-8"/>
    <title>{!! SEOMeta::getTitle() !!}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no"
          name="viewport"/>
    <link rel="stylesheet" href="{{ mix('_admin/css/admin-main.css') }}"/>
    <link rel="stylesheet" href="{{ mix('_admin/css/material-dashboard.css') }}"/>
    <link rel="stylesheet" href="{{ mix('_admin/css/styles.css') }}"/>
    <script type="text/javascript" src="{{ asset('js/core/jquery.min.js') }}"></script>
    <link rel="icon" href="{{ asset('assets/img/Logo.jpg') }}" sizes="any" type="image/svg+xml">
</head>
<body>

@include('admin.partials.preloader')

<div class="wrapper blurred-app" id="app">
    <div class="sidebar" data-color="dark" data-background-color="white" data-image="">
        <x-admin.layout.sidebar-bg></x-admin.layout.sidebar-bg>
        <div class="logo text-center">
            <a href="{{ route('home')}}" class="simple-text logo-normal mx-3 px-2 bg-white">
                <img src="{{ asset('Logo.jpg') }}" alt="" class="img-fluid" width="60">
            </a>
            <small class="badge badge-dark no-radius">{{ Auth::guard('admin')->user()->login }}</small>
        </div>
        <div class="sidebar-wrapper position-s">
            @include('admin.layouts.includes.menu')
        </div>
    </div>
    <div class="main-panel">
        @include('admin.layouts.includes.header')

        @include('admin.layouts.includes.sections-wrapper-card')
    </div>

</div>

{{--@include('admin.langlist')--}}

@include('admin.layouts.partials.styles')

@include('admin.layouts.partials.scripts')

@include('admin.partials.flash-message')
</body>
</html>















