<!DOCTYPE html>
<html lang="ru">
@include('public.layout.includes.head')
<body>

@includeIf('public.layout.includes.preloader')

@hasSection('content')
    @yield('content')
@else
    {!! $content ?? '' !!}
@endif

@includeIf('public.layout.includes.modals.contact-modal')
@includeIf('public.layout.includes.modals.contact-modal-tkanks')
@includeIf('public.layout.includes.modals.news-modal')
@includeIf('public.layout.includes.modals.resume-modal')
@include('public.layout.includes.assets.scripts')
</body>
</html>