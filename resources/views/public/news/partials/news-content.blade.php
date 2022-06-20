<?php /** @var $new \App\Models\News\News */ ?>
<img src="{{ getPathToImage($new->getImage()) }}" alt="{{ $new->getName() }}">
<div class="wrap">
    <p class="news-card__date">
        <span>{{ $new->getPublishedAtFormatted() }}</span>
    </p>
    <p class="news-card__title">{{ $new->getName() }}</p>
    <p class="news-card__text">{!! $new->getExcerpt() !!}</p>
</div>