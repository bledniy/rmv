<?php $options = json_decode($setting->details); ?>

<label class="switch">
	<?php $checked = (isset($setting->value) && $setting->value == 1) ? true : false; ?>
	@if (isset($options->on) && isset($options->off))
		<input type="checkbox" name="@include('admin.settings.types.value-key')" class="toggleswitch"
			   {!! checkedIfTrue($checked) !!}
			   data-on="{{ $options->on }}"
			   data-off="{{ $options->off }}">
	@else
		<input type="checkbox" name="@include('admin.settings.types.value-key')"
			   {!! checkedIfTrue($checked) !!} class="toggleswitch">
	@endif
	<span class="checkbox-slider round"></span>
</label>
