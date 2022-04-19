<?php /** @var $news \App\Models\News\News[]|\Illuminate\Pagination\LengthAwarePaginator */ ?>
@foreach($news as $new)
    <div class="news-card" data-aos="clip-right" data-aos-delay="100"
         data-modal-url="{{ route('news.show.modal', $new->getKey()) }}">
        @includeIf('public.news.partials.news-content')
    </div>
@endforeach