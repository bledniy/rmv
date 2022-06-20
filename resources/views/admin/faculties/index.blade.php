@php
    $canEdit = $canEdit ?? Gate::allows('edit_'. $permissionKey);
    $canDelete = $canDelete ?? Gate::allows('delete_'. $permissionKey);
@endphp
<div class="table-responsive">
    <table class="table table-shopping">
        <thead>
        <tr>
            <th class="">Сортировка</th>

            {{--			<th class="">@lang('form.image.image')</th>--}}
            <a href="{{ route( $routeKey . '.create') }}" class="btn btn-primary">@lang('form.create')</a>
            </th>
        </tr>
        </thead>
        <tbody data-sortable-container="true" data-table="{{ $list->first()->getTable() }}">
        @foreach($list as $item)
            <?php /** @var $item \App\Models\Faculty\Faculty */ ?>
            <tr>
                <td>
                    @include('admin.partials.sort_handle')
                </td>
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
