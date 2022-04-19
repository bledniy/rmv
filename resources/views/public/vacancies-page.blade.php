<?php /** @var $vacancies \App\DataContainers\Vacancies\VacancyData[]|\Illuminate\Support\Collection */ ?>
@extends('public.layout.app')

<div class="wrapper">
    @includeIf('public.layout.includes.header')
    <div class="content-wrapper">
        <section class="vacancies-page">
            <div class="container">
                <div class="vacancies-page__contacts-wrap">
                    <h1 class="vacancies-page__title" data-aos="clip-top" data-aos-delay="0">{{ showMeta('Вакансии') }}</h1>
                    <p class="vacancies-page__contacts" data-aos="clip-top"
                       data-aos-delay="300">{{ getSetting('vacancy.hr_name') }} {!! settingsEditIfAdmin('vacancy.hr_name') !!}</p>
                    <div class="vacancies-page__contacts">
                        <a data-aos="clip-top" data-aos-delay="500"
                           href="tel:+{{ formatTel(getSetting('vacancy.hr_phone')) }}">тел: {{ getSetting('vacancy.hr_phone') }}</a>
                        <a data-aos="clip-top" data-aos-delay="500"
                           href="mailto:{{ getSetting('vacancy.hr_email') }}">почта: {{ getSetting('vacancy.hr_email') }}</a>
                    </div>
                </div>
                <div class="vacancies-page__wrap">
                    @if($vacancies->isNotEmpty())
                        @foreach($vacancies as $vacancy)
                            <div class="vacancies-card" data-aos="clip-right">
                                <div class="wrap">
                                    <h3 class="vacancies-card__title">{{ $vacancy->getName() }}
                                        <small>{!! editLinkAdmin(route('admin.vacancies.edit', $vacancy->getId())) !!}</small></h3>
                                    <p class="vacancies-card__text">{!! nl2br($vacancy->getDescription()) !!}</p>
                                    <button data-vancancies-link class="vacancies__link button-type-one"
                                            data-vacancy-id="{{ $vacancy->getId() }}"
                                            data-vacancy-name="{{ $vacancy->getName() }}">Оставить резюме
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="vacancies-page__contacts">На данный момент нет открытых вакансий</p>
                    @endif
                </div>
            </div>
        </section>
    </div>
    @includeIf('public.layout.includes.footer')
</div>
