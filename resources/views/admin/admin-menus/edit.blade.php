<?php /** @var $edit \App\Models\Admin\AdminMenu */ ?>

<div class="text-right">
    @includeIf('admin.partials.action.includes.index-actions-delete', ['item' => $edit, 'cssClass' => 'btn btn-danger'])
</div>

<form action="{{ route($routeKey . '.update', $edit->id) }}" method="post" class="form-horizontal"
      enctype="multipart/form-data">
    @csrf
    @method('patch')
    
    @include('admin.partials.crud.elements.name')

    @include('admin.partials.crud.elements.url')
    
    @include('admin.partials.crud.textarea.description')

    @include('admin.partials.crud.elements.active')

    @include('admin.partials.crud.default', ['name' => 'gate_rule', 'title' => 'Gate rule'])

    @include('admin.partials.crud.default', ['name' => 'route', 'title' => 'Route'])

    @include('admin.partials.crud.default', ['name' => 'icon_font', 'title' => 'Icon font'])

    @include('admin.partials.crud.default', ['name' => 'content_provider', 'title' => 'Content provider'])

    @include('admin.partials.crud.default', ['name' => 'option', 'title' => 'Options'])

    @include('admin.partials.crud.elements.image-upload-group')

    @include('admin.partials.submit_update_buttons')
</form>