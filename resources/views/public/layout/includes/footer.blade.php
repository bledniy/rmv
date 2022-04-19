<footer class="footer">
    <div class="container">
        <div class="footer__top" data-aos="fade">
            <a class="logo" href="{{ url('/') }}">
                <img src="{{ asset('assets/img/Logo.svg') }}">
            </a>
            <ul class="links">
                @includeIf('public.layout.includes.menu-items')
            </ul>
        </div>
        <div class="footer__bottom">
            <div class="footer__bottom__wrap">
                <p class="footer__bottom__description">Основной офис:</p>
                <p class="footer__bottom__value">{{ getSetting('contacts.address') }}</p>
            </div>
            <div class="footer__bottom__wrap">
                <a class="footer__bottom__value"
                   href="tel:+{{ formatTel(getSetting('contacts.main-phone')) }}">{{ getSetting('contacts.main-phone') }}</a>
                <a class="footer__bottom__value"
                   href="mailto:{{ getSetting('contacts.public-email') }}">{{ getSetting('contacts.public-email') }}</a>
            </div>
            <div class="footer__bottom__wrap">
                @if(getSetting('contacts.schedule'))
                    <p class="footer__bottom__description">Режим работы:</p>
                    <p class="footer__bottom__value">{{ getSetting('contacts.schedule') }}</p>
                @endif
            </div>
            <div class="footer__bottom__wrap">
                <p class="footer__bottom__description">All rights reserved</p>
                <p class="footer__bottom__value">{{ request()->getHost() }} © {{ date('Y') }}</p>
            </div>
            <div class="footer__bottom__wrap">
                <p class="footer__bottom__description">with love by</p>
                <a class="footer__bottom__value" href="https://micorestudio.com" target="_blank">MantiCore development</a>
            </div>
        </div>
    </div>
</footer>