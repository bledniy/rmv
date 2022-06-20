<div class="panel panel-default">
    <div class="panel-body clearfix">
        <div class="row">
            <div class="col-8">
                <form action="" method="get">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-7">
                                @include('admin.partials.crud.default', ['name' => 'search', 'title' => 'Search', 'value' => $request->get('search'),])
                            </div>
                            <div class="col-3">
                                <button class="btn btn-danger" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    @lang('form.search')
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-shopping">
        <thead>
        <tr>
            <th>ID</th>
            <th>URL адресс</th>
            <th>Ссылка</th>
            <th>{{ __('form.active') }}</th>
            <th class="text-right">
                <a href="{{ route($routeKey . '.create') }}" class="btn btn-primary">@lang('form.create')</a>
            </th>
        </tr>
        </thead>
        <tbody>
		<?php /** @var $item \App\Models\Meta */?>
        @foreach($list as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>
                    <input type="text" value="{{ $item->url }}" readonly="" class="form-control">
                </td>
                <td>@include('admin.partials.preview-button', ['link' => frontendUrl($item->url), 'title' => 'Перейти',])</td>
                <td>{{ translateYesNo($item->active) }}</td>
                <td class="text-primary text-right">
                    @if ($item->isDefault())
                        <h4 class="badge badge-warning d-inline-block">Мета данные по умолчанию</h4>
                    @endif
                    <div class="dropdown menu_drop d-inline-block">
                        <button
                                class="btn btn-secondary dropdown-toggle" type="button"
                                id="dropdownMenuButton_{{ $item->id }}" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">menu</i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_{{ $item->id }}">
                            @can('edit_' . $permissionKey)
                                <a href="{{ route($routeKey . '.edit',  $item->id)  }}" class="dropdown-item">@lang('form.edit')</a>
                            @endcan
                            @can('delete_' . $permissionKey)
                                @if (!$item->isDefault())
                                    {!! Form::open( ['method' => 'delete', 'url' => route($routeKey . '.destroy', $item->id), 'class' => 'formDeleteConfirm']) !!}
                                    <button type="submit" class="dropdown-item">@lang('form.delete')</button>
                                    {!! Form::close() !!}
                                @endif
                            @endcan
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{{$list->render()}}
