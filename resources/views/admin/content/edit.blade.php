<?php /** @var $edit \App\Models\Content\Content */ ?>

<form action="{{ route($routeKey . '.update', $edit->getKey() ) }}" method="post" class="form-horizontal"
      enctype="multipart/form-data">
	@csrf
	@method('patch')

	@include('admin.partials.submit_update_buttons')

	@include('admin.content.partials.form')

	@include('admin.partials.submit_update_buttons')
</form>

