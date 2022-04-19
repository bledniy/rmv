<header class="header">
    <div class="container">
        <a class="logo" data-aos="fade" data-aos-duration="2000" href="{{ url('/') }}">
            <img src="{{ asset('assets/img/Logo.svg') }}">
        </a>
        <nav class="links" data-aos="fade" data-aos-duration="2000">
            @includeIf('public.layout.includes.menu-items')
        </nav>
        <button class="button-type-one buttons-support" data-aos="fade" data-aos-duration="2000">Связаться с нами</button>
        <div class="header__mob">
            <button class="button-type-none" id="nav-menu"><span></span></button>
            <div class="header__mob__modal">
                <nav class="nav">
                    @includeIf('public.layout.includes.menu-items')
                </nav>
                <button class="button-type-one buttons-support">Связаться с нами</button>
            </div>
        </div>
    </div>
</header>