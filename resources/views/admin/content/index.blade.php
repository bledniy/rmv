<?php /** @var $item \App\Models\Content\Content */ ?>
<?php /** @var $contentFieldsList \App\Contents\AbstractContentFieldsList */ ?>
<div class="table-responsive">
    <table class="table table-shopping">
        <thead>
        <tr>
            @if($contentFieldsList->hasSort())
                <th class="">{{ $contentFieldsList->getTitleSort() }}</th>
            @endif
            @if($contentFieldsList->hasName())
                <th class="th-description">{{ $contentFieldsList->getTitleName() }}</th>
            @endif
            @if ($contentFieldsList->hasImage())
                <th>{{ $contentFieldsList->getTitleImage() }}</th>
            @endif
            <th class="text-right">
                <a href="{{ route($routeKey.'.create') }}" class="btn btn-primary">@lang('form.create')</a>
            </th>
        </tr>
        </thead>
        @if ($list->isNotEmpty())
            <tbody data-sortable-container="true" data-table="{{ $list->first()->getTable() }}">
            @foreach($list as $item)
                <tr class="draggable" data-sort="" data-id="{{ $item->getKey() }}">
                    @if($contentFieldsList->hasSort())
                        <td>
                            @include('admin.partials.sort_handle')
                        </td>
                    @endif
                    @if($contentFieldsList->hasName())
                        <td>
                            <a href="{{ route($routeKey.'.edit',  $item->id) }}">
                                {{ $item->name }}
                            </a>
                        </td>
                    @endif
                    @if ($contentFieldsList->hasImage())
                        <td>
                            <div class="img-container">
                                <a href="{{ imgPathOriginal(getPathToImage($item->image)) }}" class="fancy"
                                   data-fancybox="{{ $item->getTable() }}-image">
                                    <img src="{{ getPathToImage($item->getImage()) }}" alt=""/>
                                </a>
                            </div>
                        </td>
                    @endif
                    <td class="text-primary text-right">
                        @include('admin.partials.action.index_actions')
                    </td>
                </tr>
            @endforeach
            </tbody>
        @endif
    </table>
</div>
