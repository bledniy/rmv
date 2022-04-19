<?php /** @var $news \App\Models\News\News*/ ?>
<div class="container" data-close-news-modal>
    <div class="news-modal__wrapper">
        <div class="news-modal__wrap"><h2 class="news-modal__title">{{ $news->getName() }}</h2>
            <p class="news-modal__description">{!! $news->getExcerpt() !!}</p>
            <p class="news-modal__date">
                <span>{{ $news->getPublishedAtFormatted() }}</span>
            </p>
            <img src="{{ getPathToImage($news->getImage()) }}" alt="{{ $news->getName() }}">
            <h3 class="news-modal__title-l">{{ $news->getName() }}</h3>
            <p class="news-modal__text">{!! $news->getDescription() !!}</p>
            <button class="button-type-one close-modal-news" data-close-news-modal>Закрыть статью</button>
            <button class="button-type-none close-modal-news">
                <img src="{{ asset('assets/img/close.svg') }}" data-close-news-modal>
            </button>
        </div>
    </div>
</div>