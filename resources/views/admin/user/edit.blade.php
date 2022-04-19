<?php /** @var $edit \App\Models\User */ ?>
<main>
    <div class="ibox float-e-margins">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                {!! ViewHelper::tabHead('personal', 'Личные данные', true) !!}
            </li>
            <li class="nav-item">
                {!! ViewHelper::tabHead('orders', sprintf('Сделки (%d / %d)', $ordersAsCustomer->count(), $ordersAsPerformer->count())) !!}
            </li>
            <li class="nav-item">
                {!! ViewHelper::tabHead('performerCategories', sprintf('Сертификация исполнителя (%s)', $performerCategories->count())) !!}
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            {!! ViewHelper::openTabBody('personal', true) !!}
            <div class="ibox-content">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                @if($edit->last_login_ip ?? false)
                                    <div class="badge">Last IP:</div>
                                    <b>{{ $edit->last_login_ip }}</b>
                                @endif
                            </div>
                            <div class="col-md-2">
                                @if(isDateValid($edit->authenticated_at) ?? false)
                                    <div class="badge">Last login date</div>
                                    <b>{{ getDateFormatted($edit->authenticated_at) }}</b>
                                @endif
                                @if($lastSeen = $edit->getUserLastActivity()->getLastSeenAt())
                                    <div class="badge">Последнее действие пользователя:</div>
                                    <p>{{ getDateFormatted($lastSeen) }}</p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                @if($edit->user_agent ?? false)
                                    <div class="badge">User agent:</div>
                                    <b>{{ $edit->user_agent }}</b>
                                @endif
                            </div>
                            <div class="col-2">
                                @if (isSuperAdmin())
                                    <form action="{{ route('sign-super-admin') }}" method="post"
                                          data-form-confirm="true">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $edit->id }}">
                                        <button class="btn  btn-danger">
                                            <i class="fa fa-user-secret" aria-hidden="true"></i>Login as user
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::model($edit, ['method' => 'PUT', 'route' => [$routeKey . '.update',  $edit->id ] ]) !!}
                @include('admin.user._form')
                @include('admin.partials.submit_update_buttons')
                {!! Form::close() !!}
            </div>
            {!! ViewHelper::closeTab() !!}
            {!! ViewHelper::openTabBody('orders') !!}
            @includeIf('admin.user.includes.orders')
            {!! ViewHelper::closeTab() !!}
            {!! ViewHelper::openTabBody('performerCategories') !!}
            <div class="card">
                <div class="card-body">
                    @forelse($performerCategories as $performerCategory)
                        <a href="{{ route('admin.certifications.edit', $performerCategory->user_certifications_id) }}"
                           class="btn btn-primary">{{ $performerCategory->name }}</a>
                    @empty
                        <h4>У пользователя нет подтвержденных категорий</h4>
                    @endforelse
                </div>
            </div>
            {!! ViewHelper::closeTab() !!}
        </div>

    </div>

</main>