<?php /** @var $item \App\Models\News\News */ ?>
@php
    $canEdit = $canEdit ?? Gate::allows('edit_'. $permissionKey);
    $canDelete = $canDelete ?? Gate::allows('delete_'. $permissionKey);
@endphp
<div class="table-responsive">
    <table class="table table-shopping">
        <thead>
        <tr>
            <th class="">@lang('form.image.image')</th>
            <th class="th-description">@lang('form.title')</th>
            <th class="th-description">@lang('form.date.date-pub')</th>
            <th>Отображение</th>
            <th class="text-right">
                <a href="{{ route($routeKey.'.create') }}" class="btn btn-primary">@lang('form.create')</a>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $item)
            <tr>
                <td>
                    <div class="img-container">
                        <a href="{{ imgPathOriginal(getPathToImage($item->image)) }}" class="fancy" data-fancybox="news-image">
                            <img src="{{ getPathToImage($item->image) }}" alt=""/>
                        </a>
                    </div>
                </td>
                <td>
                    <a href="{{ route($routeKey.'.edit', $item->id) }}">{{ $item->name }}</a>
                </td>
                <td>
                    {{ $item->published_at }}
                </td>

                <td>
                    {{ translateYesNo((int)$item->getAttribute('active')) }}
                </td>
                <td class="text-primary text-right">
                    @include('admin.partials.action.index_actions')
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{{$list->render()}}

