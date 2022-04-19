<?php /** @var $edit \App\Models\Slider\Slider */ ?>
{{--@include('admin.partials.crud.elements.image-upload-group')--}}

{{--@include('admin.partials.crud.elements.active', ['name' => inputNamesManager($edit)->getNameInputByKey('active')])--}}

@if(isSuperAdmin())
    @include('admin.partials.crud.default', ['name' => inputNamesManager($edit)->getNameInputByKey('key')])
@endif