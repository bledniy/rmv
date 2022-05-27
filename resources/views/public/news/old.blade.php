<?php /** @var $news \App\Models\News\News[]|\Illuminate\Pagination\LengthAwarePaginator */ ?>
@extends('public.layout.app')

@section('content')
    <div class="wrapper">
        @includeIf('public.layout.includes.header')
        <div class="content-wrapper">
            <section class="news-page">
                <div class="container">
                    <h2 class="news-page__title" data-aos="clip-top">Новости</h2>
                    <div class="news-page__wrap" data-news-pages-wrap>
                        @foreach($news as $new)
                            <div class="news-card" data-aos="clip-right" data-aos-delay="100"
                                 data-modal-url="{{ route('news.show.modal', $new->getKey()) }}">
                                @includeIf('public.news.partials.news-content')
                            </div>
                        @endforeach
                    </div>
                    @if($news->hasMorePages())
                        <a href="{{ $news->nextPageUrl() }}"
                           data-load-news-url="{{ route('news.load-more') }}?page={{ $news->currentPage() + 1 }}"
                           class="news__link button-type-one" data-aos="clip-top" data-aos-delay="100"
                           id="news-page__button">Показать
                            ещё
                        </a>
                    @endif
                </div>
            </section>
        </div>
        @includeIf('public.layout.includes.footer')
    </div>
@stop