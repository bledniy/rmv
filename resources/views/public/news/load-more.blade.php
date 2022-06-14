@extends('public.layout.app')

@section('content')
<div class="index-page">
    @includeIf('public.layout.includes.header')
    <main class="main">
        <article class="rmv-news">
            <div class="container">
                <section class="news">
                    <div class="news-item">
                        <h3 class="news-item__title"><a href="" class="news-item__full">Зустріч представників РМВ з магістрами, аспірантами та молодими вченими факультетів університету!</a></h3>
                        <span class="news-item__date"><i class="fa-solid fa-calendar-days"></i>04.12.2021 </span>
                        <span class="news-item__author"><i class="fa-solid fa-user-pen"></i>writer</span>
                        <div class="ckeditor-wrapper">

                        </div>
                    </div>
                </section>
            </div>
        </article>
    </main>
    @includeIf('public.layout.includes.footer')
</div>
@stop