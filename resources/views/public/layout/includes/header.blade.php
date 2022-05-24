<?php /** @var $faculty \App\Models\Faculty\Faculty[] */ ?>
<?php /** @var $department \App\Models\Department\Department[] */ ?>

<header class="header">
    <article class="contacts">
        <div class="container">
            <div class="contacts__content">

                <a href="mailto:rmv.onu.edu@gmail.com"
                   class="contacts__quick-email fa-solid fa-envelope">&ensp;rmv.onu.edu@gmail.com</a>

                <ul class="contacts__ul">
                    <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fas fa-link"></i></a></li>
                    <li><a href="#"><i class="fas fa-link"></i></a></li>
                    <li><a href="#"><i class="fas fa-link"></i></a></li>
                    <li><a href="#"><i class="fas fa-link"></i></a></li>
                </ul>

            </div>
        </div>
    </article>
    <article class="logo-search">
        <div class="container">
            <div class="logo-search__content">

                <figure class="logo__figure">
                    <img src="{{ asset('assets/img/Logo.jpg') }}" alt="Рада молодих вченних" class="logo__img"/>
                    <figcaption class="logo__figcaption">
                        <h1 class="logo__main-header">Рада молодих вчених</h1>
                        <h2 class="logo__university">Одеського національного університету імені І.І. Мечникова</h2>
                    </figcaption>
                </figure>

                <form class="search__form" method="get" action="">
                    <input class="search__input" type="text" name="search" placeholder="Введіть для пошуку..." value="">
                    <button class="search__btn"><i class="fas fa-search"></i></button>
                </form>

            </div>
        </div>
    </article>
    <article class="navigation-menu">
        <div class="container">
            <!--  -->
            <nav class="menu">
                <ul class="menu__list">
                    <li><a href="#" class="menu__link">Головна</a></li>
                    <li>
                        <a href="" class="menu__link">Відділи</a>
                        <i class="menu__arrow arrow fa-solid fa-angle-down"></i>
                        <ul class="sub-menu__list">
                            @foreach($departments as $department)
                                <li>
                                    <a href="{{route('department.show', $department->getKey())}}"
                                       class="sub-menu__link">{{$department->getTitle()}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="#" class="menu__link">Контакти</a></li>
                    <li>
                        <a href="" class="menu__link">Склад ради</a>
                        <i class="menu__arrow arrow fa-solid fa-angle-down"></i>
                        <ul class="sub-menu__list">
                            @foreach($faculties as $faculty)
                                <li>
                                    <a href="{{route('faculty.show', $faculty->getKey())}}"
                                       class="sub-menu__link">{{$faculty->getTitle()}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </nav>
            <!--  -->
        </div>
    </article>
</header>