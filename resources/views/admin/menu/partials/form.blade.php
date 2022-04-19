<?php /** @var $menuGroups \App\Enum\MenuGroupEnum[] */ ?>
@include('admin.partials.crud.elements.name')

@include('admin.partials.crud.elements.url')

@include('admin.partials.crud.default', ['name' => 'icon', 'title' => __('modules.menu.icon_font')])

@include('admin.partials.crud.elements.active')

@includeIf('admin.menu.partials.group')

@include('admin.partials.crud.elements.image-upload-group')
