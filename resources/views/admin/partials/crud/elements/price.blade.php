<?php /** @var $edit \App\Models\Model */ ?>
@php
    $name = $name ?? 'price';
    $title = $title ?? __('form.price') .' '. getCurrencyIcon()
@endphp

@include('admin.partials.crud.input-number', [
    'title' => $title,
    'name' => $name,
    'value' => isset($edit ) ? $edit->getAttribute($name) : 0
])
