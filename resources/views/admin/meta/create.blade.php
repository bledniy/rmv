<form action="{{ route($routeKey . '.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
	@csrf

	@include('admin.partials.submit_create_buttons')

	@include('admin.meta.partials._form')

	@include('admin.partials.submit_create_buttons')
</form>

@section('javascript')
	<script defer>
        $(document).ready(function () {
			{!! showEditor('text_top') !!}
			{!! showEditor('text_bottom') !!}
        });
	</script>
@stop
