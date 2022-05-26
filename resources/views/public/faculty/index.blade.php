@extends('public.layout.app')

@section('content')
    <div class="index-page">
        <div class="wrapper">
            @includeIf('public.layout.includes.header')
            <article class="faculty">
                <div class="container">
                    <header class="faculty__header">
                        <h2 class="header__title--pre">Склад Ради молодих вчених<br>Одеського національного університету імені І.І. Мечникова</h2>
                        <h2 class="header__title--main">
                            Біологічний факультет
                        </h2>
                    </header>  
                    <section class="faculty__members">
                            <div class="member">
                                <img src="http://rmv.onu.edu.ua/wp-content/uploads/2022/01/%D1%84%D0%BE%D1%82%D0%BE13-733x1024.jpg" alt="" class="member__img">
                                <div class="member__info">
                                    <p class="member__name">Кіка Владислав Володимирович</p>
                                    <p class="member__activity">здобувач вищої освіти третього (освітньо-наукового) рівня</p>
                                    <p class="member__email">lorem@impsum.com</p>
                                    <p class="member__phone">+380 ** *** ** **</p>
                                </div>
                            </div>
                            <div class="member">
                                <img src="http://rmv.onu.edu.ua/wp-content/uploads/2022/01/%D1%84%D0%BE%D1%82%D0%BE13-733x1024.jpg" alt="" class="member__img">
                                <div class="member__info">
                                    <p class="member__name">Чепіженко Вадим Віталійович</p>
                                    <p class="member__activity">кандидат історичних наук, викладач кафедри всесвітньої історії, науковий співробітник Центру антикознавства та медієвістики, помічник проректора з науково-педагогічної роботи</p>
                                    <p class="member__email">lorem@impsum.com</p>
                                    <p class="member__phone">+380 ** *** ** **</p>
                                </div>
                            </div>
                            <div class="member">
                                <img src="http://rmv.onu.edu.ua/wp-content/uploads/2022/01/%D1%84%D0%BE%D1%82%D0%BE13-733x1024.jpg" alt="" class="member__img">
                                <div class="member__info">
                                    <p class="member__name">Дікол Олена Сергіївна</p>
                                    <p class="member__activity">здобувач вищої освіти третього (освітньо-наукового) рівня, молодший науковий співробітник кафедри загальної, морської геології та палеонтології</p>
                                    <p class="member__email">lorem@impsum.com</p>
                                    <p class="member__phone">+380 ** *** ** **</p>
                                </div>
                            </div>
                            <div class="member">
                                <img src="http://rmv.onu.edu.ua/wp-content/uploads/2022/01/%D1%84%D0%BE%D1%82%D0%BE13-733x1024.jpg" alt="" class="member__img">
                                <div class="member__info">
                                    <p class="member__name">Крістєва Елла Анатоліївна</p>
                                    <p class="member__activity">здобувач вищої освіти третього (освітньо-наукового) рівня</p>
                                    <p class="member__email">lorem@impsum.com</p>
                                    <p class="member__phone">+380 ** *** ** **</p>
                                </div>
                            </div>
                            <div class="member">
                                <img src="http://rmv.onu.edu.ua/wp-content/uploads/2022/01/%D1%84%D0%BE%D1%82%D0%BE13-733x1024.jpg" alt="" class="member__img">
                                <div class="member__info">
                                    <p class="member__name">Крістєва Елла Анатоліївна</p>
                                    <p class="member__activity">здобувач вищої освіти третього (освітньо-наукового) рівня</p>
                                    <p class="member__email">lorem@impsum.com</p>
                                    <p class="member__phone">+380 ** *** ** **</p>
                                </div>
                            </div>
                    </section>              
                </div>
            </article>
            @includeIf('public.layout.includes.footer')
        </div>
    </div>
@stop