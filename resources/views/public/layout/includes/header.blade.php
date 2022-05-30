<?php /** @var $faculty \App\Models\Faculty\Faculty[] */ ?>
<?php /** @var $department \App\Models\Department\Department[] */ ?>

<header class="header">
    <section class="contacts">
        <div class="container">
            <div class="contacts__content">
                <a href="mailto:rmv.onu.edu@gmail.com"
                   class="contacts__quick-email fa-solid fa-envelope">&ensp;rmv.onu.edu@gmail.com</a>
                <ul class="contacts__ul">
                    <li>
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-link"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-link"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-link"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-link"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="logo">
        <div class="container">
            <figure class="logo__figure">
                <img src="{{asset('Logo.jpg')}}" alt="Рада молодих вченних" class="logo__img" />
                <figcaption class="logo__figcaption">
                    <h1 class="logo__main-header">Рада молодих вчених</h1>
                    <h2 class="logo__university">Одеського Національного Університету імені&nbsp;І.І.&nbsp;Мечникова</h2>
                </figcaption>
            </figure>
        </div>
    </section>
    <section class="navigation-menu">
        <div class="container">
            <nav class="menu">
                <button class="menu-burger">
                    <i class="menu-burger__icon fa-solid fa-bars fa-fw"></i>
                    <i class="menu-burger__icon fa-solid fa-xmark fa-fw"></i>
                    <span class="menu-burger__text">Menu</span>
                </button>
                <ul class="menu__list">
                    <li>
                        <a href="{{route('home')}}" class="menu__link">Головна</a>
                    </li>
                    <li>
                        <a href="/faculty" class="menu__link menu__link--nonclickable">Склад ради</a>
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
                    <li>
                        <a href="/department" class="menu__link menu__link--nonclickable">Відділи</a>
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
                    <li>
                        <a href="#" class="menu__link">Документи</a>
                    </li>
                    <li>
                        <a href="{{route('news.index')}}" class="menu__link">Новини</a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>
</header>