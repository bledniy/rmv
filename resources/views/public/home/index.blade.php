@extends('public.layout.app')

@section('content')
    <div class="index-page">
        @includeIf('public.layout.includes.header')
        <main class="main">
            <article class="home">
                <div class="container">
                    <header class="main__header">
                        <h2 class="header__title--main">
                            Інформація про діяльність
                        </h2>
                        <h2 class="header__title--pre">Ради молодих вчених<br>Одеського національного університету імені
                            І.І.
                            Мечникова</h2>
                    </header>
                    @foreach($blocks as $block)
                        <section class="home__info">
                            @if(isset($block->name))
                                <h3 class="info__title">{{$block->name}}</h3>
                            @endif
                            @if(isset($block->description))
                                <p class="info__text">{!! $block->description !!}</p>
                            @endif
                            @if(isset($block->image))
                                <img class="info__img info__img--2"
                                     src="{{getPathToImage(imgPathOriginal($block->image))}}" alt="">
                            @endif
                        </section>
                    @endforeach
                </div>
            </article>
        </main>
        @includeIf('public.layout.includes.footer')
    </div>
@stop
