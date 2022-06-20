<?php /** @var $item \App\Models\Model */ ?>
<?php /** @var $edit \App\Models\Model */ ?>
@if(isset($list) AND is_array($list))
	@php
		$name = $name ?? '';
		$column = $column ?? $name ?? '';
		$title = $title ?? $name ?? '';
		$class = $class ?? 'form-control selectpicker';
		$liveSearch = $liveSearch ?? 1;
	@endphp
	{!! errorDisplay($name) !!}
	<label for="{{ $name }}">{{ $title }}</label>
	<select
		name="{{ $name }}"
		id="{{ $name }}"
		class="{{ $class }}"
		@if ($liveSearch) data-live-search="true"@endif
	>
		@isset($nullable)
			<option value="">None</option>
		@endisset
		@foreach($list as $key => $value)
			@php
				if (isset($edit) AND $edit->getAttribute('id') === $key){
					continue;
				}
				$selected = (isset($edit) AND $edit->getAttribute($name) == $key);
			@endphp
			<option value="{{ $key }}" {!! selectedIfTrue($selected) !!}
			>{{ $value }}
			</option>
		@endforeach
	</select>
@endif
