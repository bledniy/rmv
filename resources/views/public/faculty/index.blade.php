<?php /** @var $faculty \App\Models\Faculty\Faculty */ ?>
<?php /** @var $head \App\Models\Staff\Staff */ ?>
@extends('public.layout.app')

@section('content')
    <div class="index-page">
        @includeIf('public.layout.includes.header')
        <main class="main">

            <article class="faculty">
                <div class="container">
                    <header class="faculty__header">
                        <h2 class="header__title--pre">Склад Ради молодих вчених<br>Одеського національного університету
                            імені І.І. Мечникова</h2>
                        <h2 class="header__title--main">{{$faculty->getTitle()}}</h2>
                    </header>
                    <section class="faculty__members">
                        @foreach($staffs as $staff)
                            <div class="member">
                                <div class="member__info">
                                    @if(null !== $staff->getName())
                                        <p class="member__name">{{$staff->getName()}}</p>
                                    @endif
                                    @if(null !== $staff->getDescription())
                                        <p class="department__info ckeditor-wrapper">{!! $staff->getDescription() !!}</p>
                                    @endif
                                    @if(null !== $staff->getEmail())
                                        <p class="member__email">{{$staff->getEmail()}}</p>
                                    @endif
                                    @if(null !== $staff->getPhone())
                                        <p class="member__phone">{{$staff->getPhone()}}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </section>
                </div>
            </article>
        </main>
        @includeIf('public.layout.includes.footer')
    </div>
@stop