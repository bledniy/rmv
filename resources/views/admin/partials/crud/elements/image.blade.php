@isset($edit)
    @php
        $table = $photo_table ?? $edit->getTable() ?? '';
        $name = $name ?? 'image';
        $keyDotted = remakeInputKeyDotted($name);
        $attributeKey = getLastFromExploded($keyDotted);
        $image = $edit->getAttribute($attributeKey);
        $editable = $editable ?? true;
        $title = $title ?? __('form.image.image-current');
    @endphp
	<?php /** @var $edit \App\Models\Model */ ?>
    @if(getPathToImage($image))
        <div class="form-group">
            <label class=" control-label">{{ $title }}</label>
            <div class="col">
                <div class="image-actions" data-image-actions="">
                    <a href="{{ imgPathOriginal(getPathToImage($image)) }}" class="fancy">
                        <img
                                src="{{ getPathToImage($image) }}?{{ storageFilemtime($image) }}"
                                class="img-responsive {{ !$editable ?: 'deleteable croppable' }}" width="150"
                                data-image-id="{{ $edit->getKey() ?? '' }}"
                                data-image-table="{{ $table }}">
                    </a>
                </div>
            </div>
        </div>
    @endif
@endisset
