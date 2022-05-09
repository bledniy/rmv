@extends('public.layout.app')

@section('content')
    <div class="index-page">
        <div class="wrapper">
            @includeIf('public.layout.includes.header')
            <div class="content-wrapper">
            </div>
            @includeIf('public.layout.includes.footer')
        </div>
    </div>
@stop