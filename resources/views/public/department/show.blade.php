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
                            @if(!empty($head->image))
                                <img src="{{getPathToImage(imgPathOriginal($head->image))}}"
                                     alt="" class="member__img">
                            @endif
                            <div class="member__info">
                                <p class="member__position">Голова відділу</p>
                                @if(!empty($head->name))
                                <p class="member__name">{{$head->name}}</p>
                                @endif
                                @if(!empty($head->description))
                                    <p class="department__info ckeditor-wrapper">{!! $head->description !!}</p>
                                @endif
                                @if(!empty($head->email))
                                <p class="member__email">{{$head->email}}</p>
                                @endif
                                @if(!empty($head->phone))
                                <p class="member__phone">{{$head->phone}}</p>
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