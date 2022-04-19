<?php /** @var $edit \App\Models\Model */ ?>
@php
        $name = $name ?? '';
        $keyDotted = remakeInputKeyDotted($name);
        $title = $title ?? ucfirst($name);
        $attributeKey = getLastFromExploded($keyDotted);
        $value = old($keyDotted, ($value ?? (isset($edit) ? $edit->getAttribute($attributeKey) : '' ) ) );
        $id = $id ?? $keyDotted ?: '';
@endphp
<div class="form-group">
    <label for="{{ $keyDotted }}" class=" control-label">{{ $title ?? '' }}</label>
    <textarea
            class="{!! $class ?? 'form-control' !!}"
            name="{{ $name }}"
            id="{{ $id }}"
            {!! $cols ?? 'cols="30"' !!}
            {!! $rows ?? 'rows="10"' !!}
            {!! $props ?? '' !!}
    >{!! $value !!}</textarea>
</div>