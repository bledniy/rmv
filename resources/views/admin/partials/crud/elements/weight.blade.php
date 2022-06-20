<?php /** @var $edit \App\Models\Model */ ?>
@php
    $name = $name ?? 'weight';
    $title = $title ?? __('Вес') .' ';
@endphp

@include('admin.partials.crud.input-number', [
    'title' => $title,
    'name' => $name,
    'value' => isset($edit ) ? $edit->getAttribute($name) : 0
])
