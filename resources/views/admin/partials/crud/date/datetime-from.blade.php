@php
	$title = __('form.date.date-from');
	$name = 'date_from';
	$inputClass = 'flatpickr form-control';
	$props = 'data-flatpickr-type="datetime_local"';
	$value = $value ?? $edit->date_from ?? now()->addDay();
@endphp

@extends('admin.partials.crud.default')
