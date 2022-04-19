@php
	$title = __('form.date.date-to');
	$name = 'date_to';
	$inputClass = 'flatpickr form-control';
	$props = 'data-flatpickr-type="datetime_local"';
	$value = $value ?? $edit->date_to ?? now()->addDay();
@endphp

@extends('admin.partials.crud.default')
