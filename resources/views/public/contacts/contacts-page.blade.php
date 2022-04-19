@extends('public.layout.app')

@section('content')
    <div class="wrapper">
        @includeIf('public.layout.includes.header')
        <div class="content-wrapper">
            <section class="contacts-page">
                <div class="container">
                    <div class="contacts-page__container">
                        <div class="contacts-page__wrapper">
                            <h1 class="contacts-page__title" data-aos="clip-top" data-aos-delay="0">{{ showMeta('Контакты') }}</h1>
                            <div class="contacts-page__wrap">
                                <p class="contacts-page__description" data-aos="clip-top" data-aos-delay="200">
                                    Основной офис:</p>
                                <p class="contacts-page__value" data-aos="clip-top"
                                   data-aos-delay="300">{{ getSetting('contacts.address') }}</p>
                            </div>
                            <div class="contacts-page__wrap">
                                <p class="contacts-page__description" data-aos="clip-top" data-aos-delay="400">Номера телефонов</p>
                                <a class="contacts-page__value" data-aos="clip-top" data-aos-delay="500"
                                   href="tel:+{{ formatTel(getSetting('contacts.main-phone')) }}">{{ getSetting('contacts.main-phone') }}</a>
                                <a class="contacts-page__value" data-aos="clip-top" data-aos-delay="600"
                                   href="tel:+{{ formatTel(getSetting('contacts.phone_two')) }}">{{ getSetting('contacts.phone_two') }}</a>
                                <a class="contacts-page__value" data-aos="clip-top" data-aos-delay="700"
                                   href="tel:+{{ formatTel(getSetting('contacts.phone_three')) }}">{{ getSetting('contacts.phone_three') }}</a>
                            </div>
                            <div class="contacts-page__wrap">
                                <p class="contacts-page__description" data-aos="clip-top" data-aos-delay="800">Почта</p>
                                <a class="contacts-page__value" data-aos="clip-top" data-aos-delay="900"
                                   href="mailto:{{ getSetting('contacts.public-email') }}">{{ getSetting('contacts.public-email') }}</a>
                            </div>
                            <div class="contacts-page__wrap">
                                <p class="contacts-page__description" data-aos="clip-top" data-aos-delay="1000">Режим работы:</p>
                                <p class="contacts-page__value" data-aos="clip-top"
                                   data-aos-delay="1100">{{ getSetting('contacts.schedule') }}</p>
                            </div>
                        </div>
                        <div class="contacts-page__wrapper">
                            <h2 class="contacts-page__title" data-aos="clip-top" data-aos-delay="1200">Связаться с нами</h2>
                            <form class="contact__form" data-aos="clip-top" data-aos-delay="1300" action="{{ route('feedback.default') }}"
                                  method="post">
                                @csrf
                                @includeIf('public.contacts.partials.contact-form-fields')
                                <button class="button-type-one">Отправить</button>
                            </form>
                        </div>
                    </div>
                    <iframe data-aos="zoom-out"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2747.8480301939558!2d30.696723715533718!3d46.47151807912582!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40c6321ebf1909d1%3A0x2608f6b20b743ccc!2z0YPQuy4g0JHRg9Cz0LDQtdCy0YHQutCw0Y8sIDIxLCDQntC00LXRgdGB0LAsINCe0LTQtdGB0YHQutCw0Y8g0L7QsdC70LDRgdGC0YwsINCj0LrRgNCw0LjQvdCwLCA2NTAwMA!5e0!3m2!1sru!2sru!4v1641590528518!5m2!1sru!2sru"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </section>
        </div>
        @includeIf('public.layout.includes.footer')
    </div>
@stop