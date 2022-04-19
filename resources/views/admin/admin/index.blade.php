<?php /** @var $result \App\Models\User[] */ ?>
<main>
    <div class="clearfix header_search">
        <form action="" method="get">
            <div class="form-group">
                <div class="row">
                    <div class="col-10">
                        <input type="text" class="form-control" name="search" value="{{ $search }}" autocomplete="off">
                    </div>
                    <div class="col-2">
                        <button class="btn btn-danger" type="submit"><i class="fa fa-search" aria-hidden="true"></i>
                            @lang('form.search')
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-5">
                <h3 class="modal-title"> {{ __('modules.users.title') }} - {{ $result->total() }}</h3>
            </div>
            <div class="col-md-7 page-action text-right">
                @can('add_users')
                    <a href="{{ route($routeKey . '.create') }}" class="btn btn-primary mr-5">
                        <i class="fa fa-user-plus"
                           aria-hidden="true"></i>
                        @lang('form.create')</a>
                @endcan
                @can('view_roles')
                    <a href="{{ route('admin.roles.index') }}"
                       class="btn btn-info "><i class="fa fa-users"
                                                aria-hidden="true"></i> {{ __('modules.roles.title') }}</a>
                @endcan
            </div>
        </div>
    </div>

    <div class="table_main ">
        <div class="table_container">
            <table class="table table-bordered table-hover" id="data-table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>{{ __('generic.name') }}</th>
                    <th>{{ __('form.phone') }}</th>
                    @can('view_roles')
                        <th class="text-center">{{ __('modules.roles.title') }}</th>
                    @endcan
                    <th>{{ __('generic.created_at') }}</th>
                    @can('delete_users')
                        <th class="text-center">{{ __('generic.action') }}</th>
                    @endcan
                </tr>
                </thead>
                <tbody>
                @foreach($result as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->getFio() }}</td>
                        <td>{{ $item->getPhoneDisplay() }}</td>
                        @can('view_roles')
                            <td>{{ $item->roles->implode('name', ', ') }}</td>
                        @endcan
                        <td>{{ getDateFormatted($item->created_at) }}</td>
                        <th class="text-center">
                            @includeIf('admin.partials.action.index_actions')
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center">
            {{ $result->links() }}
        </div>
    </div>
</main>
