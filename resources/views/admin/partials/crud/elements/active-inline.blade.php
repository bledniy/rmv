@php
    $name = $name ?? 'active';
    $title = __('form.active');
    $inputColContainerClass = 'd-inline-block ml-2'
@endphp
@extends('admin.partials.crud.checkbox')