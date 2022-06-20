@php
	$title = $title ?? __('form.date.date');
	$name = $name ?? 'datetime';
	$inputClass = 'flatpickr form-control';
	$props = 'data-flatpickr-type="datetime_local"';
@endphp

@extends('admin.partials.crud.default')
