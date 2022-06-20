@php
	$title = __('form.date.date-to');
	$name = 'date_to';
	$inputClass = 'flatpickr form-control';
	$props = 'data-flatpickr-type="date"';
	$value = $value ?? $edit->date_to ?? now()->addDay()->format('Y-m-d');
@endphp

@extends('admin.partials.crud.default')
