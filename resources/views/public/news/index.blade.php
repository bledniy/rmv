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
                    <div class="news-item">
                        <h3 class="news-item__title"><a href="" class="news-item__full">Зустріч представників РМВ з магістрами, аспірантами та молодими вченими факультетів університету!</a></h3>
                        <span class="news-item__date"><i class="fa-solid fa-calendar-days"></i>04.12.2021 </span>
                        <span class="news-item__author"><i class="fa-solid fa-user-pen"></i>writer</span>
                        <p class="news-item__short">1, 2 та 3 грудня 2021 року відбулися зустрічі представників РМВ з магістрами, аспірантами та молодими вченими факультетів університету!  Метою зустрічей було ознайомлення молодих науковців з основними напрямками діяльності Ради, можливостями та перевагами для молоді в науковому осередку. РМВ розповіла...</p>
                        <a class="news-item__more" href="">Читати далі</a>
                    </div>
                </section>
            </div>
        </article>
    </main>
    @includeIf('public.layout.includes.footer')
</div>
@stop