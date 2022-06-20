<?php /** @var $setting \App\Models\Setting  */ ?>

@if($setting->isTypeImage() && storageFileExists($setting->getValue()))
	<div class="img_settings_container">
		<a href="{{ route('settings.delete_value', $setting->id) }}"
		   class="voyager-x" data-confirm="true">
			<i class="fa fa-times" aria-hidden="true"></i>
		</a>
		<img src="{{ getStorageFilePath($setting->value) }}"
		     style="max-width:200px; height:auto; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
	</div>
	<div class="clearfix"></div>
@elseif($setting->isTypeFile() && $setting->isFileValid())
	<div class="fileType">
		@foreach ($setting->getValue() as $file)
			@if (storageFileExists($file->download_link))
				<a href="{{ getStorageFilePath($file->download_link) }}"
				   class="badge badge-secondary" target="_blank">{{ $file->original_name }}</a>
			@endif
		@endforeach
	</div>
@endif

@if ($setting->isMultiFile())
	<input type="file" name="@include('admin.settings.types.value-key')[]" multiple>
@else
	<input type="file" name="@include('admin.settings.types.value-key')" @if ($setting->isTypeImage()) accept="image/*" @endif>
@endif