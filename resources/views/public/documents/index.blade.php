@extends('public.layout.app')

@section('content')
    <div class="index-page">
        @includeIf('public.layout.includes.header')
        <main class="main">
            <article class="rmv-documents">
                <div class="container">
                    <header class="main__header">
                        <h2 class="header__title--main">
                            Документи
                        </h2>
                        <h2 class="header__title--pre">Ради молодих вчених<br>Одеського національного
                            університету імені І.І. Мечникова</h2>
                    </header>
                    <section class="documents">
                        @foreach($docs as $doc)
                            <div class="document-item">
                                <h3 class="document-item__title"><a href="{{'/storage/docs/' . $doc->file}}"
                                                                class="document-item__full">{{$doc->getName()}}</a>
                                </h3>
                                <span class="document-item__date"><i
                                            class="fa-solid fa-calendar-days"></i>{{$doc->created_at}}</span>
                                <span class="document-item__author"><i class="fa-solid fa-user-pen"></i>Admin</span><br>
                                <a class="document-item__more" href="{{'/storage/docs/' . $doc->file}}">Читати документ</a>
                            </div>
                        @endforeach
                    </section>
                </div>
            </article>
        </main>
        @includeIf('public.layout.includes.footer')
    </div>
@stop