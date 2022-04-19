<div class="panel" style="margin-top:10px;">
	<div class="panel-heading new-setting">
		<hr>
		<h3 class="panel-title"><i class="voyager-plus"></i> {{ __('settings.new') }}</h3>
	</div>
	<div class="panel-body">
		<form action="{{ route('settings.store') }}" method="POST">
			{{ csrf_field() }}
			<div class="row">
				<div class="col-md-3">
					@if ($errors->has('key')) <p class="text-danger">{{ $errors->first('key') }}</p> @endif
					<label for="key">{{ __('generic.key') }}</label>
					<input type="text" class="form-control" name="key" placeholder="{{ __('settings.help_key') }}"
						   required="required" value="{{ old('key') }}">
				</div>
				<div class="col-md-3">
					@if ($errors->has('display_name')) <p
							class="text-danger">{{ $errors->first('display_name') }}</p> @endif
					<label for="display_name">{{ __('generic.name') }}</label>
					<input type="text" class="form-control" name="display_name" value="{{ old('display_name') }}"
						   placeholder="{{ __('settings.help_name') }}" required="required">
				</div>
				<div class="col-md-3">
					<label for="type">{{ __('generic.type') }}</label>
					<select name="type" class="form-control" required="required">
						{{--<option value="">{{ __('generic.choose_type') }}</option>--}}
						<option value="text">{{ __('form.type_textbox') }}</option>
						<option value="text_area">{{ __('form.type_textarea') }}</option>
						{{--                        <option value="rich_text_box">{{ __('form.type_richtextbox') }}</option>--}}
						{{--<option value="code_editor">{{ __('form.type_codeeditor') }}</option>--}}
						<option value="ckeditor">{{ __('form.type_richtextbox') }}</option>
						<option value="checkbox">{{ __('form.type_checkbox') }}</option>
						<option value="radio_btn">{{ __('form.type_radiobutton') }}</option>
						<option value="select_dropdown">{{ __('form.type_selectdropdown') }}</option>
						<option value="file">{{ __('form.type_file') }}</option>
						<option value="file_multiple">{{ __('form.type_file_multiple') }}</option>
						<option value="image">{{ __('form.type_image') }}</option>
						<option value="key_value">{{ __('form.type_key_value') }}</option>
					</select>
				</div>
				<div class="col-md-3">
					<label for="group">{{ __('settings.group') }}</label>
					<select class="form-control group_select group_select_new" name="group">
						@foreach($groups as $group)
							<option value="{{ $group }}">{{ $group }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-12">
					<a id="toggle_options"><i
								class="voyager-double-down"></i> {{ mb_strtoupper(__('generic.options')) }}</a>
					<div class="new-settings-options">
						<label for="options">{{ __('generic.options') }}
							<small>{{ __('settings.help_option') }}</small>
						</label>
						<div id="options_editor" class="form-control min_height_200" data-language="json"></div>
						<textarea id="options_textarea" name="details" class="hidden"></textarea>
						<div id="valid_options" class="alert-success alert"
							 style="display:none">{{ __('json.valid') }}</div>
						<div id="invalid_options" class="alert-danger alert"
							 style="display:none">{{ __('json.invalid') }}</div>
					</div>
				</div>
			</div>
			<div class="pull-left">
				<a href="https://docs.laravelvoyager.com/bread/introduction-1" class="btn btn-sm" target="_blank"
				>FORM CHEATSHEET</a>
			</div>
			<button type="submit" class="btn btn-info pull-right new-setting-btn">
				<i class="fa fa-plus"></i> {{ __('settings.add_new') }}
			</button>
		</form>
	</div>
</div>