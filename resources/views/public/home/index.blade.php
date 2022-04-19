@extends('public.layout.app')

@section('content')
    <div class="index-page">
        <div class="wrapper">
            @includeIf('public.layout.includes.header')
            <div class="content-wrapper">
                @includeIf('public.home.includes.about-us')
                @includeIf('public.home.includes.coverage-map')
                @includeIf('public.home.includes.brands')
                @includeIf('public.home.includes.logistics')
                @includeIf('public.home.includes.digital')
                @includeIf('public.home.includes.team')
                @includeIf('public.home.includes.news')
            </div>
            @includeIf('public.layout.includes.footer')
        </div>
    </div>
@stop