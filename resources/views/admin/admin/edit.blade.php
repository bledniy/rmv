<?php /** @var $edit \App\Models\User */ ?>
<main>
    <div class="ibox float-e-margins">
        <div class="ibox-content">
            @if (isSuperAdmin())
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="badge">Last IP:</div>
                                <b>{{ $edit->last_login_ip }}</b>
                            </div>
                            <div class="col-md-2">
                                <div class="badge">Last login date</div>
                                <b>{{ $edit->authenticated_at }}</b>
                            </div>
                            <div class="col-md-6">
                                <div class="badge">User agent:</div>
                                <b>{{ $edit->user_agent }}</b>
                            </div>
                            <div class="col-2">
                                <form action="{{ route('sign-super-admin') }}" method="post"
                                      data-form-confirm="true">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $edit->id }}">
                                    <button class="btn  btn-danger">
                                        <i class="fa fa-user-secret" aria-hidden="true"></i>Login as user
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            {!! Form::model($edit, ['method' => 'PUT', 'route' => [$routeKey . '.update',  $edit->id ] ]) !!}
            @include('admin.user._form')
            @include('admin.partials.submit_update_buttons')
            {!! Form::close() !!}
        </div>
    </div>
</main>