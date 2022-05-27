@extends('public.layout.app')

@section('content')
    <div class="index-page">
            @includeIf('public.layout.includes.header')
            <main class="main">
                <article class="main-page">
                    <div class="container">
                        <header class="main-page__header">
                            <h2 class="header__title--main">
                                Інформація про діяльність
                            </h2>
                            <h2 class="header__title--pre">Ради молодих вчених<br>Одеського національного університету імені І.І. Мечникова</h2>
                        </header> 
                        <section class="main-page__info">
                            <p class="info__text">Рада молодих вчених (далі Рада) створена 31 травня 2021 року. Є колегіальним виборним дорадчим органом, який утворено для забезпечення захисту прав та інтересів молодих вчених та офіційним правонаступником Товариства молодих вчених.</p>
                            <p class="info__text">До складу Ради входять 27 молодих вчених – представників одинадцяти факультетів та двох науково-навчальних центрів університету. Члени Ради визначалися шляхом проведення виборів на кожному з факультетів серед спільноти молодих науковців.</p>
                            <h3 class="info__title">Президія Ради:</h3>
                            <div class="member">
                                <img src="http://rmv.onu.edu.ua/wp-content/uploads/2021/11/%D1%84%D0%BE%D1%82%D0%BE11-629x1024.jpg"
                                alt="" class="member__img">
                                <div class="member__info">
                                    <p class="member__position">Голова Ради молодих вчених</p>
                                    <p class="member__name">Маслій Наталя Дмитрівна</p>
                                    <p class="member__activity">доктор економічних наук, професор кафедри фінансів, банківської справи та страхування</p>
                                    <p class="member__email">n.maslii@onu.edu.ua</p>
                                </div>
                            </div>
                            <div class="member">
                                <img src="http://rmv.onu.edu.ua/wp-content/uploads/2021/11/%D1%84%D0%BE%D1%82%D0%BE21.jpg"
                                alt="" class="member__img">
                                <div class="member__info">
                                    <p class="member__position">Заступник голови Ради молодих вчених</p>
                                    <p class="member__name">Демченко Ольга Володимирівна</p>
                                    <p class="member__activity">кандидат історичних наук, провідний фахівець, доцент кафедри археології та етнології України</p>
                                    <p class="member__email">olyadem7@gmail.com</p>
                                </div>
                            </div>
                            <div class="member">
                                <img src="http://rmv.onu.edu.ua/wp-content/uploads/2021/11/%D1%84%D0%BE%D1%82%D0%BE12-1.jpg"
                                alt="" class="member__img">
                                <div class="member__info">
                                    <p class="member__position">Секретар Ради молодих вчених</p>
                                    <p class="member__name">Крістєва Елла Анатоліївна</p>
                                    <p class="member__activity">здобувач вищої освіти третього (освітньо-наукового) рівня економіко-правового факультету</p>
                                    <p class="member__email">ella.kristeva@gmail.com</p>
                                </div>
                            </div>
                            <p class="info__text">У Раді функціонує чотири основних відділи за напрямами роботи: науковий, міжнародний, роботи з громадськістю та прес-центр.</p>
                            <div class="info__departments">
                                <a href="" class="info__department">Науковий</a>
                                <a href="" class="info__department">Міжнародний</a>
                                <a href="" class="info__department">Робота з громадськістю</a>
                                <a href="" class="info__department">Прес-центр</a>
                            </div>
                            <div class="rmv-photo-container">
                                <img src="http://rmv.onu.edu.ua/wp-content/uploads/2021/11/%D1%84%D0%BE%D1%82%D0%BE41-1024x705.jpg" alt="" class="rmv-photo">
                            </div>
                                <p class="info__text">РМВ ОНУ імені І.І. Мечникова бажає усім розвитку, науки без меж, інтеграції у світовий науковий простір, нових суттєвих цікавих проектів та успіху в своїх напрямках, до яких треба рухатись з ентузіазмом, креативністю та любов’ю до людей!</p>
                            <h3 class="info__title">ОСНОВНІ ДОКУМЕНТИ:</h3>
                            <a href="http://onu.edu.ua/pub/bank/userfiles/files/science/young_academ/PolojeniaRVM.pdf" class="rmv-documents">http://onu.edu.ua/pub/bank/userfiles/files/science/young_academ/PolojeniaRVM.pdf</a>
                        </section>
                    </div>
                </article>
            </main>
            @includeIf('public.layout.includes.footer')
        </div>
@stop