<?php /** @var $edit \App\Models\User */ ?>
<!-- Name Form Input -->
<div class="form-group @if ($errors->has('fio')) has-error @endif">
    {!! Form::label('fio', 'ФИО') !!}
    {!! Form::text('fio', null, ['class' => 'form-control']) !!}
    {!! errorDisplay('fio') !!}
</div>
<!-- Name Form Input -->
<div class="form-group @if ($errors->has('phone')) has-error @endif">
    {!! Form::label('phone', __('form.phone')) !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
    {!! errorDisplay('phone') !!}
</div>

@includeIf('admin.partials.crud.input-number-negativable', ['name' => 'balance', 'title' => 'Баланс (грн.)', 'step' => 1])

<!-- email Form Input -->
{{--<div class="form-group @if ($errors->has('email')) has-error @endif">--}}
{{--    {!! Form::label('email', 'Email') !!}--}}
{{--    {!! Form::text('email', null, ['class' => 'form-control']) !!}--}}
{{--    {!! errorDisplay('email') !!}--}}
{{--</div>--}}

<!-- password Form Input -->
{{--<div class="form-group @error('password') has-error @enderror">--}}
{{--    {!! Form::label('password', __('auth.password')) !!}--}}
{{--    {!! Form::password('password', ['class' => 'form-control']) !!}--}}
{{--    {!! errorDisplay('password') !!}--}}
{{--</div>--}}

<!-- Roles Form Input -->


<div class="form-group">
    @can('edit_roles')
        <div class="w-25 d-inline-block">
            <div class="form-group @if ($errors->has('roles')) has-error @endif">
                {!! Form::label('roles[]', 'Roles') !!}
                {!! Form::select('roles[]', $roles, isset($edit) ? $edit->roles->pluck('id')->toArray() : null,  ['class' => 'form-control selectpicker', 'multiple']) !!}
                {!! errorDisplay('roles') !!}
            </div>
        </div>
    @endcan
</div>
<div class="row">
	<div class="col-3">
{{--		@include('admin.partials.crud.elements.active')--}}
	</div>
</div>

<!-- Permissions -->

@can('edit_roles')
    @isset($edit)
        @include('admin.admin.includes._permissions, ['closed' => 'true', 'model' => $edit, 'user' => $edit ])
    @endisset
@endcan

