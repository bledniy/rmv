@extends('public.layout.app')

@section('content')
    <div class="index-page">
        <div class="wrapper">
            @includeIf('public.layout.includes.header')
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
                            <div class="member__info">
                                <p class="member__position">Голова відділу відділу роботи з громадськістю</p>
                                <p class="member__name">Святошнюк Арина Леонідівна</p>
                                <p class="member__activity">Кандидат юридичних наук, доцент кафедри цивільно-правових
                                    дисциплін</p>
                                <p class="member__email">lorem@impsum.com</p>
                                <p class="member__phone">+380 ** *** ** **</p>
                            </div>
                            <img src="http://rmv.onu.edu.ua/wp-content/uploads/2022/01/%D1%84%D0%BE%D1%82%D0%BE13-733x1024.jpg"
                                 alt="" class="member__img">
                        </div>
                    </section>
                    <section class="department__info">
                        {!! $item->description  !!}
                    </section>
                </div>
            </article>
            @includeIf('public.layout.includes.footer')
        </div>
    </div>
@stop