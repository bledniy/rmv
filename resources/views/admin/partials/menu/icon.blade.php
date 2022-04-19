<?php /** @var $item \App\Models\Admin\AdminMenu */ ?>
@if (Arr::get($item, 'icon_font'))
    <span class="icon-left">{!! Arr::get($item, 'icon_font') !!}</span>
@elseif ($image = Arr::get($item, 'image') AND storageFileExists($image))
    <img src="{{ getPathToImage($image) }}" class="img-fluid pull-left mr-3" width="30" alt="">
@endif