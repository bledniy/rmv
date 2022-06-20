<form action="{{route($routeKey.'.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
	@csrf
	@method('post')

	@include('admin.partials.submit_create_buttons')

    @include('admin.sliders.partials.form')

	@include('admin.partials.submit_create_buttons')
</form>