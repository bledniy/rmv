@php
	$title = __('form.date.date-from');
	$name = 'date_from';
	$inputClass = 'flatpickr form-control';
	$props = 'data-flatpickr-type="date"';
	$value = $value ?? $edit->date_from ?? now()->format('Y-m-d');
@endphp

@extends('admin.partials.crud.default')
