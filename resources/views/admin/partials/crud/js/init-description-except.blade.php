@extends('admin.partials.crud.js.layout')

@section('js')

	<script type="text/javascript" defer>
		$(document).ready(function (e) {
			{!! showEditor('excerpt') !!}
			{!! showEditor('description') !!}
		})
	</script>
@stop