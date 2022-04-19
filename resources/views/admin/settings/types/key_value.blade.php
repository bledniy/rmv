<?php /** @var $setting \App\Models\Setting */ ?>
<div class="row">
	<div class="col-10">
		@if(is_array($setting->getValue()) AND $setting->getValue())
			@foreach($setting->getValue() as $item)
				<div class="row" data-cloneable-row="">
					<div class="col-5">
						<input type="text" name="@include('admin.settings.types.value-key')[key][]" class="form-control"
						       value="{{  $item->key }}" data-send-no-disable="true">
					</div>
					<div class="col-5">
						<input type="text" name="@include('admin.settings.types.value-key')[value][]" class="form-control"
						       value="{{ $item->value }}" data-send-no-disable="true">
					</div>
					<div class="col-2">
						@include('admin.partials.action.key-value-buttons')
					</div>
				</div>
			@endforeach
		@else
			<div class="row" data-cloneable-row="">
				<div class="col-5">
					<input type="text" name="@include('admin.settings.types.value-key')[key][]" class="form-control"
						   data-send-no-disable="true">
				</div>
				<div class="col-5">
					<input type="text" name="@include('admin.settings.types.value-key')[value][]" class="form-control"
						   data-send-no-disable="true">
				</div>
				<div class="col-2">
					@include('admin.partials.action.key-value-buttons')
				</div>
			</div>
		@endif
	</div>
</div>
