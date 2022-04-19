<form action="{{ route($routeKey . '.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
	@csrf

	@include('admin.partials.submit_create_buttons')

	@include('admin.redirects.partials._form')

	@include('admin.partials.submit_create_buttons')
</form>
