@php
    $name = $name ?? '';
    $keyDotted = remakeInputKeyDotted($name);
    $title = $title ?? ucfirst($name);
    $attributeKey = getLastFromExploded($keyDotted);
    $checked = $checked ?? old($keyDotted, isset($edit) ? ((int)Arr::get($edit, $attributeKey)) : $default ?? true);
    $id = $id ?? $keyDotted ?: '';

    $inputColContainerClass = $inputColContainerClass ?? 'col px-0';
@endphp

<div class="form-group">
    <label for="{{ $keyDotted }}" class="control-label">{{ $title ?? '' }}</label>
    <div class="{{ $inputColContainerClass }}">
        <div class="check-styled {{ getCurrentLocaleCode() }}">
            <input type="checkbox" value="1" id="{{ $id }}"
                   autocomplete="off"
                   name="{{ $name }}"
                   @if ($checked) checked="checked" @endif
                    {!! $props ?? '' !!}
            />
            <label for="{{ $keyDotted }}"></label>
        </div>
    </div>
</div>
