@extends('public.layout.app')

@section('content')
    <div class="index-page">
        @includeIf('public.layout.includes.header')
        <main class="main">
            <article class="rmv-news">
                <div class="container">
                    <header class="main__header">
                        <h2 class="header__title--main">
                            Новини
                        </h2>
                        <h2 class="header__title--pre">Ради молодих вчених<br>Одеського національного
                            університету імені І.І. Мечникова</h2>
                    </header>
                    <section class="news">
                        @foreach($news as $new)
                            <div class="news-item">
                                <h3 class="news-item__title"><a href="{{route('news.show', $new->id)}}"
                                                                class="news-item__full">{{$new->getName()}}</a>
                                </h3>
                                <span class="news-item__date"><i
                                            class="fa-solid fa-calendar-days"></i>{{$new->created_at}}</span>
                                <span class="news-item__author"><i class="fa-solid fa-user-pen"></i>Admin</span>
                                <p class="news-item__short">{{$new->getExcerpt()}}</p>
                                <a class="news-item__more" href="{{route('news.show', $new->id)}}">Читати далі</a>
                            </div>
                        @endforeach
                            {!! $news->render() !!}
                    </section>
                </div>
            </article>
        </main>
        @includeIf('public.layout.includes.footer')
    </div>
@stop