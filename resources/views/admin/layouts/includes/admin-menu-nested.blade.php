<?php /** @var $item \App\Models\Admin\AdminMenu */ ?>

@php
    $activeUrl = Arr::has($item, 'current') ? 'active' : '';
    $url = $item->isAnchor() ? $item->url :langUrl($item->getUrlWithPrefix());
    $hasChild = $item->childrens->isNotEmpty();
@endphp
<li role="presentation" class="nav-item drop-item {{ $activeUrl }}">
    <a href="{{ $url }}" class="nav-link">
        @include('admin.partials.menu.icon')
        <p>{{$item->name}}</p>
    </a>
    @include('admin.partials.menu.toggle-button')
    @if ($hasChild)
        @php
            $showNested = (Arr::has($item, 'show') || Arr::has($item, 'current'));
        @endphp
        <ul class="nav collapse {{ $showNested ? 'show' : '' }}" id="collapse-{{ $item->id }}"
            aria-labelledby="heading-{{ $item->id }}">
            @foreach($item->childrens as $item)
                @include('admin.layouts.includes.admin-menu-nested')
            @endforeach
        </ul>
    @endif
    {!! $item->content !!}
</li>