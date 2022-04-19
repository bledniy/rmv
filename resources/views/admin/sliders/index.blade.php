<div class="table-responsive">
    <table class="table table-shopping">
        <thead>
        <tr>
            <th>ID</th>
            <th class="th-description">Изображение</th>
            <th class="text-right">
                <a href="{{ route($routeKey . '.create') }}" class="btn btn-primary">@lang('form.create')</a>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>
                    <img src="{{ getPathToImage($item->image) }}" class="img-fluid" width="40" alt="">
                </td>
                <td class="text-primary text-right">
					@include('admin.partials.action.index_actions')
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="text-center">
    {{ $list->links()}}
</div>
