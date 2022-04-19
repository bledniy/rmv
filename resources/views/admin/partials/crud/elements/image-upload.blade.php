@php
    $name = $name ?? 'image';
    $keyDotted = remakeInputKeyDotted($name);
    $attributeKey = getLastFromExploded($keyDotted);
    $id = $id ?? $keyDotted ?: '';
@endphp
{!! errorDisplay($keyDotted) !!}
<div class="form-group">
    <label for="{{ $keyDotted }}" class=" control-label">{{ __('form.image.image') }}</label>
    <input type="file" name="{{ $name }}" id="{{ $id }}" class="filestyle"
           data-buttonText="{{ __('form.image.choose-image') }}"
           data-placeholder="{{ __('form.image.no-file') }}" accept="image/*">
</div>
