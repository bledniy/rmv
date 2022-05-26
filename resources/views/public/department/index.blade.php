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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@stop