<?php /** @var $faculty \App\Models\Faculty\Faculty */ ?>
<?php /** @var $head \App\Models\Staff\Staff */ ?>
@extends('public.layout.app')

@section('content')
    <div class="index-page">
        @includeIf('public.layout.includes.header')
        <main class="main">

            <article class="faculty">
                <div class="container">
                    <header class="main__header">
                        <h2 class="header__title--pre">Склад Ради молодих вчених<br>Одеського національного університету
                            імені І.І. Мечникова</h2>
                        <h2 class="header__title--main">{{$faculty->getTitle()}}</h2>
                    </header>
                    <section class="faculty__members">
                        @foreach($staffs as $staff)
                            <div class="member">
                                    @if(null !== $staff->getName())
                                        <div class="member__name">{{$staff->getName()}}</div>
                                    @endif
                                    @if(null !== $staff->getDescription())
                                        <div class="member__activity">{!! $staff->getDescription() !!}</div>
                                    @endif
                                    <div class="member__contacts">
                                        @if(null !== $staff->getEmail())
                                            <div class="member__email">{{$staff->getEmail()}}</div>
                                        @endif
                                        @if(null !== $staff->getPhone())
                                            <div class="member__phone">{{$staff->getPhone()}}</div>
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