<?php /** @var $item \App\Models\Model */ ?>
<?php /** @var $edit \App\Models\Model */ ?>
@isset($list)
	@php
		$name = $name ?? 'title';
	@endphp
	{!! errorDisplay('parent_id') !!}
	<label for="parent_id">{{ __('modules._.parent') }}</label>
	<select name="parent_id" id="parent_id" class="form-control selectpicker" data-live-search="true">
		@isset($nullable)
			<option value="">None</option>
		@endisset
		@foreach($list as $item)
			@php
				if (isset($edit) AND $edit->getAttribute('id') === $item->getKey()){
					continue;
				}
				$selected = (isset($edit)) ? $edit->getAttribute('parent_id') == $item->getKey() : false;
			@endphp
			<option value="{{ $item->getKey() }}" {!! selectedIfTrue($selected) !!}
			>{{ $item->getAttribute($name) }}
			</option>
		@endforeach
	</select>
@endisset
