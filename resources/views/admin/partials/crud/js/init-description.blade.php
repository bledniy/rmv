@extends('admin.partials.crud.js.layout')
@section('js')
	<script type="text/javascript" defer>
		$(document).ready(function (e) {
			{!! showEditor('description') !!}
		})
	</script>
@stop