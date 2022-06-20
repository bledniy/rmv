<?php /** @var $menus \App\Models\Menu[]|\Illuminate\Support\Collection*/ ?>
@if($menus->isNotEmpty())
    @foreach($menus as $menu)
        <li><a class="link" href="{{ langUrl($menu->getUrlAttribute()) }}">{{ $menu->getName() }}</a></li>
    @endforeach
@endif