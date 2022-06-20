<?php /** @var $edit \App\Models\User */ ?>
<!-- Name Form Input -->
<div class="form-group @if ($errors->has('name')) has-error @endif">
    {!! Form::label('name', 'Имя') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    {!! errorDisplay('name') !!}
</div>
<div class="form-group @if ($errors->has('surname')) has-error @endif">
    {!! Form::label('surname', 'Фамилия') !!}
    {!! Form::text('surname', null, ['class' => 'form-control']) !!}
    {!! errorDisplay('surname') !!}
</div>
<div class="form-group @if ($errors->has('patronymic')) has-error @endif">
    {!! Form::label('patronymic', 'Отчество') !!}
    {!! Form::text('patronymic', null, ['class' => 'form-control']) !!}
    {!! errorDisplay('patronymic') !!}
</div>
<!-- Name Form Input -->
<div class="form-group @if ($errors->has('phone')) has-error @endif">
    {!! Form::label('phone', __('form.phone')) !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
    {!! errorDisplay('phone') !!}
</div>

@includeIf('admin.partials.crud.input-number-negativable', ['name' => 'balance', 'title' => 'Баланс (грн.)', 'step' => 1])

<!-- email Form Input -->
<div class="form-group @if ($errors->has('email')) has-error @endif">
    {!! Form::label('email', 'Email') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
    {!! errorDisplay('email') !!}
</div>

<!-- password Form Input -->
<div class="form-group @error('password') has-error @enderror">
    {!! Form::label('password', __('auth.password')) !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
    {!! errorDisplay('password') !!}
</div>

<div class="row">
    <div class="col-3">
        @include('admin.partials.crud.elements.active')
    </div>
</div>