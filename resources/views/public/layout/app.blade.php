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

@include('public.layout.includes.assets.scripts')
</body>
</html>