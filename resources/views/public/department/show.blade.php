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
                        <h2 class="header__title--pre">Відділи Ради молодих вчених<br>Одеського національного
                            університету імені І.І. Мечникова</h2>
                        <h2 class="header__title--main">
                            {{$item->getTitle()}}
                        </h2>
                    </header>
                    @if(!empty($head))
                        <div class="department-chief">
                            <img src="{{getPathToImage(imgPathOriginal($head->image))}}"
                                 alt="" class="chief__img">
                            <div class="chief__info">
                                <p class="chief__position">Голова відділу</p>
                                    <p class="chief__name">{{$head->name}}</p>

                                    <div class="chief__activity">{!! $head->description !!}</div>

                                    <p class="chief__email">{{$head->email}}</p>

                                    <p class="chief__phone">{{$head->phone}}</p>
                            </div>
                        </div>
                    @endif
                    @if(!empty($secy))
                        <div class="department-chief">
                            <img src="{{getPathToImage(imgPathOriginal($secy->image))}}"
                                 alt="" class="chief__img">
                            <div class="chief__info">
                                <p class="chief__position">Секретар відділу</p>
                                <p class="chief__name">{{$secy->name}}</p>

                                <div class="chief__activity">{!! $secy->description !!}</div>

                                <p class="chief__email">{{$secy->email}}</p>

                                <p class="chief__phone">{{$secy->phone}}</p>
                            </div>
                        </div>
                    @endif
                    <section class="department__info ckeditor-wrapper">
                        {!! $item->description  !!}
                    </section>
                </div>
            </article>
        </main>
        @includeIf('public.layout.includes.footer')
    </div>
@stop