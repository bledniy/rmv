<?php /** @var $result \App\Models\User[] */ ?>
@php
    $routeKey = $routeKey ?? $key ?? '';
    $permissionKey = $permissionKey ?? $key ?? '';
    $addPremium = $addPremium ?? Gate::allows('view_'. $permissionKey);;
    $canEdit = $canEdit ?? Gate::allows('edit_'. $permissionKey);
    $canDelete = $canDelete ?? Gate::allows('delete_'. $permissionKey);
@endphp
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
                        <i class="fa fa-user-plus" aria-hidden="true"></i>@lang('form.create')
                    </a>
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
                    <th></th>
                    <th>{{ __('generic.name') }}</th>
                    <th>{{ __('form.phone') }}</th>
                    <th>{{ __('generic.created_at') }}</th>
                    <th>Типы пользователя</th>
                    @can('delete_users')
                        <th class="text-center">{{ __('generic.action') }}</th>
                    @endcan
                </tr>
                </thead>
                <tbody>
                @foreach($result as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td class="text-center">
                            @if ($user->getPremiumAccountService()->isActivePremium())
                                <img src="{{asset('images/premium.png')}}" style="width: 15px; height: 15px">
                            @endif
                        </td>
                        <td>
                            <a href="{{ urlEntityEdit($user) }}">
                                <span>{{ $user->getFio() }}</span>
                            </a>
                        </td>
                        <td>{{ $user->getPhoneDisplay() }}</td>
                        <td>{{ getDateFormatted($user->created_at) }}</td>
                        <td>
                            @if (!$user->customer_has_deal && !$user->performer_confirm_category)
                                <small>Без типа пользователя</small>
                            @else
                                @if ($user->customer_has_deal)
                                    <span class="btn btn-primary btn-sm btn-badged"> Заказчик</span>
                                @endif
                                @if ($user->performer_confirm_category)
                                    <span class="btn btn-secondary btn-sm btn-badged"> Исполнитель</span>
                                @endif
                            @endif
                        </td>
                        <th class="text-center">
                            <div class="dropdown menu_drop">
                                <button
                                        class="btn btn-secondary dropdown-toggle" type="button"
                                        id="dropdownMenuButton_{{ $user->id }}" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">menu</i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_{{ $user->id }}">
                                    @if($addPremium)
                                        @includeIf('admin.user.includes.index-actions-addpremium')
                                    @endif
                                    @if($canEdit)
                                        @includeIf('admin.partials.action.includes.index-actions-edit', ['item' => $user])
                                    @endif
                                    @if($canDelete)
                                        @includeIf('admin.partials.action.includes.index-actions-delete', ['item' => $user])
                                    @endif
                                    {!! $indexActions ?? '' !!}
                                </div>
                            </div>
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
