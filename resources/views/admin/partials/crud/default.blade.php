<?php /** @var $edit \App\Models\Model */ ?>
@php
    $name = $name ?? $edit->getKeyName();
    $keyDotted = remakeInputKeyDotted($name);
    $attributeKey = getLastFromExploded($keyDotted);
    $title = $title ?? ucfirst(titleFromInputName($attributeKey));
    $value = old($keyDotted, ($value ?? ( (isset($edit) && $edit->getAttribute($attributeKey)) ? $edit->getAttribute($attributeKey) : $default ?? '' ) ) );
    $required = $required ?? false;
    $id = $id ?? $keyDotted;
@endphp

<div class="form-group">
    @if ($errors->has($keyDotted)) <p class="text-danger">{{ $errors->first($keyDotted) }}</p> @endif
    <label for="{{ $id }}" class=" control-label">{{ $title ?? '' }}</label>
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