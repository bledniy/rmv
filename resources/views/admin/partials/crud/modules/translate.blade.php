<?php /** @var $edit \App\Models\Translate\Translate */ ?>
@if(($edit ?? null) instanceof \App\Models\Translate\Translate)
    @php
        $default = $default ?? '';
        $name = $name ?? inputNamesManager($edit)->getNameInput();
        $keyDotted = remakeInputKeyDotted($name);
        $attributeKey = 'value';
        $title = $title ?? ucfirst(titleFromInputName($attributeKey));
        $value = old($keyDotted, ($value ?? $edit->getAttribute($attributeKey)) );
        $required = $required ?? false;
        $id = $id ?? $keyDotted;
    @endphp

    <div class="form-group">
        @if ($errors->has($keyDotted)) <p class="text-danger">{{ $errors->first($keyDotted) }}</p> @endif
        <label for="{{ $id }}" class=" control-label">
            {{ $title ?? '' }}
            <a class="badge badge-primary no-radius" href="{{ route('translate.index') }}?search={{ $value }}">Перевод</a>
        </label>
        {!! $beforeInput ?? '' !!}
        <input type="{{ $type ?? 'text' }}" id="{{ $id }}" name="{{ $name }}"
               class="{{ $inputClass ?? 'form-control' }}"
               @if($required) required="required" @endif
               autocomplete="{{ $autocomplete ?? 'off' }}"
               {!! $props ?? '' !!}
               {!! $jsEvents ?? '' !!}
               value="{{ $value }}"
        >
        {!! $afterInput ?? '' !!}
    </div>
@elseif (isSuperAdmin())
    <div class="alert alert-danger">Перевод не найден, прогони сиды</div>
@endif