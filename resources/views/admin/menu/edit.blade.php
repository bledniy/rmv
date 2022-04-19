<?php /** @var $edit \App\Models\Menu */ ?>
<form action="{{ route($routeKey . '.update', $edit->id) }}" method="post" class="form-horizontal"
	  enctype="multipart/form-data">
	@csrf
	@method('patch')

	@include('admin.menu.partials.form')

	@if ($edit->menus->isNotEmpty())
		<div class="form-group">
			<h3>{{ __('modules.menu.childrens') }}</h3>
			@foreach($edit->menus as $menu)
				<a href="{{ route('menu.edit', $menu->id) }}"
				   class="btn btn-default btn-sm">{{ $menu->name }}</a>
			@endforeach
		</div>
	@endif

	@include('admin.partials.submit_update_buttons')
</form>
