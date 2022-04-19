<div class="row">
	<div class="col-md-5">
		<h3>@lang('form.create')</h3>
	</div>
	<div class="col-md-7 page-action text-right">
		<a href="{{ route('users.index') }}" class="btn btn-default btn-sm"> <i
				class="fa fa-arrow-left"></i> @lang('modules._.back')</a>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
	{!! Form::open(['route' => ['users.store'] ]) !!}
	@include('user._form')
	<!-- Submit Form Button -->
		{!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
		{!! Form::close() !!}
	</div>
</div>
