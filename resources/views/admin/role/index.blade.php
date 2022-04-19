<main class="">
    <div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel">
        <div class="modal-dialog" role="document">
            {!! Form::open(['method' => 'post']) !!}

            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="roleModalLabel">@lang('modules.roles.title')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <!-- name Form Input -->
                    <div class="form-group @if ($errors->has('name')) has-error @endif">
                        {!! Form::label('name', __('form.title')) !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('modules.roles.name_role')]) !!}
                        @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('close')</button>

                    <!-- Submit Form Button -->
                    {!! Form::submit(__('form.create'), ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="row m-0 p-4 bg-white">
        <div class="col-md-5">
            <h3>@lang('modules.roles.title')</h3>
        </div>
        <div class="col-md-7 page-action text-right">
            @can('create_roles')
                <a href="#" class="btn btn-sm btn-success pull-right" data-toggle="modal" data-target="#roleModal"> <i
                            class="glyphicon glyphicon-plus"></i> @lang('form.create')</a>
            @endcan
        </div>
    </div>


    <div class="col">
        <div class="p-4 bg-white mt-4">
            @forelse ($roles as $role)
                {!! Form::model($role, ['method' => 'PUT', 'route' => [$routeKey . '.update',  $role->id ], 'class' => 'm-b']) !!}

                @if($role->name === 'Admin')
                    @include('admin.admin.includes._permissions', [
                                  'title' => $role->name . ' ' . __('modules.roles.permissions'),
                                  'options' => ['disabled'] ])
                @else
                    @include('admin.admin.includes._permissions', [
                                  'title' => $role->name . ' ' . __('modules.roles.permissions'),
                                  'model' => $role ])
                    @can('edit_roles')
                        {!! Form::submit(__('form.save'), ['class' => 'btn btn-primary']) !!}
                    @endcan

                @endif

                {!! Form::close() !!}

            @empty
                <p>No Roles defined, please run <code>php artisan db:seed</code> to seed some dummy data.</p>
            @endforelse
        </div>
    </div>
</main>
