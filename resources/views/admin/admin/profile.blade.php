<form method="post" action="{{ route('admin.profile.update') }}">
	@csrf
	@method('post')
	@php
		$edit = $user;
	@endphp
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				@include('admin.partials.crud.elements.name', ['name' => 'name', 'title' => 'Имя'])
			</div>
		</div>
		<div class="col-md-4 d-none">
			@isset($locales)
				<select name="locale" id="locales" class="selectpicker">
					@foreach($locales as $code => $locale)
						<option
							{!! selectedIfTrue($user->getAttribute('locale') == $code) !!} value="{{ $code }}"
						>{{ $locale['name'] }}</option>
					@endforeach
				</select>
			@endisset
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<span class="badge badge-warning">Оставьте пустыми поля пароля если не собираетесь его менять</span>
			@include('admin.partials.crud.default',
			 ['name' => 'password', 'title' => __('modules.users.profile.current-password'), 'type' => 'password', 'value' => ''])
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			@include('admin.partials.crud.default', ['name' => 'password_new', 'title' => __('modules.users.profile.new-password'), 'type' => 'password'])
		</div>
		<div class="col-md-4">
			@include('admin.partials.crud.default',
			 ['name' => 'password_new_confirmation', 'title' => __('modules.users.profile.new-password-confirm'), 'type' => 'password'])
		</div>
	</div>
	<button type="submit" class="btn btn-primary">{{ __('form.save') }}</button>
</form>
