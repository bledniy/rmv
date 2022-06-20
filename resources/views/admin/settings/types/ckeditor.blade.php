<textarea
	class="form-control richTextBox"
	id="settings-ckeditor-{{ $setting->id }}"
	name="@include('admin.settings.types.value-key')"
	cols="30" rows="10"
	data-send-no-disable="true"
>{!! \Arr::get($setting, 'value') !!}</textarea>
