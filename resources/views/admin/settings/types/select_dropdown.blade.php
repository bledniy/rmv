<?php $options = json_decode($setting->details); ?>
<?php $selected_value = (isset($setting->value) && !empty($setting->value)) ? $setting->value : NULL; ?>
<select class="form-control" name="@include('admin.settings.types.value-key')">
	<?php $default = (isset($options->default)) ? $options->default : NULL; ?>
	@if(isset($options->options))
		@foreach($options->options as $index => $option)
			<option value="{{ $index }}" @if($default == $index && $selected_value === null){{ 'selected="selected"' }}@endif @if($selected_value == $index){{ 'selected="selected"' }}@endif>{{ $option }}</option>
		@endforeach
	@endif
</select>