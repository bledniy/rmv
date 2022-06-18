@php
    $name = $name ?? 'file';
    $keyDotted = remakeInputKeyDotted($name);
    $attributeKey = getLastFromExploded($keyDotted);
    $id = $id ?? $keyDotted ?: '';
@endphp
{!! errorDisplay($keyDotted) !!}
<div class="form-group">
    <label for="{{ $keyDotted }}" class=" control-label">{{ __('form.file.file') }}</label>
    <input type="file" name="{{ $name }}" id="{{ $id }}" class="filestyle"
           data-buttonText="{{ __('form.file.choose-file') }}"
           data-placeholder="{{ __('form.file.no-file') }}" accept="file/*">
</div>
