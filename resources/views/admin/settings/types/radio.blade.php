<?php $options = json_decode($setting->details); ?>
								<?php $selected_value = (isset($setting->value) && !empty($setting->value)) ? $setting->value : NULL; ?>
								<?php $default = (isset($options->default)) ? $options->default : NULL; ?>
<ul class="radio">
	@if(isset($options->options))
		@foreach($options->options as $index => $option)
			<li>
				<input type="radio" id="option-{{ $index }}"
					   name="@include('admin.settings.types.value-key')"
				       value="{{ $index }}" @if($default == $index && $selected_value === null){{ 'checked' }}@endif @if($selected_value == $index){{ 'checked' }}@endif>
				<label for="option-{{ $index }}">{{ $option }}</label>
				<div class="check"></div>
			</li>
		@endforeach
	@endif
</ul>