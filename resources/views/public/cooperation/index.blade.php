<?php
$head = $head ?? null;
$secy = $secy ?? null;
?>
@extends('public.layout.app')

@section('content')
    <div class="index-page">
        @includeIf('public.layout.includes.header')
        <main class="main">
            <article class="department">
                <div class="container">
                    <header class="main__header">
                    <h2 class="header__title--main">Співробітництво</h2>
                        <h2 class="header__title--pre">Ради молодих вчених<br>Одеського національного
                            університету імені І.І. Мечникова</h2>
                    </header>
                    <div class="coop-images">
                            @foreach($list as $item)
                            <div class="coop-image">
                                <span class="image-title">{{$item->name}}</span>
                                <img src="{{getPathToImage(imgPathOriginal($item->image))}}">
                            </div>
                            @endforeach
                    </div>
            </article>
        </main>
        @includeIf('public.layout.includes.footer')
    </div>
@stop