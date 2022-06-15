@extends('public.layout.app')

@section('content')
    <div class="index-page">
        @includeIf('public.layout.includes.header')
        <main class="main">
            <article class="department">
                <div class="container">
                    <header class="department__header">
                        <h2 class="header__title--pre">Відділи Ради молодих вчених<br>Одеського національного
                        університету імені І.І. Мечникова</h2>
                        <h2 class="header__title--main">
                            {{$item->getTitle()}}
                        </h2>
                    </header>
                    <section class="department__members">
                        <div class="member">
                            <img src="{{getPathToImage(imgPathOriginal($head->image))}}"
                            alt="" class="member__img">
                            <div class="member__info">
                                <p class="member__position">Голова відділу</p>
                                @if(null !== $head->getName())
                                <p class="member__name">{{$head->getName()}}</p>
                                @endif
                                @if(null !== $head->getDescription())
                                    <p class="department__info ckeditor-wrapper">{!! $head->getDescription() !!}</p>
                                @endif
                                @if(null !== $head->getEmail())
                                <p class="member__email">{{$head->getEmail()}}</p>
                                @endif
                                @if(null !== $head->getPhone())
                                <p class="member__phone">{{$head->getPhone()}}</p>
                                @endif
                            </div>
                        </div>
                    </section>
                    <section class="department__info ckeditor-wrapper">
                        {!! $item->description  !!}
                    </section>
                </div>
            </article>
        </main>
            @includeIf('public.layout.includes.footer')
    </div>
@stop