<?php /** @var $item \App\Models\Redirect */ ?>
@php
    $canEdit = Gate::allows('edit_'. $permissionKey);
    $canDelete = Gate::allows('delete_'. $permissionKey);
@endphp
<div class="table-responsive">
    <table class="table table-shopping">
        <thead>
        <tr>
            <th>ID</th>
            <th>From</th>
            <th>To</th>
            <th>Code</th>
            <th>Включен</th>
            <th class="text-right">

                <a href="{{ route($routeKey . '.create') }}" class="btn btn-primary">@lang('form.create')</a>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td><a href="{{ frontendUrl($item->from) }}" target="_blank">{{ $item->from }}</a></td>
                <td><a href="{{ frontendUrl($item->to) }}" target="_blank">{{ $item->to }}</a></td>
                <td>{{ $item->code }}</td>
                <td>{{ translateYesNo($item->active) }}</td>
                <td class="text-primary text-right">
                    @include('admin.partials.action.index_actions')
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{{$list->render()}}
