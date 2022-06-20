<?php /** @var $request  \App\DataContainers\Page\PageSearchRequest */ ?>
<form action="">
	<div class="form-group">
		<div class="row">
			<div class="col-10">
				<input type="text" class="form-control" name="search" value="{{ $request->getSearch() }}"
					   autocomplete="off">
			</div>
			<div class="col-2">
				<button class="btn btn-danger" type="submit"><i class="fa fa-search" aria-hidden="true"></i>
					@lang('form.search')
				</button>
			</div>
		</div>
	</div>
</form>
<div class="table-responsive">
	<table class="table table-shopping">
		<thead>
		<tr>
{{--			<th class="">@lang('form.image.image')</th>--}}
			<th class="th-description">@lang('form.title')</th>
			<th class="text-right">
				<a href="{{ route( $routeKey . '.create') }}" class="btn btn-primary">@lang('form.create')</a>
			</th>
		</tr>
		</thead>
		<tbody>
		@foreach($list as $item)
            <?php /** @var $item \App\Models\Page\Page */ ?>
			<tr>
{{--				<td>--}}
{{--					<div class="img-container">--}}
{{--						<a href="{{ imgPathOriginal(getPathToImage($item->image)) }}" class="fancy" data-fancybox="pages-image">--}}
{{--							<img src="{{ getPathToImage($item->image) }}" alt=""/>--}}
{{--						</a>--}}
{{--					</div>--}}
{{--				</td>--}}
				<td>
					<a href="{{ route($routeKey .'.edit', $item->getKey())  }}">{{ $item->getTitle() }}</a>
				</td>
{{--				<td>--}}
{{--					@include('admin.partials.preview-button', ['link' => $item->getRouteUrl()])--}}
{{--				</td>--}}
				<td class="text-primary text-right">
					@include('admin.partials.action.index_actions')
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>

{{$list->render()}}

@section('javascript')
	<script defer>
        $(document).ready(function () {
            $("a.fancy").fancybox();
        });
	</script>
@stop
