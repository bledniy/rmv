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
                        <h2 class="header__title--pre">Співробітництво Ради молодих вчених<br>Одеського національного
                            університету імені І.І. Мечникова</h2>
                    </header>
                @foreach($list as $item)
                        <img src="{{getPathToImage(imgPathOriginal($item->image))}}">
                @endforeach
            </article>
        </main>
        @includeIf('public.layout.includes.footer')
    </div>
@stop