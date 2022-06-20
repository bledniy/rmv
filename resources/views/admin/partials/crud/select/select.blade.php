<?php /** @var $item \App\Models\Model */ ?>
<?php /** @var $edit \App\Models\Model */ ?>
@if(isset($list) AND is_object($list))
	@php
		$name = $name ?? '';
		$column = $column ?? $name ?? '';
		$title = $title ?? $name ?? '';
		$class = $class ?? 'form-control selectpicker';

	@endphp
	{!! errorDisplay($name) !!}
	<label for="{{ $name }}">{{ $title }}</label>
	<select name="{{ $name }}" id="{{ $name }}" class="{{ $class }}" data-live-search="true">
		@isset($nullable)
			<option value="">None</option>
		@endisset
		@foreach($list as $item)
			@php
				if (isset($edit) AND $edit->getAttribute('id') === $item->getKey()){
					continue;
				}
				$selected = (isset($edit)) ? $edit->getAttribute($name) == $item->getKey() : false;
			@endphp
			<option value="{{ $item->getKey() }}" {!! selectedIfTrue($selected) !!}
			>{{ $item->getAttribute($column) }}
			</option>
		@endforeach
	</select>
@endif