<?php /** @var $news \App\Models\News\News[]|\Illuminate\Support\Collection */ ?>
@if(($news ?? false) && $news->isNotEmpty())
    <section class="news" id="news">
        <div class="container">
            <div class="news__title" data-aos="clip-top">Новости</div>
            <div class="news__slider">
                @foreach($news as $new)
                    <div class="news-card" data-aos="clip-right"
                         data-modal-url="{{ route('news.show.modal', $new->getKey()) }}">
                       @includeIf('public.news.partials.news-content')
                    </div>
                @endforeach
            </div>
            <a class="news__link button-type-one" href="{{ route('news.index') }}">Смотреть все новости</a>
        </div>
    </section>
@endif
