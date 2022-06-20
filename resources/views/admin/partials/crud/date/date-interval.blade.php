@php
	$title = __('form.date.date-range');
	$name = 'date';
	$inputClass = 'flatpickr form-control';
	$props = 'data-flatpickr-type="range"';
	$value = $value ?? '';
@endphp

@extends('admin.partials.crud.default')
